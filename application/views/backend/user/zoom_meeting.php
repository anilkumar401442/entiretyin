<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
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
                <?php foreach ($meetingList as $key => $course):
                    if(!empty($course->title)){
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
                           <?php echo $course->created_by_name;?>
                        </td>
                        <td>
                            <?php echo $course->course_name; ?>
                        </td>
                        <td class="text-center">
                                <input type="hidden" name="conference_id" value="<?php echo $course->mid; ?>">
                                 <?php if ($course->status == 0){
                                    echo "Awaited";
                                 }else if($course->status == 1){
                                    echo "Cancelled";
                                 }else if($course->status == 2){
                                    echo "Finished";
                                 }?>
                           
                        </td>
                        
                        <td>
                            <?php
                            if ($course->status == 0) {
                                ?>
                                    <a data-placement="left" href="#" class="btn btn-xs label-success start-mr-20" data-toggle="modal" data-target="#modal-chkstatus" data-id="<?php echo $course->mid; ?>">
                                    <span class="label" ><i class="icofont-video-cam"></i> Join</span>     
                                    </a> 

                                    
                                <?php                                             }
                            ?>
                        </td>
                        
                    </tr>
                <?php } endforeach; ?>
            </tbody>
        </table>
</div>

<div class="modal fade" id="modal-chkstatus" data-backdrop="static">
    <div class="modal-dialog">
        <form id="form-chkstatus" action="<?php echo base_url(''); ?>" method="POST">
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

    $('#modal-chkstatus').on('show.bs.modal', function (e) {
    var $modalDiv = $(e.delegateTarget);
    // var id=$(this).data();
    var base_url = '<?php echo base_url(); ?>';
    var id=$(e.relatedTarget).data('id');
    $.ajax({
        type: "POST",
        url: base_url + 'User/getUserlivestatus',
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

$(document).on('click', 'a.join-btn', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var url = $(this).attr('href');
    $.ajax({
        url: "<?php echo site_url("user/add_history") ?>",
        type: "POST",
        data: {"id": id},
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (res)
        {
            if (res.status == 0) {
            } else if (res.status == 1) {
                window.open(url, '_blank');
            }
        },
        error: function (xhr) {
            alert("Error occured.please try again");
        },
        complete: function () {
        }
    });
});


</script>