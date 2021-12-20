
<?php

$url = "";
    $extracls="";
if ($live[0]->purpose == "meeting") {
    $name = ($live[0]->creted_by_name == "") ? $live[0]->creted_by_name : $live[0]->creted_by_name . " " . $live[0]->creted_by_name;
} else {
    $name = ($live[0]->create_for_name == "") ? $live[0]->create_for_name : $live[0]->create_for_name ;
}
if ($api_Response->status == "waiting") {
    $st_label = "label label-warning";
} elseif ($api_Response->status == "started") {
    $st_label = "label label-success";
}
?>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="modal-header zoommodal-title">
            <h4 class="modal-title"><?php echo $live[0]->title; ?></h4>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <label>
            <span class="labalblock">Host</span><br> 
            <span class="text-dark robo-normal"><?php echo $name; ?></span>
        </label>
    </div>

    <div class="col-lg-4 col-md-4">
        <label>
            <span class="labalblock">Date</span><br> 
            <span class="text-dark robo-normal"><?php echo $live[0]->date; ?></span>
        </label>
    </div>

    <div class="col-lg-4 col-md-4">
        <label>
            <span class="labalblock">Duration</span><br>
            <span class="text-dark robo-normal"><?php echo $live[0]->duration; ?></span>
        </label>
    </div>
    <div class="zoommodal-border">
        <label class="pull-left minus7top">
            <span class="labalblock">Status</span><br>
            <span class="text-dark robo-normal"><i class="icofont-video-cam"></i><?php echo $api_Response->status; ?></span>
        </label>
    </div>

 
<?php
if ($api_Response->status == "started") {
    if ($conference_setting[0]['use_zoom_app']) {
      ?>
    <a data-placement="left" href="<?php echo $live_url->join_url; ?>" class="btn btn-outline-success btn-sm pull-right join-btn" data-id="<?php echo $live[0]->mid; ?>" target="_blank">
    <i class="icofont-video-cam"></i> <?php echo "Join"." "."Now";?>
   </a>
<?php 
}
}

?>
</div>

<script type="text/javascript">
    // $(document).on('click', 'a.join-btn', function (e) {
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     var type="class";
    //     var url = $(this).attr('href');
    //     $.ajax({
    //         url: "<?php echo site_url("admin/Zoom/add_history") ?>",
    //         type: "POST",
    //         data: {"id": id,"type":type},
    //         dataType: 'json',
    //         beforeSend: function () {
    //         },
    //         success: function (res)
    //         {
    //             if (res.status == 0) {
    //             } else if (res.status == 1) {
    //                 window.open(url, '_blank');
    //             }
    //         },
    //         error: function (xhr) {
    //             alert("Error occured.please try again");
    //         },
    //         complete: function () {
    //         }
    //     });
    // });
</script>