<?php

namespace Tests;
use Tests\Helpers\Seed;
use Illuminate\Support\Facades\Artisan;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MockeryPHPUnitIntegration;

    protected $seeds = [];
    protected $shouldFallbackToDefaultSeed = true;

    public function setUp(){
        parent::setUp();
        Artisan::call('migrate');
        Seed::populateDatabase(require('test-data.php'));
    }
        
    public function tearDown(){
        Artisan::call('migrate:reset');
    }

    public function call($method, $uri, $parameters = [], $files = [], $server = [], $content = null, $changeHistory = true)
    {
        $_SERVER['REQUEST_URI'] = $uri;
        $_SERVER['HTTP_HOST'] = 'http://vueblogg.test:8000/admin-home#';
        $_POST = $parameters;
        return parent::call($method, $uri, $parameters, $files, $server, $content, $changeHistory);
    }
    
    //We are not using this method currently
    // public function seeddb()
    // {
    //     if ($this->seeds) {
    //         $dir = $this->seedDataDirectory();
    //         foreach ($this->seeds as $seed) {
    //             $seed = trim($seed, '.php');
    //             $filepath = DIRECTORY_SEPERATOR . trim($dor, '/') . DIRECTORY_SEPERATOR . $seed . '.php';
    //             Seed::populateDatabase(require('test-data.php'));
    //         }
    //         return;
    //     }
    //     if ($this->shouldFallbackToDefaultSeed) {
    //         // \Artisan::call('seed:test');
    //     }
    // }

    // public function seedDataDirectory()
    // {
    //     return __DIR__;
    // }
}
