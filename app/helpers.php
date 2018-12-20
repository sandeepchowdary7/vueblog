<?php

use Illuminate\Support\Str;

/**
 * Display URL for the show route.
 * @param string $model
 * @param string $resource
 * @return string
 */
if (! function_exists('show_route')) {
    function show_route($model, $resource = null)
    {
        $resource = $resource ?? plural_from_model($model);
        return route( "{$resource}.show", $model);
    }
}

if (! function_exists('plural_from_model')) {
    function plural_from_model($model)
    {
        $plural = Str::plural(class_basename($model));
        return Str::kebab($plural);
    }
}
