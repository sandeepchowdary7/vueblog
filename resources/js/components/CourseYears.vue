<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Display Students by Course Years <i class="fas fa-calendar-check fa-lg green"></i></h3>

                <div class="card-tools col-md-8"> 
                   <select v-model="selectedYear" @change="userSelectedYear" id="selectedYear" name="selectedYear" style="width: 320px; height: 42px;">
                        <option value="0">Select Course Year</option>
                        <option v-for="year in years" :key="year.id" :value="year.Year" >{{ year.Year }}</option>
                    </select>
                </div>

                <!-- <button @click="clickMe">submit</button> -->
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
          selectedYear: "",
          selected: {},
        }
      },
    mounted() {
      this.getCourseYears();
      },

    methods: {
        getCourseYears() {
        axios.get('/courseYear').then(data => this.years =data.data).catch(error => console.log(error))         
         },
         userSelectedYear() {
          this.selected.year=this.selectedYear;
          axios.post('/getStudents', this.selected).then(selectedYearStudents => console.log(selectedYearStudents));
         }
      }
    }
</script>