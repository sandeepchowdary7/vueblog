<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Students</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Student <i class="fa fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
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
                  </tr>

                  <tr v-for="student in students" :key="student.id">
                    <td>{{ student.Id }}</td>
                    <td>{{ student.FirstName | capitalize }}</td>
                    <td>{{ student.MiddleName | capitalize }}</td>
                    <td>{{ student.LastName | capitalize}}</td>
                    <td>{{ student.GaurdianName | capitalize}}</td>
                    <td>{{ student.RollNumber }}</td>
                    <td>{{ student.Gender }}</td>
                    <td>{{ student.DateofBirth | myDate }}</td>
                    <td>{{ student.ContactNumber }}</td>
                    <td>{{ student.Address }}</td>
                    <td>{{ student.GraduatedYear }}</td>
                    <td>
                        <a href="#" @click="editStudent(student)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        <a  href="#" @click="deleteStudent(student.Id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
                    <!-- Modal -->
            <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="addStudentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"  v-show = "!editmode" id="addStudentLabel">Add Student</h5>
                            <h5 class="modal-title" v-show = "editmode" id="addStudentLabel">Update Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updateStudent() : createStudent()">
                            <div class="modal-body">
                                
                                <div class="form-group">
                                    <input v-model="form.first_name" placeholder = "First Name"  type="text" name="first_name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                    <has-error :form="form" field="first_name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.middle_name" placeholder = "Middle Name"  type="text" name="middle_name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('middle_name') }">
                                    <has-error :form="form" field="middle_name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.last_name" type="text" name="last_name"
                                        placeholder = "Last Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
                                    <has-error :form="form" field="last_name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.guardian_name" type="text" name="guardian_name"
                                        placeholder = "Guardian Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('guardian_name') }">
                                    <has-error :form="form" field="guardian_name"></has-error>
                                </div>

                                <div class="form-group">
                                    <select v-model="form.gender" id="gender" name="gender"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                                        <option value="" selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <has-error :form="form" field="gender"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.dob" type="date" name="dob"
                                        placeholder = "Date of Birth"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('dob') }">
                                    <has-error :form="form" field="dob"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.contact_number" type="tel" name="contact_number"
                                        placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                                    <has-error :form="form" field="contact_number"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.graduated_year" type="date"  min="2018" max="2030" id="Graduated Year"
                                    placeholder = "Expected Graduated Year" rows="4" cols="50"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('graduated_year') }">
                                    <has-error :form="form" field="graduated_year"></has-error>
                                </div>

                                <div class="form-group">
                                    <textarea v-model="form.address" name="address" id="address"
                                    placeholder = "Write Address" rows="4" cols="50"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                    <has-error :form="form" field="address"></has-error>
                                </div>

                            </div> 
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data () {
            return {
                editmode: false,
                students:{},
                form: new Form ({
                    id: '',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    guardian_name: '',
                    gender: '',
                    dob: '',
                    contact_number: '',
                    address: '',
                    graduated_year: ''
                })
            }
        },
        methods: {
            updateStudent() {
                 this.$Progress.start();                 
                 this.form.put('/student/'+ this.form.id).then(() => {
                            swal(
                            'Updated!',
                            'Student Record has been updated.',
                            'success'
                            )
                            $('#addStudent').modal('hide')
                             this.$Progress.finish();
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                            this.$Progress.fail();
                        });
            },
            editStudent(student) {      
                this.editmode = true;  
                 $('#addStudent').modal('show');
                 this.form.id=student.Id;
                 this.form.first_name=student.FirstName;
                 this.form.middle_name=student.MiddleName;
                 this.form.last_name=student.LastName;
                 this.form.guardian_name=student.GaurdianName;
                 this.form.gender=student.Gender;
                 this.form.dob= student.DateofBirth;
                 this.form.is_active=student.is_active;
                 this.form.contact_number=student.ContactNumber;
                 this.form.address=student.Address;
                 this.form.graduated_year=student.GraduatedYear;
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                 $('#addStudent').modal('show')
            },
            deleteStudent (id) {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        this.form.delete('/student/'+id).then(() => {
                            swal(
                            'Deleted!',
                            'Student Record has been deleted.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                        });
                    }
                })
            },
            displayStudents () {
                axios.get('/student').then (data => (this.students = data.data));
            },
            createStudent () {
                //Progress bar starts before request
                this.$Progress.start();
                    //Sending a POST rqst
                    this.form.post('/student')
                      .then(() => {
                        //Custom Vue Event Firing after a student POST request
                        Fire.$emit('AfterCreate');
                        //Hiding a modal after rqst
                        $('#addStudent').modal('hide')
                        // toasting a model after rqst
                        toast({
                            type: 'success',
                            title: 'Student Added successfully'
                        })
                        //Progress bar ends after request
                        this.$Progress.finish();
                    });
            }
        },
        created() {
           this.displayStudents ();
           //Custom Vue Event calling after creating a student
            Fire.$on('AfterCreate', () => {
                this.displayStudents();
            });
            //send reqst for evry 3sec to update data
        //    setInterval(() => this.displayStudents(), 3000);
        }
    }
</script>
