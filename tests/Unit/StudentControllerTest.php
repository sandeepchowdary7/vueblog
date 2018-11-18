<?php
namespace Tests\Unit;

use App\Student;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group students
 * @group students-controllers
 */
class StudentControllerTest extends TestCase
{
    /**
     * test Student Show Method.
     *
     * @return void
     */
    public function testIncomplete()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
          );
    }
    /**
     * test Student Show Method.
     *
     * @return void
     */
    public function testShow()
    {
        $student = Student::find(1);
        
        $this->assertNotNull($student);
        $this->assertEquals('Hyman', $student->first_name);
    }
}
