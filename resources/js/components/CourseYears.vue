<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Display Students by Course Years <i class="fas fa-calendar-check fa-lg green"></i></h3>

                <div class="card-tools col-md-8"> 
                   <select v-model="selectedYear" @change="userSelectedYear(selectedYear)" id="selectedYear" name="selectedYear" style="width: 320px; height: 42px;">
                        <option value="0" selected>Select Course Year</option>
                        <option v-for="year in years" :key="year.Id">{{ year.Year }}</option>
                    </select>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Roll Number</th>
                    <th>Course Group</th>
                    <th>Course Year</th>
                  </tr>

                <tr v-for="student in students" :key="student.id">
                    <td>{{ student.Id }}</td>
                    <td>{{ student.FirstName | capitalize }}</td>
                    <td>{{ student.LastName | capitalize}}</td>
                    <td>{{ student.RollNumber}}</td>
                    <td>{{ student.GroupName }}</td>
                     <td>{{ selectedYear }}</td>
                  </tr>

                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
</template>

<script>
    export default {
      data() {
        return {
          year: 0,
          years: {},
          selectedYear: {},
          selected: {},
          students: {},
          groupname: {}
        }
      },
    mounted() {
      this.getCourseYears();
      },

    methods: {
        getCourseYears() {
        axios.get('/courseYear').then(data => this.years =data.data).catch(error => console.log(error))         
         },
         userSelectedYear(obj) {
          this.selected.year=this.selectedYear;
          axios.post('/getStudents', this.selected).then(selectedYearStudents => this.students = selectedYearStudents.data).catch(error => console.log(error));
         }
      }
    }
</script>