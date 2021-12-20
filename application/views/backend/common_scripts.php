<script type="text/javascript">
  function togglePriceFields(elem) {
    if($("#"+elem).is(':checked')){
      $('.paid-course-stuffs').slideUp();
    }else
      $('.paid-course-stuffs').slideDown();
    }
</script>

<?php if ($page_name == 'courses-server-side'): ?>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#course-datatable-server-side').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url(strtolower($this->session->userdata('role')).'/get_courses') ?>",
                "dataType": "json",
                "type": "POST",
                "data" : {selected_category_id : '<?php echo $selected_category_id; ?>',
                          selected_status : '<?php echo $selected_status ?>',
                          selected_instructor_id : '<?php echo $selected_instructor_id ?>',
                          selected_price : '<?php echo $selected_price ?>'}
            },
            "columns": [
                { "data": "#" },
                { "data": "title" },
                { "data": "category" },
                { "data": "lesson_and_section" },
                { "data": "enrolled_student" },
                { "data": "status" },
                { "data": "price" },
                { "data": "actions" },
            ],
            "columnDefs": [{
                targets: "_all",
                orderable: false
             }]
        });
    });
  </script>
<?php endif; ?>
<?php if ($page_name == 'registration_tracking'): ?>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
		var base_url = '<?php echo base_url(); ?>';
        $('#track-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": base_url+'admin/registration_tracking_datatable',
                "dataType": "json",
                "type": "POST",
                "data" : {},
				/* 'success' : function(data){
                  
                       console.log(data);

                   },
                   'error' : function(data){

                       console.log(data);

                   } */ 
						  },
						  
            "columns": [
                { "data": "#" },
                { "data": "user" },
                { "data": "email" },
				{ "data": "mobile" },
				{ "data": "course" },
                { "data": "date" },
            ]
        });
		
		$("#course_id").on('change',function(){
			trackFilters();
		});
		$("#date").on('change',function(){
			trackFilters();
		});
		$("#track_export").on('click',function(){
		  var course_id = $("#course_id").val();
          var date = $("#date").val();
		  var base_url = '<?php echo base_url(); ?>';
		  window.location = base_url+"admin/trackExport?course_id="+course_id+"&date="+date;
		  return false;

	  });
    });
	
	function trackFilters(){
	    var course_id = $("#course_id").val();
        var date = $("#date").val();
		var base_url = '<?php echo base_url(); ?>';
        $('#track-datatable').DataTable({
            "processing": true,
			"serverSide": true,
			"destory":true,
			"bDestroy": true,
            "ajax":{
                "url": base_url+'admin/registration_tracking_datatable',
                "dataType": "json",
                "type": "POST",
                "data" : {selected_course_id : course_id,selected_date : date},
				/* 'success' : function(data){
                  
                       console.log(data);

                   },
                   'error' : function(data){

                       console.log(data);

                   } */ 
						  },
						  
            "columns": [
                { "data": "#" },
                { "data": "user" },
				{ "data": "email" },
				{ "data": "mobile" },
                { "data": "course" },
                { "data": "date" },
            ]
        });
}

  </script>
<?php endif; ?>
<?php if ($page_name == 'promocode'): ?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
	  var base_url = '<?php echo base_url(); ?>';
     $('#promocode-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": base_url+'admin/promocode_datatable',
                "dataType": "json",
                "type": "POST",
                "data" : {},
						  },
						  
            "columns": [
                { "data": "#" },
                { "data": "promocode" },
				{ "data": "promo_amount" },
                { "data": "date" },
				{ "data": "action" },
            ]
        });
  });
</script>
<?php endif; ?>