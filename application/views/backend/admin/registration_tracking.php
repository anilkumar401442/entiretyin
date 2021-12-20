<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('Registration Tracking'); ?></h4>
				<form class="row justify-content-center" action="<?php echo site_url('admin/registration_tracking'); ?>" method="get">
                    <!-- Course Categories -->
                    <div class="col-xl-5">
                        <div class="form-group">
                            <label for="category_id"><?php echo get_phrase('Courses'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="course_id" id="course_id">
                                <option value="">Select</option>
                                <?php foreach ($courses as $co): ?>
                                        <option value="<?php echo $co['id']; ?>" ><?php echo $co['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="form-group">
                        <label for="instructor_id"><?php echo get_phrase('Date'); ?></label>
                        <select class="form-control select2" data-toggle="select2" name="date" id='date'>
                            <option value="">Select</option>
                            <?php foreach ($tracks as $tr): ?>
                                <option value="<?php echo $tr['createdon']; ?>"><?php echo date('d-m-Y',strtotime($tr['createdon'])); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-xl-2">
                    <label for=".." class="text-white">..</label>
                    <button type="submit" class="btn btn-primary btn-block" id="track_export" name="button"><?php echo get_phrase('Download Excel'); ?></button>
                </div>
            </form>
                <div class="table-responsive-sm mt-4">
                    <table id="track-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Student Name'); ?></th>
								<th><?php echo get_phrase('Email'); ?></th>
								<th><?php echo get_phrase('Mobile'); ?></th>
                                <th><?php echo get_phrase('Course Name'); ?></th>
								<th><?php echo get_phrase('Date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--<?php
                            foreach ($tracks as $key => $tr): ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $tr['first_name']; ?></td>
                                <td><?php echo $tr['title']; ?></td>
								<td><?php echo date('d-m-Y',strtotime($tr['createdon'])); ?></td>
                            </tr>
                        <?php endforeach; ?>-->
                    </tbody>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>