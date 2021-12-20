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
                <h4 class="mb-3 header-title"><?php echo get_phrase('Pending Payments'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="track-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('Student Name'); ?></th>
                                <th><?php echo get_phrase('Course'); ?></th>
								<th><?php echo get_phrase('Amount Paid'); ?></th>
                                <th><?php echo get_phrase('Total Amount'); ?></th>
								<th><?php echo get_phrase('Mobile'); ?></th>
								<th><?php echo get_phrase('Date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $key => $tr): ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $tr['first_name']; ?></td>
                                <td><?php echo $tr['title']; ?></td>
                                <td><?php echo $tr['partial_amount_paid']; ?></td>
                                <td><?php echo $tr['amount']; ?></td>
                                <td><?php echo $tr['mobile']; ?></td>
								<td><?php echo date('d-m-Y',strtotime($tr['created_on'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>