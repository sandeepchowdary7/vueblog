<template>
    <div class="container-fluid">
      <div class="row card justify-content-center mt-3">
        <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info-active">
                <h3 class="widget-user-username">Sandeep Choudary</h3>
                <h5 class="widget-user-desc">Fullstack Developer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="/img/author.png" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
                  </div>
            </div>
        </div>
        <div class="row card mt-3">
            <ul class="card-header nav nav-pills">
                  <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
              <div class="card-body col-md-12">
                  <div class="tab-content">
                    <div class="tab-pane active show" id="activity">
                      <!-- Post -->
                      <div class="post">
                        <p>
                          Nothing to display here.
                        </p>
                      </div>
                      <!-- /.post -->


                    </div>

                    <div class="tab-pane col-md-12" id="settings">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Name</label>
                          <div class="col-sm-12">
                            <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Enter Name">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-12">
                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputBio" class="col-sm-2 control-label">Bio</label>
                          <div class="col-sm-12">
                            <input type="text" v-model="form.bio" class="form-control" id="inputBio" placeholder="Bio">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputType" class="col-sm-2 control-label">Type</label>
                          <div class="col-sm-12">
                            <select name="myvalue">
                              <option value=" " selected="selected">--select type--</option>
                              <option value="user" >user</option>
                              <option value="admin">admin</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="fileUpload" class="col-sm-2 control-label">File Upload -- (optional)</label>
                          <div class="col-sm-12">
                          <input type="file" class="form-control-file" id="fileUpload" placeholder="Upload File">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-12">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                <!-- /.tab-content -->
              </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
              users:{},
              form: new Form ({
                    id: '',
                    name: '',
                    email: '',
                    bio: '',
                    type: '',
                    photo: '',
              })
            }
        },
        mounted() {
            console.log('profile Component mounted.')
        },
        created() {
           axios.get('/profile')
            .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>