<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preview.colorlib.com/theme/karl/product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 Oct 2021 06:20:26 GMT -->
<head>
<meta charset="UTF-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
.cart-submit_custom {
    background-color: #ff084e;
    border: medium none;
    color: #fff;
    font-size: 14px;
    height: 40px;
    margin-left: 15px;
    text-transform: uppercase;
    width: 150px;
    cursor: pointer;
    border-radius: 0;
	margin:5px;
}
</style>
<link rel="stylesheet" href="<?php echo base_url().'assets/frontend/default/css/main_us.css'; ?>">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
$instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
?>
<body>
      <section class="top-discount-area d-md-flex align-items-center">

<div class="single-discount-area">
<h3><?php echo $course_details['title']; ?></h3>
<h6></h6>
</div>
<div class="single-discount-area">
<h5><?php echo $course_details['short_description']; ?></h5>
</div>

<div class="single-discount-area">
<h5>
<div class="rating-row">
            <span class="course-badge best-seller"><?php echo site_phrase($course_details['level']); ?></span>
            <?php
            $total_rating =  $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
            $number_of_ratings = 4;
            if ($number_of_ratings > 0) {
              //$average_ceil_rating = ceil($total_rating / $number_of_ratings);
              $average_ceil_rating = ceil(4);
            }else {
              $average_ceil_rating = 0;
            }

            for($i = 1; $i < 6; $i++):?>
            <?php if ($i <= $average_ceil_rating): ?>
              <i class="fas fa-star filled" style="color: #f5c85b;"></i>
            <?php else: ?>
              <i class="fas fa-star"></i>
            <?php endif; ?>
          <?php endfor; ?>
          <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span><span>(<?php echo $number_of_ratings.' '.site_phrase('ratings'); ?>)</span>
          <span class="enrolled-num">
            <?php
            //$number_of_enrolments = $this->crud_model->enrol_history($course_details['id'])->num_rows();
			
			if($course_details['id'] == 1){
				$number_of_enrolments = 245;
			}
			elseif($course_details['id'] == 2){
				$number_of_enrolments = 280;
			}
			elseif($course_details['id'] == 3){
				$number_of_enrolments = 300;
			}
			elseif($course_details['id'] == 4){
				$number_of_enrolments = 180;
			}
			elseif($course_details['id'] == 5){
				$number_of_enrolments = 220;
			}
			elseif($course_details['id'] == 6){
				$number_of_enrolments = 320;
			}
			elseif($course_details['id'] == 7){
				$number_of_enrolments = 315;
			}
			elseif($course_details['id'] == 8){
				$number_of_enrolments = 275;
			}
			elseif($course_details['id'] == 9){
				$number_of_enrolments = 318;
			}
			elseif($course_details['id'] == 10){
				$number_of_enrolments = 355;
			}else{
				$number_of_enrolments = 245;
			}
            echo $number_of_enrolments.' '.site_phrase('students_enrolled');
            ?>
          </span>
        </div>
</h5>
</div>
</section><br><br><br><br>
      <section class="single_product_details_area section_padding_0_100">
<div class="container">
<div class="row">
<div class="col-12 col-md-6">
<div class="single_product_thumb">
<img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" class="img-fluid">
</div>
</div>
<div class="col-12 col-md-6">
<div class="single_product_desc">
<h4 class="title"><a href="#"><?php echo $course_details['title']; ?></a></h4>
<h4 class="price">$<?php echo $course_details['discounted_price']; ?></h4>

<div class="row">

<?php if(is_purchased($course_details['id'])) :?>
        <div class="already_purchased">
          <a href="<?php echo site_url('home/my_courses'); ?>"><?php echo site_phrase('already_purchased'); ?></a>
        </div>
      <?php else: ?>

          <!-- WISHLIST BUTTON -->
		  <div class="col-md-4">
          <div class="buy-btns">
              <button class="btn btn-add-wishlist <?php echo $this->crud_model->is_added_to_wishlist($course_details['id']) ? 'active' : ''; ?> cart-submit_custom d-block" type="button" id = "<?php echo $course_details['id']; ?>" onclick="handleAddToWishlist(this)">
                  <?php
                    if($this->crud_model->is_added_to_wishlist($course_details['id'])){
                        echo site_phrase('added_to_wishlist');
                    }  else{
                        echo site_phrase('add_to_wishlist');
                    }
                    ?>
              </button>
          </div>&nbsp;&nbsp;&nbsp;&nbsp;</div>
		  <?php if ($course_details['is_free_course'] == 1): ?>
          <div class="col-md-4"><div class="buy-btns">
            <?php if ($this->session->userdata('user_login') != 1): ?>
              <a href = "#" class="btn btn-buy-now cart-submit_custom" onclick="handleEnrolledButton()"><?php echo site_phrase('get_enrolled'); ?></a>
            <?php else: ?>
              <a href = "<?php echo site_url('home/get_enrolled_to_free_course/'.$course_details['id']); ?>" class="btn btn-buy-now cart-submit_custom"><?php echo site_phrase('get_enrolled'); ?></a>
            <?php endif; ?>
          </div></div>
        <?php else: ?>
        <div class="col-md-4">
          <div class="buy-btns">
            <a href = "javascript::" class="btn btn-buy-now cart-submit_custom" id = "course_<?php echo $course_details['id']; ?>" onclick="handleBuyNow(this)"><?php echo site_phrase('buy_now'); ?></a>
            <?php if (in_array($course_details['id'], $this->session->userdata('cart_items'))): ?>
              <button class="btn btn-add-cart addedToCart cart-submit_custom" type="button" id = "<?php echo $course_details['id']; ?>" onclick="handleCartItems(this)"><?php echo site_phrase('added_to_cart'); ?></button>
            <?php else: ?>
            <button class="btn btn-add-cart cart-submit_custom" type="button" id = "<?php echo $course_details['id']; ?>" onclick="handleCartItems(this)"><?php echo site_phrase('add_to_cart'); ?></button>
            <?php endif; ?>
          </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
	  </div>
<div class="includes">
        <div class="title"><b><?php echo site_phrase('includes'); ?>:</b></div>
        <ul>
          <?php if($course_details['course_type'] == 'general'): ?>
            <li><i class="far fa-file-video"></i>
              <?php
              echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']).' '.site_phrase('on_demand_videos');
              ?>
            </li>
            <li><i class="far fa-file"></i><?php echo $this->crud_model->get_lessons('course', $course_details['id'])->num_rows().' '.site_phrase('lessons'); ?></li>
            <li><i class="fas fa-mobile-alt"></i><?php echo site_phrase('access_on_mobile_and_tv'); ?></li>
          <?php elseif($course_details['course_type'] == 'scorm'): ?>
            <li><i class="far fa-file-video"></i><?php echo site_phrase('scorm_course'); ?></li>
            <li><i class="fas fa-mobile-alt"></i><?php echo site_phrase('access_on_laptop_and_tv'); ?></li>
          <?php endif; ?>
          <li><i class="far fa-compass"></i><?php echo site_phrase('full_lifetime_access'); ?></li>
        </ul>
      </div><br>
<div class="course-curriculum-accordion">
              <?php
              $sections = $this->crud_model->get_section('course', $course_id)->result_array();
              $counter = 0;
              foreach ($sections as $section): ?>
              <div class="lecture-group-wrapper">
                <div class="lecture-group-title clearfix" data-toggle="collapse" data-target="#collapse<?php echo $section['id']; ?>" aria-expanded="<?php if($counter == 0) echo 'true'; else echo 'false' ; ?>">
                  <div class="title float-left">
                    <?php  echo $section['title']; ?>
                  </div>
                  <div class="float-right">
                    <span class="total-lectures">
                      <?php echo $this->crud_model->get_lessons('section', $section['id'])->num_rows().' '.site_phrase('lessons'); ?>
                    </span>
                    <span class="total-time">
                      <?php echo $this->crud_model->get_total_duration_of_lesson_by_section_id($section['id']); ?>
                    </span>
                  </div>
                </div>

                <div id="collapse<?php echo $section['id']; ?>" class="lecture-list collapse <?php if($counter == 0) echo 'show'; ?>">
                  <ul>
                    <?php $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
                    foreach ($lessons as $lesson):?>
                    <li class="lecture has-preview">
                      <span class="lecture-title"><?php echo $lesson['title']; ?></span>
                      <span class="lecture-time float-right"><?php echo $lesson['duration']; ?></span>
                      <!-- <span class="lecture-preview float-right" data-toggle="modal" data-target="#CoursePreviewModal">Preview</span> -->
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php
            $counter++;
          endforeach; ?>
        </div>
</div>
</div>
</div>
</div>
</section>
<div class="container">
<hr>
<div class="row">
   <div class="col-md-12">
      <h4>Progress Of Course : <button class="btn btn-warning" onclick="graphbtn()"><i class="fas fa-chart-line"></i>&nbsp;Graph Chart</button>
	  <button class="btn btn-primary" onclick="barbtn()"><i class="fas fa-chart-bar"></i>&nbsp;Bar Chart</button></h4>
	  
      <canvas id="bar-chart" width="800" height="350" class="bar" style="display:none;"></canvas>
	  <canvas id="line-chart" width="800" height="350" class="graph" ></canvas>
   </div>
</div><hr>
<h4>Companies Using :</h4><br>
<div class="row">
    <?php if($course_details['course_companies_image_one'] != ''){ ?>
    <div class="col-md-3" style="text-align:center"><img src="<?php echo base_url(); ?>assets/uploads/course/<?php echo $course_details['course_companies_image_one']; ?>" height="150px" width="150px" style="border-radius:10px"></div>
	<?php } ?>
	<?php if($course_details['course_companies_image_two'] != ''){ ?>
    <div class="col-md-3" style="text-align:center"><img src="<?php echo base_url(); ?>assets/uploads/course/<?php echo $course_details['course_companies_image_two']; ?>" height="150px" width="150px" style="border-radius:10px"></div>
	<?php } ?>
	<?php if($course_details['course_companies_image_three'] != ''){ ?>
    <div class="col-md-3" style="text-align:center"><img src="<?php echo base_url(); ?>assets/uploads/course/<?php echo $course_details['course_companies_image_three']; ?>" height="150px" width="150px" style="border-radius:10px"></div>
	<?php } ?>
	<?php if($course_details['course_companies_image_four'] != ''){ ?>
    <div class="col-md-3" style="text-align:center"><img src="<?php echo base_url(); ?>assets/uploads/course/<?php echo $course_details['course_companies_image_four']; ?>" height="150px" width="150px" style="border-radius:10px"></div>
	<?php } ?>
</div>
<?php if($course_details['why_learn_course'] != ''){ ?>
<hr>
<div class="row">
   <div class="col-md-12">
      <h4>Why Learn With Entirety :</h4>
	  <p><?php echo $course_details['why_learn_course']; ?></p>
   </div>
</div>
<?php } ?>
</div><br><br><br>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
    function graphbtn(){
			$('.graph').show();
			$('.bar').hide();
		}
		function barbtn(){
			$('.bar').show();
			$('.graph').hide();
		}
		// Bar chart
		new Chart(document.getElementById("bar-chart"), {
			type: 'bar',
			data: {
			  labels: ["2000", "2005", "2010", "2015", "2020"],
			  datasets: [
				{
				  label: "Population (millions)",
				  backgroundColor: ["#3cba9f", "#8e5ea2","#3e95cd","#21c87a","#ff084e"],
				  data: [433,734,784,2478,5267]
				}
			  ]
			},
			options: {
			  legend: { display: false },
			  title: {
				display: true,
				text: 'Bar Chart Of Improvement From Past Years'
			  }
			}
		});
		new Chart(document.getElementById("line-chart"), {
		  type: 'line',
		  data: {
			labels: [2012,2013,2014,2015,2016,2017,2018,2019,2020,2021],
			datasets: [{ 
				data: [282,350,411,502,635,809,947,1402,3700,5267],
				label: "Course",
				borderColor: "#8e5ea2",
				fill: false
			  }
			]
		  },
		  options: {
			title: {
			  display: true,
			  text: 'Graphical View From Past Years'
			}
		  }
		});
    function handleCartItems(elem) {
      url1 = '<?php echo site_url('home/handleCartItems');?>';
      url2 = '<?php echo site_url('home/refreshWishList');?>';
      $.ajax({
        url: url1,
        type : 'POST',
        data : {course_id : elem.id},
        success: function(response)
        {
          $('#cart_items').html(response);
          if ($(elem).hasClass('addedToCart')) {
            $(elem).removeClass('addedToCart')
            $(elem).text("<?php echo site_phrase('add_to_cart'); ?>");
          }else {
            $(elem).addClass('addedToCart')
            $(elem).text("<?php echo site_phrase('added_to_cart'); ?>");
          }
          $.ajax({
            url: url2,
            type : 'POST',
            success: function(response)
            {
              $('#wishlist_items').html(response);
            }
          });
        }
      });
    }

    function handleBuyNow(elem) {
      url1 = '<?php echo site_url('home/handleCartItemForBuyNowButton');?>';
      url2 = '<?php echo site_url('home/refreshWishList');?>';
      urlToRedirect = '<?php echo site_url('home/shopping_cart'); ?>';
      var explodedArray = elem.id.split("_");
      var course_id = explodedArray[1];
      $.ajax({
        url: url1,
        type : 'POST',
        data : {course_id : course_id},
        success: function(response)
        {
          $('#cart_items').html(response);
          $.ajax({
            url: url2,
            type : 'POST',
            success: function(response)
            {
              $('#wishlist_items').html(response);
              toastr.warning('<?php echo site_phrase('please_wait').'....'; ?>');
              setTimeout(
              function()
              {
                window.location.replace(urlToRedirect);
              }, 1500);
            }
          });
        }
      });
    }

    function handleEnrolledButton() {
      $.ajax({
        url: '<?php echo site_url('home/isLoggedIn');?>',
        success: function(response)
        {
          if (!response) {
            window.location.replace("<?php echo site_url('login'); ?>");
          }
        }
      });
    }

    function handleAddToWishlist(elem) {
        $.ajax({
            url: '<?php echo site_url('home/handleWishList');?>',
            type : 'POST',
            data : {course_id : elem.id},
            success: function(response)
            {
                if (!response) {
                    window.location.replace("<?php echo site_url('login'); ?>");
                }else {
                    if ($(elem).hasClass('active')) {
                        $(elem).removeClass('active');
                        $(elem).text("<?php echo site_phrase('add_to_wishlist'); ?>");
                    }else {
                        $(elem).addClass('active');
                        $(elem).text("<?php echo site_phrase('added_to_wishlist'); ?>");
                    }
                    $('#wishlist_items').html(response);
                }
            }
        });
    }

    function pausePreview() {
      player.pause();
    }
    </script>

  </body>
</html>