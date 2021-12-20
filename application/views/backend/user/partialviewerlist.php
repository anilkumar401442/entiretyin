<div class="downloadlabel hide" id="downloadlabel"><h4><?php echo 'Join List'; ?></h4></div>
<?php
if (!empty($viewerDetail)) {
        ?>
         <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered viewer-list-datatable">
                <thead>
                    <tr>
                        <th><?php echo 'Peoples'; ?></th>
                        <th class="pull-right"><?php echo 'Last Join'; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($viewerDetail as $viewer_key => $viewer_value) {
                        ?>
                        <tr>
                            <td> 
                                <?php
                                echo $viewer_value->fname . ' ' . $viewer_value->lname;?></td>
                            <td class="pull-right"><?php echo $viewer_value->created_at; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
          </div>  
        <?php
} else {
    ?>
    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
    <?php
}
?>