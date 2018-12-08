<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Exam Schedule</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Exam Date <i class="fa fa-user-plus fa-fw"></i></button>
                    <!-- <button class="btn btn-info" @click="exportStudents">Download<i class="fa fa-file-download fa-fw"></i></button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Exam Date</th>
                    <th>Subject Name</th>
                    <th>Course Year</th>
                    <th><span>Actions</span></th>
                  </tr>

                  <tr v-for="exam in exams" :key="exam.id">
                    <td>{{ exam.Id }}</td>
                    <td>{{ exam.ExamDate }}</td>
                    <td>{{ exam.Subject.SubjectName }}</td>
                    <td>{{ exam.CourseYear.CourseYearYear }}</td>
                    <td>
                        <a href="#" @click="editExam(exam)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        <a  href="#" @click="deleteExam(exam.Id)">
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
            <div class="modal fade" id="addExam" tabindex="-1" role="dialog" aria-labelledby="addExamLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"  v-show = "!editmode" id="addExamLabel">Add Exam Date</h5>
                            <h5 class="modal-title" v-show = "editmode" id="addExamLabel">Update Exam Date</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updateExam() : createExam()">
                            <div class="modal-body">
                                
                                <div class="form-group">
                                    <input v-model="form.exam_date" placeholder = "Exam Date"  type="text" name="exam_date"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('exam_date') }">
                                    <has-error :form="form" field="first_name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.subject_name" placeholder = "Subject Name"  type="text" name="subject_name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('subject_name') }">
                                    <has-error :form="form" field="subject_name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.course_year" type="text" name="course_year"
                                        placeholder = "Course Year"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('course_year') }">
                                    <has-error :form="form" field="course_year"></has-error>
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
                exams:{},
                form: new Form ({
                    id: '',
                    exam_date: '',
                    subject_name: '',
                    course_year: ''
                })
            }
        },
        methods: {
            updateExam() {
                 this.$Progress.start();                 
                 this.form.put('/exam/'+ this.form.id).then(() => {
                            swal(
                            'Updated!',
                            'Exam Record has been updated.',
                            'success'
                            )
                            $('#addExam').modal('hide')
                             this.$Progress.finish();
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                            this.$Progress.fail();
                        });
            },
            editExam(exam) {      
                this.editmode = true;  
                 $('#addExam').modal('show');
                 this.form.id=exam.Id;
                 this.form.exam_date=exam.ExamDate;
                 this.form.subject_name=exam.Subject.SubjectName;
                 this.form.course_year=exam.CourseYear.CourseYearYear;
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                 $('#addExam').modal('show')
            },
            deleteExam (id) {
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
                        this.form.delete('/exam/'+id).then(() => {
                            swal(
                            'Deleted!',
                            'Exam Record has been deleted.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                        });
                    }
                })
            },
            displayExamDates () {
                axios.get('/exam').then (data => (this.exams = data.data));
            },
            createExam () {
                //Progress bar starts before request
                this.$Progress.start();
                    //Sending a POST rqst
                    this.form.post('/exam')
                      .then(() => {
                        //Custom Vue Event Firing after a student POST request
                        Fire.$emit('AfterCreate');
                        //Hiding a modal after rqst
                        $('#addExam').modal('hide')
                        // toasting a model after rqst
                        toast({
                            type: 'success',
                            title: 'Exam Added successfully'
                        })
                        //Progress bar ends after request
                        this.$Progress.finish();
                    });
            }
        },
        created() {
           this.displayExamDates ();
           //Custom Vue Event calling after creating a student
            Fire.$on('AfterCreate', () => {
                this.displayExamDates();
            });
        }
    }
</script>
