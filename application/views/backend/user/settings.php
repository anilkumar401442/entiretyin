
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> Settings</h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title">Zoom Credentials Add Form</h4>

                <form class="required-form" action="<?php echo site_url('user/zoom_settings'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="uid" name="uid" value="<?php if(!empty($settings[0]['id'])) echo $settings[0]['id']; ?>"> 
                    <div class="form-group">
                        <label for="code">Zoom Api key</label><span class="required">*</span>
                        <input type="text" class="form-control" id="zoom_api_key" name="zoom_api_key" value="<?php if(!empty($settings[0]['zoom_api_key'])) echo $settings[0]['zoom_api_key']; ?>" required="">
                    </div>

                    <div class="form-group">
                        <label for="name">Zoom Api Secret<span class="required">*</span></label>
                        <input type="text" class="form-control" id="zoom_api_secret" value="<?php if(!empty($settings[0]['zoom_api_secret'])) echo $settings[0]['zoom_api_secret']; ?>" name="zoom_api_secret" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>