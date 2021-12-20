<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Promocode'); ?>
                    <a href="<?php echo site_url('admin/add_promocode'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_new_promocode'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('Promo Codes'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="promocode-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Promo Code'); ?></th>
								<th><?php echo get_phrase('Amount'); ?></th>
								<th><?php echo get_phrase('Date'); ?></th>
								<th><?php echo get_phrase('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--<?php
                            foreach ($promocode as $key => $tr): ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $tr['promocode']; ?></td>
								<td><?php echo date('d-m-Y',strtotime($tr['created_on'])); ?></td>
                            </tr>
                        <?php endforeach; ?>-->
                    </tbody>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>
