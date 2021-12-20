<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('meetings'); ?>
                <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" data-toggle="modal" data-target="#modal-online-timetable"><i class="fa fa-plus"></i> ADD </button>
                   
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

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
                            <?php echo $course->title;?>
                        </td>
                        <td>
                            <?php echo $course->date;?>
                        </td>
                        <td>
                            <?php echo $course->api_type; ?>
                        </td>
                        <td>
                           <?php echo "Self";?>
                        </td>
                        <td>
                            <?php echo $course->ctitle; ?>
                        </td>
                        <td class="text-center">
                            <form class="chgstatus_form" method="POST" action="<?php echo base_url('user/chgstatus') ?>">
                                <input type="hidden" name="conference_id" value="<?php echo $course->mid; ?>">
                                <select class="form-control chgstatus_dropdown" name="chg_status">
                                    <option value="0" <?php if ($course->status == 0) echo "selected='selected'" ?>>Awaited</option>
                                    <option value="1" <?php if ($course->status == 1) echo "selected='selected'" ?>>Cancelled</option>
                                    <option value="2" <?php if ($course->status == 2) echo "selected='selected'" ?>>Finished</option>
                                </select>
                            </form>
                           
                        </td>
                        
                        <td>
                            <?php
                            if ($course->status == 0) {
                                ?>
                                    <a data-placement="left" href="#" class="btn btn-xs label-success start-mr-20" data-toggle="modal" data-target="#modal-chkstatus" data-id="<?php echo $course->mid; ?>">
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


<div class="modal fade" id="modal-online-timetable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 1050;">
    <div class="modal-dialog">
        <form id="form-addconference" action="<?php echo site_url('User/addLiveMeeting'); ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Meetings</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="password" name="password">
                    <input type="hidden" class="form-control" id="role" name="role" value="<?php echo 
                           $roleid; ?>" readonly="">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="title">Meeting Title<small class="req"> *</small></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <span class="text text-danger" id="title_error"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="date">Meeting Date<small class="req"> *</small></label>
                            <div class='input-group' id='meeting_date'>
                                <input type='datetime-local' class="form-control air-datepicker" id="date" name="date" required>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <span class="text text-danger" id="title_error"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="duration">Meeting Duration Minutes<small class="req"> *</small></label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                            <span class="text text-danger" id="title_error"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="class">Role <small class="req"> *</small></label>
                           <input type="text" class="form-control" id="role" name="role" value="Instrutor" readonly="">
                            <span class="text text-danger" id="class_error"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="class">Courses<small class="req"> *</small></label>
                            <select  id="course_id" name="course_id" class="form-control" required >
                                <option value="">Select</option>
                                <?php
                                foreach ($courses as $class) {
                                    ?>
                                    <option value="<?php echo $class['id'] ?>"><?php echo $class['title'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="text text-danger" id="class_error"></span>
                        </div>
                        
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="class">Host Video<small class="req"> *</small></label>
                            <label class="radio-inline"><input type="radio" name="host_video"  value="1" checked>Enable</label>
                            <label class="radio-inline"><input type="radio" name="host_video" value="0" >Disabled</label>
                            <span class="text text-danger" id="class_error"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="class">Client Video<small class="req"> *</small></label>
                            <label class="radio-inline"><input type="radio" name="client_video"  value="1" checked>Enable</label>
                            <label class="radio-inline"><input type="radio" name="client_video" value="0" >Disabled</label>
                            <span class="text text-danger" id="class_error"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving...">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-chkstatus" data-backdrop="static">
    <div class="modal-dialog">
        <form id="form-chkstatus" action="<?php echo base_url('admin/Zoom/chkstatus'); ?>" method="POST">
            <div class="modal-content">
                <div class="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title"> Zoom Details</h4> -->
                </div>
                <div class="modal-body zoom_details">
                  
                </div>
            
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    var password = makeid(5);
    $('#password').val("").val(password);

function makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

$('#modal-chkstatus').on('show.bs.modal', function (e) {
    var $modalDiv = $(e.delegateTarget);
    // var id=$(this).data();
    var base_url = '<?php echo base_url(); ?>';
    var id=$(e.relatedTarget).data('id');
    $.ajax({
        type: "POST",
        url: base_url + 'User/getlivestatus',
        data: {'id':id},
        dataType: "JSON",
        beforeSend: function () {
        $('.zoom_details').html("");
            $modalDiv.addClass('modal_loading');
        },
        success: function (data) {
            $('.zoom_details').html(data.page);
            $modalDiv.removeClass('modal_loading');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $modalDiv.removeClass('modal_loading');
        },
        complete: function (data) {
            $modalDiv.removeClass('modal_loading');
        }
    });
});

$(document).on('change', '.chgstatus_dropdown', function () {
    $(this).parent('form.chgstatus_form').submit()
});

$("form.chgstatus_form").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        dataType: "JSON",
        success: function (data)
        {
            
            if (data.status == 0) {
                var message = "";
                $.each(data.error, function (index, value) {
                    message += value;
                });
                errorMsg(message);
            } else {
               // successMsg(data.message);
                window.location.reload(true);
            }
        }
    });
});

</script>