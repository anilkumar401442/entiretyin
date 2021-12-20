<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!--<h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Add_Promocode'); ?></h4>-->
                <div class="row">
                    <div class="col-md-6">
                       <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Add_Promocode'); ?></h4>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo site_url('admin/promocode'); ?>" class="alignToTitle btn btn-outline-secondary btn-rounded btn-sm my-1"> <i class=" mdi mdi-keyboard-backspace"></i> <?php echo get_phrase('back_to_promocode_list'); ?></a>
                    </div>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('promocode_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/save_promocode'); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="user_id"><?php echo get_phrase('Promocode'); ?><span class="required">*</span> </label>
						<input type="text" class="form-control" name="promocode" id="promocode" required>
                    </div>
					 <div class="form-group">
                        <label for="user_id"><?php echo get_phrase('Amount'); ?><span class="required">*</span> </label>
						<input type="text" class="form-control" name="promo_amount" id="promo_amount" required>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('add_Promocode'); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
