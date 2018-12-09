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
     * test Student Index Method.
     *
     * @return void
     */
    public function testIndex()
    {
        $student = Student::all();
     
        $this->assertNotNull($student);
       $this->assertCount(30, $student);
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
    
    /**
     * test Student Update Method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $student = Student::find(1);
        $student->guardian_name = 'guardianName';
        $student->update();

        $this->assertEquals('guardianName', $student->guardian_name);
    }

    /**
     * test Student Create Method.
     * test Student RollNumber Generation when Create Method is Fired.
     *
     * @return void
     */
    public function testCreate()
    {
        $student = new Student;
        $student->first_name = 'firstName';
        $student->middle_name = 'guardianName';
        $student->last_name = 'guardianName';
        $student->guardian_name = 'guardianName';
        $student->gender = 'Male';
        $student->dob = '2015-09-06';
        $student->contact_number = 8167455196;
        $student->address = '7493 Legros Burg Considinefort, NH 24537';
        $student->save();

        $this->assertNotNull($student->roll_number);
        $student = Student::all();
        $this->assertCount(31, $student);
    }

    /**
     * test Student Delete Method.
     *
     * @return void
     */
    public function testDelete()
    {
        $student = Student::latest()->first();
        $student->delete();

        $student = Student::all();
        $this->assertCount(30, $student);
    }
}
