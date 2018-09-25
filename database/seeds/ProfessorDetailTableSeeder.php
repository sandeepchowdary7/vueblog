<?php

use Illuminate\Database\Seeder;

class ProfessorDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProfessorDetail::class, 30)->create()->each(function($professorDetail) {
            $professorDetail->save();
           });    
    }
}
