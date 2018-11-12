<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Course Years</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Course Year <i class="fa fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Year</th>
                  </tr>

                  <tr v-for=" courseYear in courseYears" :key="courseYear.id">
                    <td>{{ courseYear.Id }}</td>
                    <td>{{ courseYear.Year }}</td>
                    <td>
                        <a href="#" @click="editCourseYear(courseYear)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        <a href="#" @click="deleteCourseYear(courseYear.Id)">
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
            <div class="modal fade" id="addCourseYear" tabindex="-1" role="dialog" aria-labelledby="addCourseYearLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode" id="addCourseYearLabel">Add Course Year</h5>
                            <h5 class="modal-title" v-show="editmode" id="addCourseYearLabel">Update Add Course Year</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updateCourseYear() : createCourseYear()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="form.year" type="tel" name="phone_number"
                                        placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                    <has-error :form="form" field="phone_number"></has-error>
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
                CourseYear:{},
                form: new Form ({
                    id:'',
                    year: '',
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
                axios.get('/course-years').then(data => (this.professors = data.data));
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