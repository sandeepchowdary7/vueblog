<?php
namespace Tests\Unit;
use App\Student;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group controllers
 * @group students
 * @group students-controller
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
        $student = Student::find(1);
        
        $this->assertEquals('sandeep', $student->first_name);
        $this->assertNotNull($student);
    }

    /**
     * test Student Show Method.
     *
     * @return void
     */
    public function testShow()
    {
        $student = Student::find(1);
        $this->assertEquals('8167455196', $student->contact_number);
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
        $student->first_name = 'sandeep';
        $student->middle_name = 'k';
        $student->last_name = 'choudary';
        $student->guardian_name = 'knr';
        $student->gender = 'Male';
        $student->dob = '2015-09-06';
        $student->contact_number = 8167455196;
        $student->address = '7493 Legros Burg Considinefort, NH 24537';
        $student->save();

        $this->assertNotNull($student->roll_number);
        $this->assertContains('knr', $student->guardian_name);
    }

    /**
     * test Student Delete Method.
     *
     * @return void
     */
    public function testDelete()
    {
        $student = Student::find(1);
        $student->delete();

        $student = Student::all();
        $this->assertCount(0, $student);
    }
}
