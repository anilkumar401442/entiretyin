<head>
<script src="<?php echo site_url('assets/backend/js/ckeditor/ckeditor.js');?>"></script>
</head>

<input type="hidden" name="lesson_type" value="textcontent">
<div class="form-group">
    <label for="document_type"><?php echo get_phrase('text'); ?></label>
    <textarea name="editor1" required="required"></textarea>
</div>

<script>
        CKEDITOR.replace( 'editor1',{
            filebrowserUploadUrl:'<?php echo site_url('assets/backend/js/ckeditor/ck_upload.php');?>',
            filebrowserUploadMethod:'form'
        } );
</script>