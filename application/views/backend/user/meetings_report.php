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
                    <th><?php echo get_phrase('total_joins'); ?></th>
                    <th><?php echo get_phrase('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($meetingList as $key => $course):
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
                                 <?php echo $course->total_viewers;?>
                           
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-default btn-xs viewer-list" id="load"  data-recordid="<?php echo $course->mid; ?>" title="<?php echo 'Join'; ?>" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-list"></i></button>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>

<div id="viewerModal" class="modal fade modalmark" role="dialog">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

 $(document).on('click', '.viewer-list', function () {
    var $this = $(this);
    var base_url = '<?php echo base_url(); ?>';
    var recordid = $this.data('recordid');
    $.ajax({
        type: 'POST',
        url: base_url + "user/getViewerList",
        data: {'recordid': recordid},
        dataType: 'JSON',
        beforeSend: function () {
            $this.button('loading');
        },
        success: function (data) {
            $('#viewerModal .modal-body').html(data.page);
            $('#viewerModal').modal('show');
        },
        error: function (xhr) {
            alert("Error occured.please try again");
            $this.button('reset');
        },
        complete: function () {
            $this.button('reset');
        }
    });
});



</script>