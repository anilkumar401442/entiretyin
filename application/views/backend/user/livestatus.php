
<?php

$url = "";
    $extracls="";
if ($live[0]->purpose == "meeting") {
    $name = ($live[0]->creted_by_name == "") ? $live[0]->creted_by_name : $live[0]->creted_by_name . " " . $live[0]->creted_by_name;
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
            <span class="text-dark robo-normal"><?php echo  $live[0]->creted_by_name; ?></span>
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

</div>
 
<?php
if ($live[0]->status == 0) {
    if ($live[0]->created_id == $logged_staff_id && ($live[0]->purpose == "meeting")) {
        $label_display = "Start"." "."Now";
        $label_type = 'label-success';
    }if ($live[0]->created_id != $logged_staff_id && ($live[0]->purpose == "meeting")) {
        $label_display = "Join"." "."Now";
        $label_type = 'label-success';
    } $label_type = 'label-success';
    }

if ($api_Response->status == "waiting" ) {
    $target = "";
    if ($conference_setting[0]['use_zoom_app']) {
        $target = "_blank";
        if ($live[0]->purpose == "meeting") {
            if ($live[0]->created_id == $logged_staff_id) {
                $url = $live_url->start_url;
            } else {
                $url = $live_url->join_url;
            }
        }
    } else {
        //     if ($live[0]->purpose == "meeting") {
        //     $url = site_url('admin/Zoom/join/meeting' . '/' . $live[0]->id);
        // }
    }
    
}

if ($api_Response->status == "started") {
    $target = "";
    if ($conference_setting[0]['use_zoom_app']) {
        $target = "_blank";
        if ($live[0]->purpose == "meeting") {
            if ($live[0]->created_id == $logged_staff_id) {
                $url = $live_url->start_url;
            } else {
                $extracls="join-btn";
                $url = $live_url->join_url;
            }
        }
    } else {
        // if ($live->purpose == "meeting") {
        //     $url = site_url('admin/Zoom/join/meeting' . '/' . $live[0]->id);
        // }
    }
}
?>


<?php
if ($api_Response->status == "waiting") {
    if (($live[0]->created_id == $logged_staff_id) && $live[0]->purpose == "meeting") {
        ?>
   <div class="zoommodal-border">
            <label class="pull-left minus7top">
                <span class="labalblock">Status</span><br><span class="font-w-normal <?php echo $st_label; ?>"><i class="fa fa-video-camera"></i> <?php echo "Waiting" ?></span>
            </label>
        <a data-placement="left" href="<?php echo $url; ?>" class="btn btn-outline-success btn-sm pull-right" target="<?php echo $target; ?>">
            <i class="fa fa-video-camera"></i> <?php echo $label_display; ?>
        </a>
      </div>
        <?php
    } elseif ( ($live[0]->created_id != $logged_staff_id) && $live[0]->purpose == "meeting") {?>
        <div class="zoommodal-border">
            <label class="pull-left minus7top">
                <span class="labalblock">Status</span><br><span class="font-w-normal <?php echo $st_label; ?>"><i class="icofont-video-cam"></i> <?php echo $api_Response->status ?></span>
            </label>
            <a data-placement="left" href="<?php echo $url; ?>" class="btn btn-outline-success btn-sm pull-right" target="<?php echo $target; ?>">
                <i class="icofont-video-cam"></i> <?php echo $label_display; ?>
            </a>
        </div>
   <?php }?>
<?php }

if ($api_Response->status == "started") {

    if (($live[0]->created_id == $logged_staff_id) && $live[0]->purpose == "meeting") {

        ?>
        <div class="zoommodal-border">
            <label class="pull-left minus7top">
                <span class="labalblock">Status</span><span class="font-w-normal <?php echo $st_label; ?>"><i class="icofont-video-cam"></i> <?php echo $api_Response->status ?></span>
            </label>
            <a data-placement="left" href="<?php echo $url; ?>" class="btn btn-outline-success btn-sm pull-right" target="<?php echo $target; ?>">
                <i class="icofont-video-cam"></i>Join
            </a>
        </div>
        <?php
        
    } elseif ( ($live[0]->created_id != $logged_staff_id) && $live[0]->purpose == "meeting") {
        ?>
      <div class="zoommodal-border">
            <label class="pull-left minus7top">
                <span class="labalblock"><?php echo "Status"; ?></span><span class="font-w-normal <?php echo $st_label; ?>"><i class="icofont-video-cam"></i> <?php echo $api_Response->status; ?></span>
            </label>
            <a data-placement="left" href="<?php echo $url; ?>" class="btn btn-outline-success btn-sm pull-right <?php echo $extracls; ?>" data-id="<?php echo $live[0]->id;?>" target="<?php echo $target; ?>">
                <i class="icofont-video-cam"></i> <?php echo $label_display; ?>
            </a>
        </div>
        <?php
    } 
}
?>