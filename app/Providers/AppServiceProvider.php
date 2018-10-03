<?php

namespace App\Providers;
use App\Professor;
use App\Student;
use App\Observers\ProfessorRollNumberObserver;
use App\Observers\StudentRollNumberObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Professor::observe(ProfessorRollNumberObserver::class);
        Student::observe(StudentRollNumberObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
