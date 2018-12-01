<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Display Students by Course Groups <i class="fas fa-calendar-check fa-lg green"></i></h3>

                <div class="card-tools col-md-8"> 
                   <select v-model="selectedGroup" @change="userSelectedGroupName(selectedGroup)" id="selectedGroup" name="selectedGroup" style="width: 320px; height: 42px;">
                        <option value="0" :selected="true">Select Course Group</option>
                        <option v-for="groupname in groupnames" :key="groupname.Id">{{ groupname.Group }}</option>
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
                    <td>{{ selectedGroup }}</td>
                    <td>{{ student.CourseYear }}</td>
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
          groupname: {},
          groupnames: {},
          selectedGroup: {},
          selected: {},
          students: {},
          year: {}
        }
      },
    mounted() {
      this.getCourseGroups();
      },

    methods: {
        getCourseGroups() {
        axios.get('/courseGroup').then(data => this.groupnames =data.data).catch(error => console.log(error))   
         },
         userSelectedGroupName(obj) {
          this.selected.groupname=this.selectedGroup;
          axios.post('/getStudentsByGroup', this.selected).then(selectedGroupStudents => this.students = selectedGroupStudents.data).catch(error => console.log(error));
         }
      }
    }
</script>