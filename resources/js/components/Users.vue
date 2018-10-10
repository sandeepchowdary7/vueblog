<template>
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addUser">Add User <i class="fa fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                  </tr>
                  <tr>
                    <td>183</td>
                    <td>John Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">Modify</span></td>
                    <td>
                        <a href="#">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        <a href="#">
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
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserLabel">Add User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <input placeholder = "First Name"  type="text" name="firstname"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('firstname') }">
                                <has-error :form="form" field="firstname"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.lastname" type="text" name="lastname"
                                    placeholder = "Last Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('lastname') }">
                                <has-error :form="form" field="lastname"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.username" type="text" name="username"
                                    placeholder = "User Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                                <has-error :form="form" field="username"></has-error>
                            </div>

                             <div class="form-group">
                                <input  type="password" name="password"
                                    placeholder = "Password"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"
                                    placeholder = "Email Address" autocomplete="off" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <select v-model="form.type" id="email" name="type"
                                    placeholder = "type"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="" selected>Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.bio" name="bio" id="bio"
                                placeholder = "Short Bio for user (Optional)"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data () {
            return {
                form: new Form ({
                    firstname: '',
                    lastname: '',
                    email: '',
                    username: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        mounted() {
            console.log('Users Component mounted.')
        }
    }
</script>
