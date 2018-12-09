<?php
namespace Tests\Helpers;
use Illuminate\Support\Facades\DB;

class Seed 
{
    public function datafile($file)
    {
        $data = file_get_contents($file);
        $data = preg_replace([ '/\w*\/\/.*\\n?/',  '/[\\t\\n]/' ], ' ', $data);
        $data = \json_decode($data, true);
        if($data == null) {
            throw new \Exception("The data's JSON is not valid <$file> - " );
        }

        static::populateDatabase($data);
        if(\App::environment('testing') === false) {
            $fileName = \substr($file, strpos($file, 'DatabaseData') + 13);
            echo "Seeded: {fileNmae}\n";
        }
    }

    public static function populateDatabase($data)
    {
        foreach ($data as $model => $objects) {
            foreach ($objects as $object) {
                $attributes = static::extractObjectAttributes($object);

                $instance = $model::create($attributes['basic']);
                if(!$instance) {
                    $error = 'class: ' . $model  . "\n";
                    $error  .= 'raw_data: ' .  print_r($attributes['basic'],  true) . "\n";
                    $error  .= 'errors: ' .  print_r($instance->errors()->all(), true);
                    throw new \Exception($error);
                }

                foreach ($attributes['objects'] as $object => $objectData) {
                    static::populateDatabase([ $object => $objectData ]);
                }

                foreach ($attributes['delay']['sync'] as $attribute => $value) {
                    $instance->{$attribute}()->sync($value);
                }

                foreach ($attributes['delay']['basic'] as $attribute => $value) {
                    $instance->{$attribute} = $value;
                }

                $instance->save();
            }
        }
    }

    private static function extractObjectAttributes($object)
    {
        $attributes = [ 'basic' => [], 'delay' => [ 'sync' => [], 'basic' => [] ], 'objects' => [] ];

        foreach ($object as $key => $value) {
            if(is_array($value) == false && $key[0] != '*') {
                if (strpos($value, '::') == true) {
                    $value = constant($value);
                }

                $attributes['basic'][$key] = $value;
            }

            if (strpos($key, "\\") == false && is_array($value) == true) {
                $attributes['delay']['sync'][$key] = $value;
            }

            if ($key[0] == '*') {
                $key = substr($key, 1);
                $attributes['delay']['basic'][$key] = $value;
            }

            if (strpos($key, "\\") == true) {
                $attributes['objects'][$key] = $value;
            }
        }

        return $attributes;
    }

    public static function import($tableName, $conditions = [], $count = 10)
    {
        $query = DB::table("vueblog.{$tableName}");
        if (count($conditions) > 0) {
           foreach ($conditions as $field => $condition) {
               if ($condition[0] == 'between') {
                   $query->whereBetween($field, $condition[1]);
               } else {
                   $query->where($field, $condition[0], $condition[1]);
               }
           }
        }

        $records = $query->take($count)->get();
        foreach ($records as $record) {
            $record = \json_decode(json_encode($record), true);
            foreach ($record as $key => &$value) {
                if (is_null($value) || trim($value) == ' ') {
                   unset($record[$key]);
                } else {
                    $value = " '{value}' ";
                }
            }

            $columns = implode(',', array_keys($record));
            $values = implode(',', array_values($record));
            DB::statement("INSERT INTO `{$tableName}` ({$columns}),  VALUES ({$values});");
        }
    }
}