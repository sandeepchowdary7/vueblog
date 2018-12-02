<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Course Sections</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Course Section <i class="fa fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>SectionName</th>
                    <th><span>Actions</span></th>
                  </tr>

                  <tr v-for="section in sections" :key="section.id">
                    <td>{{ section.Id }}</td>
                    <td>{{ section.SectionName | capitals }}</td>
                    <td>
                        <a href="#" @click="editSection(section)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        <a  href="#" @click="deleteSection(section.Id)">
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
            <div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="addSectionLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"  v-show = "!editmode" id="addSectionLabel">Add Course-Section</h5>
                            <h5 class="modal-title" v-show = "editmode" id="addSectionLabel">Update Course-Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updateSection() : createSection()">
                            <div class="modal-body">
                                
                                <div class="form-group">
                                    <input v-model="form.section_name" placeholder = "Section Name"  type="text" name="section_name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                    <has-error :form="form" field="section_name"></has-error>
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
                sections:{},
                form: new Form ({
                    id: '',
                    section_name: ''
                })
            }
        },
        methods: {
            updateSection() {
                 this.$Progress.start();                 
                 this.form.put('/courseSection/'+ this.form.id).then(() => {
                            swal(
                            'Updated!',
                            'Section Record has been updated.',
                            'success'
                            )
                            $('#addSection').modal('hide')
                             this.$Progress.finish();
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                            this.$Progress.fail();
                        });
            },
            editSection(section) {      
                this.editmode = true;  
                 $('#addSection').modal('show');
                 this.form.id=section.Id;
                 this.form.section_name=section.SectionName;
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                 $('#addSection').modal('show')
            },
            deleteSection (id) {
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
                        this.form.delete('/courseSection/'+id).then(() => {
                            swal(
                            'Deleted!',
                            'Section Record has been deleted.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal("Failed!", "There is something wrong", "warning");
                        });
                    }
                })
            },
            displaySections () {
                axios.get('/courseSection').then (data => (this.sections = data.data));
            },
            createSection () {
                //Progress bar starts before request
                this.$Progress.start();
                    //Sending a POST rqst
                    this.form.post('/courseSection')
                      .then(() => {
                        //Custom Vue Event Firing after a student POST request
                        Fire.$emit('AfterCreate');
                        //Hiding a modal after rqst
                        $('#addSection').modal('hide')
                        // toasting a model after rqst
                        toast({
                            type: 'success',
                            title: 'Section Added successfully'
                        })
                        //Progress bar ends after request
                        this.$Progress.finish();
                    });
            }
        },
        created() {
           this.displaySections ();
           //Custom Vue Event calling after creating a student
            Fire.$on('AfterCreate', () => {
                this.displaySections();
            });
            //send reqst for evry 3sec to update data
        //    setInterval(() => this.displayStudents(), 3000);
        }
    }
</script>
