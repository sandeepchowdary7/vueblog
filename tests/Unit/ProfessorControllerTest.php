<?php
namespace Tests\Unit;
use App\Professor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group controllers
 * @group professors
 * @group professors-controller
 */
class ProfessorControllerTest extends TestCase
{
    /**
     * test Student Index Method.
     *
     * @return void
     */
    public function testIndex()
    {
        $professor = Professor::find(1);
        
        $this->assertEquals('himansh', $professor->first_name);
        $this->assertNotNull($professor);
    }

    /**
     * test Student Show Method.
     *
     * @return void
     */
    public function testShow()
    {
        $professor = Professor::find(1);
        $this->assertEquals('9177373332', $professor->phone_number);
    }
    
    /**
     * test Student Update Method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $professor = Professor::find(1);
        $professor->email = 'venu1234@gmail.com';
        $professor->update();

        $this->assertEquals('venu1234@gmail.com', $professor->email);
    }

    /**
     * test Student Create Method.
     * test Student RollNumber Generation when Create Method is Fired.
     *
     * @return void
     */
    public function testCreate()
    {
        $professor = new Professor;
        $professor->first_name = 'udaya';
        $professor->middle_name = 'k';
        $professor->last_name = 'choudary';
        $professor->email = 'knr000@yahoo.com';
        $professor->gender = 'Female';
        $professor->dob = '2015-09-06';
        $professor->phone_number = 8167455196;
        $professor->address = '7493 Legros Burg Considinefort, NH 24537';
        $professor->save();

        $this->assertNotNull($professor->roll_number);
        $this->assertContains('knr000@yahoo.com', $professor->email);
    }

    /**
     * test Student Delete Method.
     *
     * @return void
     */
    public function testDelete()
    {
        $professor = Professor::find(1);
        $professor->delete();

        $professor = Professor::all();
        $this->assertCount(0, $professor);
    }
}
