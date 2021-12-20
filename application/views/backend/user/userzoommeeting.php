<div class="table-responsive-sm mt-4">
   
        <table id="course-datatable" class="table table-striped dt-responsive nowrap" width="100%" data-page-length='25'>
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo get_phrase('title'); ?></th>
                    <th><?php echo get_phrase('date'); ?></th>
                    <th><?php echo get_phrase('api_used'); ?></th>
                    <th><?php echo get_phrase('created_by'); ?></th>
                    <th><?php echo get_phrase('course'); ?></th>
                    <th><?php echo get_phrase('status'); ?></th>
                    <th><?php echo get_phrase('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($meeting_data as $key => $course):
                    // $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
                    // $category_details = $this->crud_model->get_category_details_by_id($course['sub_category_id'])->row_array();
                    // $sections = $this->crud_model->get_section('course', $course['id']);
                    // $lessons = $this->crud_model->get_lessons('course', $course['id']);
                    // $enroll_history = $this->crud_model->enrol_history($course['id']);
                    // if ($course['status'] == 'draft') {
                    //     continue;
                    // }
                ?>
                    <tr>
                        <td><?php echo ++$key; ?></td>
                        <td>
                            <?php echo $course['title'];?>
                        </td>
                        <td>
                            <?php echo $course['date'];?>
                        </td>
                        <td>
                            <?php echo $course['api_type']; ?>
                        </td>
                        <td>
                           <?php echo "Self";?>
                        </td>
                        <td>
                            <?php echo $courses[0]['title']; ?>
                        </td>
                        <td class="text-center">
                            <form class="chgstatus_form" method="POST" action="<?php echo base_url('admin/Zoom/chgstatus') ?>">
                                <input type="hidden" name="conference_id" value="<?php echo $course['id']; ?>">
                                <select class="form-control chgstatus_dropdown" name="chg_status">
                                    <option value="0" <?php if ($course['status'] == 0) echo "selected='selected'" ?>>Awaited</option>
                                    <option value="1" <?php if ($course['status'] == 1) echo "selected='selected'" ?>>Cancelled</option>
                                    <option value="2" <?php if ($course['status'] == 2) echo "selected='selected'" ?>>Finished</option>
                                </select>
                            </form>
                           
                        </td>
                        
                        <td>
                            <?php
                            if ($course['status'] == 0) {
                                ?>
                                    <a data-placement="left" href="#" class="btn btn-xs label-success start-mr-20" data-toggle="modal" data-target="#modal-chkstatus" data-id="<?php echo $course['mid']; ?>">
                                    <span class="label" ><i class="icofont-video-cam"></i> Start</span>     
                                    </a> 

                                    
                                <?php                                             }
                            ?>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php if (count($courses) == 0): ?>
        <div class="img-fluid w-100 text-center">
         
          <?php echo get_phrase('no_data_found'); ?>
        </div>
    <?php endif; ?>
</div>