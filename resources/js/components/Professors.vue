<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Professors</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Professor <i class="fa fa-user-plus fa-fw"></i></button>
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
                    <th>Roll Number</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th><span>Actions</span></th>
                  </tr>

                  <tr v-for=" professor in professors" :key="professor.id">
                    <td>{{ professor.Id }}</td>
                    <td>{{ professor.FirstName | capitalize }}</td>
                    <td>{{ professor.MiddleName | capitalize }}</td>
                    <td>{{ professor.LastName | capitalize}}</td>
                    <td>{{ professor.RollNumber }}</td>
                    <td>{{ professor.Gender }}</td>
                    <td>{{ professor.DateofBirth | myDate }}</td>
                    <td>{{ professor.PhoneNumber }}</td>
                    <td>{{ professor.Address }}</td>
                    <td>
                        <a href="#" @click="editProfessor(professor)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        <a href="#" @click="deleteProfessor(professor.Id)">
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
            <div class="modal fade" id="addProfessor" tabindex="-1" role="dialog" aria-labelledby="addProfessorLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode" id="addProfessorLabel">Add Professor</h5>
                            <h5 class="modal-title" v-show="editmode" id="addProfessorLabel">Update Professor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editProfessor ? updateProfessor() : createProfessor()">
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
                                    <select v-model="form.gender" id="gender" name="gender"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                                        <option value="" selected>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
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
                                    <input v-model="form.email" type="email" name="email"
                                        placeholder = "Email" autocomplete="off" 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.phone_number" type="tel" name="phone_number"
                                        placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                    <has-error :form="form" field="phone_number"></has-error>
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
                                <button type="submit" v-show="!editmode" class="btn btn-primary">Create</button>
                                <button type="submit" v-show= "editmode" class="btn btn-success">Update</button>
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
                professors:{},
                form: new Form ({
                    id:'',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    gender: '',
                    dob: '',
                    email: '',
                    phone_number: '',
                    address: '',
                })
            }
        },
        methods: {
            updateProfessor() {
                this.$Progress.start();
                this.form.put('/professor/'+this.form.id).then(() => {
                            swal(
                            'Updated!',
                            'Professor Record has been updated.',
                            'success'
                            )
                            $('#addProfessor').modal('hide');
                            Fire.$emit('AfterCreate');
                            this.$Progress.finish();
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                            this.$Progress.fail();
                        });
            },
            editProfessor(professor) {
                this.editmode = true;
                 $('#addProfessor').modal('show');
                 this.form.id=professor.Id;
                 this.form.first_name=professor.FirstName;
                 this.form.middle_name=professor.MiddleName;
                 this.form.last_name=professor.LastName;
                 this.form.gender=professor.Gender;
                 this.form.dob= professor.DateofBirth;
                 this.form.email=professor.Email;
                 this.form.phone_number=professor.PhoneNumber;
                 this.form.address=professor.Address;
            },
            newModal() {
                this.editmode = false;
                 this.form.reset();
                 $('#addProfessor').modal('show');
            },
            deleteProfessor(id) {
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
                        this.form.delete('/professor/'+id).then(() => {
                            swal(
                            'Deleted!',
                            'Professor Record has been deleted.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                        });
                    }
                })
            },
            displayProfessors () {
                axios.get('/professor').then(data => (this.professors = data.data));
            },
            createProfessor () {
                //Progress bar starts before request
                this.$Progress.start();
                this.form.post('/professor')
                    .then(() => {
                        //Custom Vue Event Firing after a professor POST request
                        Fire.$emit('AfterCreate');
                        //Hiding a modal after rqst
                        $('#addProfessor').modal('hide')
                        // toasting a model after rqst
                        toast({
                            type: 'success',
                            title: 'Professor Created successfully'
                        })
                        //Progress bar ends after request
                        this.$Progress.finish();
                    })
                    .catch(() =>{
                    })
            }
        },
        created() {
           this.displayProfessors();

           //Custom Vue Event calling after creating a professor
            Fire.$on('AfterCreate', () => {
                this.displayProfessors();
            });
           //send reqst for evry 3sec to update data
        //    setInterval(() => this.displayProfessors(), 3000);
        }
    }
</script>