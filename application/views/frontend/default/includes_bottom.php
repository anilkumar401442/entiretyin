<script src="<?php echo base_url().'assets/frontend/default/js/vendor/modernizr-3.5.0.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/vendor/jquery-3.2.1.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/popper.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/slick.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/select2.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/tinymce.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/multi-step-modal.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/jquery.webui-popover.min.js'; ?>"></script>
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/main.js'; ?>"></script>
<script src="<?php echo base_url().'assets/global/toastr/toastr.min.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/bootstrap-tagsinput.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/frontend/default/js/custom.js'; ?>"></script>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<script>
            $(document).ready(function() {
              $('.welcome_slides').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
				autoplay:true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false,
					autoplay:true
                  },
                  600: {
                    items: 1,
                    nav: false,
					autoplay:true
                  },
                  1000: {
                    items: 1,
                    nav: false,
                    loop: false,
					autoplay:true,
                    margin: 20
                  }
                }
              })
            })
          </script>
<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
	toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>

<?php endif;?>

<?php if ($this->session->flashdata('error_message') != ""):?>

<script type="text/javascript">
	toastr.error('<?php echo $this->session->flashdata("error_message");?>');
</script>

<?php endif;?>

<?php if ($this->session->flashdata('info_message') != ""):?>

<script type="text/javascript">
	toastr.info('<?php echo $this->session->flashdata("info_message");?>');
</script>

<?php endif;?>
