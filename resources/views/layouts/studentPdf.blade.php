<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Student Details</title>
  </head>
  <body>
    <table class="table table-bordered">
      <tr>
        <td>
          {{$student->id}}
        </td>
        <td>
          {{$student->first_name}}
        </td>
        <td>
          {{$student->middle_name}}
        </td>
        <td>
          {{$student->last_name}}
        </td>
        <td>
          {{$student->guardian_name}}
        </td>
        <td>
          {{$student->roll_number}}
        </td>
        <td>
          {{$student->gender}}
        </td>
        <td>
          {{$student->dob}}
        </td>
        <td>
          {{$student->is_active}}
        </td>
        <td>
          {{$student->contact_number}}
        </td>
        <td>
          {{$student->address}}
        </td>
        <td>
          {{$student->graduated_year}}
        </td>
      </tr>
    </table>
  </body>
</html>

<th>ID</th>
<th>First Name</th>
<th>Middle Name</th>
<th>Last Name</th>
<th>Guardian Name</th>
<th>Roll Number</th>
<th>Gender</th>
<th>Date of Birth</th>
<th>Contact Number</th>
<th>Address</th>
<th>Graduated Year</th>
<th><span>Actions</span></th>