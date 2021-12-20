<style>

/*--thank you pop starts here--*/
.thank-you-pop{
	width:100%;
 	padding:20px;
	text-align:center;
}
.thank-you-pop img{
	width:76px;
	height:auto;
	margin:0 auto;
	display:block;
	margin-bottom:25px;
}

.thank-you-pop h1{
	font-size: 42px;
    margin-bottom: 25px;
	color:#5C5C5C;
}
.thank-you-pop p{
	font-size: 20px;
    margin-bottom: 27px;
 	color:#5C5C5C;
}
.thank-you-pop h3.cupon-pop{
	font-size: 25px;
    margin-bottom: 40px;
	color:#222;
	display:inline-block;
	text-align:center;
	padding:10px 20px;
	border:2px dashed #222;
	clear:both;
	font-weight:normal;
}
.thank-you-pop h3.cupon-pop span{
	color:#03A9F4;
}
.thank-you-pop a{
	display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}
.thank-you-pop a i{
	margin-right:5px;
	color:#fff;
}
#ignismyModal .modal-header{
    border:0px;
}
/*--thank you pop ends here--*/
.icon-container {
    position: relative; 
    right: 5px;
    bottom: 30px;
    float: right;
}
#orangeBox {
    background: #f90;
    color: #fff;
    font-size: 1em;
    font-weight: bold;
    text-align: center;
    width: 25px;
    height: 25px;
    border-radius: 15px;
}

#greenBox {
    background: green;
    color: #fff;
    font-family: 'Helvetica', 'Arial', sans-serif;
    font-size: 1em;
    font-weight: bold;
    text-align: center;
    width: 25px;
    height: 25px;
    border-radius: 15px;
}
</style>
<?php if($this->session->userdata('payment') == 'failed'){ ?>
	<script>
	$(document).ready(function(){
		$("#myModal").modal();
	});
	</script>
<?php } $this->session->unset_userdata('payment'); ?>
<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#"><?php echo site_phrase('shopping_cart'); ?></a></li>
                    </ol>
                </nav>
                <h1 class="page-title"><?php echo site_phrase('shopping_cart'); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="cart-list-area">
    <div class="container">
        <div class="row" id = "cart_items_details">
            <div class="col-lg-9">

                <div class="in-cart-box">
                    <div class="title"><?php echo sizeof($this->session->userdata('cart_items')).' '.site_phrase('courses_in_cart'); ?></div>
                    <div class="">
                        <ul class="cart-course-list">
                            <?php
                            $actual_price = 0;
                            $total_price  = 0;
                            foreach ($this->session->userdata('cart_items') as $cart_item):
                                $course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
                                $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
                                ?>
                                <li>
                                    <div class="cart-course-wrapper">
                                        <div class="image">
                                            <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>">
                                                <img src="<?php echo $this->crud_model->get_course_thumbnail_url($cart_item);?>" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="details">
                                            <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>">
                                                <div class="name"><?php echo $course_details['title']; ?></div>
                                            </a>
                                            <a href="<?php echo site_url('home/instructor_page/'.$instructor_details['id']); ?>">
                                                <div class="instructor">
                                                    <?php echo site_phrase('by'); ?>
                                                    <span class="instructor-name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></span>,
                                                </div>
                                            </a>
                                        </div>
                                        <div class="move-remove">
                                            <div id = "<?php echo $course_details['id']; ?>" onclick="removeFromCartList(this)"><?php echo site_phrase('remove'); ?></div>
                                            <!-- <div>Move to Wishlist</div> -->
                                        </div>
                                        <div class="price">
                                            <a href="">
                                                <?php if ($course_details['discount_flag'] == 1): ?>
                                                    <div class="current-price">
                                                        <?php
                                                        $total_price += $course_details['discounted_price'];
                                                        echo currency($course_details['discounted_price']);
                                                        ?>
                                                    </div>
                                                    <div class="original-price">
                                                        <?php
                                                        $actual_price += $course_details['price'];
                                                        echo currency($course_details['price']);
                                                        ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="current-price">
                                                        <?php
                                                        $actual_price += $course_details['price'];
                                                        $total_price  += $course_details['price'];
                                                        echo currency($course_details['price']);
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="coupon-tag">
                                                    <i class="fas fa-tag"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="cart-sidebar">
                    <div class="total"><?php echo site_phrase('total'); ?>:</div>
                    <span id = "total_price_of_checking_out" hidden><?php echo $total_price; $this->session->set_userdata('total_price_of_checking_out', $total_price);?>
                    </span>
                    <div class="total-price toatal_amount_promocode"><?php echo currency($total_price); ?></div>
                    <div class="total-original-price">
                        <?php if ($course_details['discount_flag'] == 1): ?>
                            <span class="original-price"><?php echo currency($actual_price); ?></span>
                        <?php endif; ?>
                        <!-- <span class="discount-rate">95% off</span> -->
                    </div>
					
					<div class="input-group mb-3">
					  <input type="text" class="form-control" id="promocode" placeholder="Enter Promocode">
					  <div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button" onclick="validate_promocode()">Apply</button>
					  </div>
					</div>
					<a href="#" onclick="linkClicked(event)">employee referal? click here</a><br>
                    <input type="text" style="display:none;" id="emp_code" name="emp_code" class="form-control" placeholder="Enter Employee Code">
					<div class="icon-container">
						<div id="greenBox" style="display:none;">✓</div>
						<div id="orangeBox" style="display:none;">X</div>
					</div>
					<br>
                    <button type="button" class="btn btn-primary btn-block checkout-btn" onclick="handleCheckOut()"><?php echo site_phrase('checkout'); ?></button><br>
                    <p style="text-align: center;">Or</p>
                    <button type="button" class="btn btn-primary btn-block checkout-btn" data-toggle="modal" data-target="#paymentModal"><?php echo site_phrase('checkout_partial_payment'); ?></button>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
					
                    <div class="modal-body">
                       
						<div class="thank-you-pop">
							<h1>Oops!</h1>
							<p>Your Payment was Failed</p>
							<!--<h3 class="cupon-pop">Your Id: <span>12345</span></h3>-->
							
 						</div>
                         
                    </div>
					
                </div>
        </div>
  </div>
  <div class="modal fade" id="paymentModal" role="dialog">
      <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Partial Amount</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
                    
                    <div class="modal-body">
                       <button type="button" class="btn btn-primary btn-block checkout-btn" onclick="handleCheckOut('1000')"><?php echo site_phrase('Rs.1000'); ?></button> 
                       <p style="text-align: center;">(Or)</p>
                       <button type="button" class="btn btn-primary btn-block checkout-btn" onclick="handleCheckOut('1500')"><?php echo site_phrase('Rs.1500'); ?></button>
                       
                         
                    </div>
                    
                </div>
        </div>
  </div>
<script src="https://www.paypalobjects.com/js/external/dg.js"></script>
<script>
    var dgFlow = new PAYPAL.apps.DGFlow({ trigger: 'submitBtn' });
    dgFlow = top.dgFlow || top.opener.top.dgFlow;
    dgFlow.closeFlow();
    // top.close();
</script>

<script type="text/javascript">
function removeFromCartList(elem) {
    url1 = '<?php echo site_url('home/handleCartItems');?>';
    url2 = '<?php echo site_url('home/refreshWishList');?>';
    url3 = '<?php echo site_url('home/refreshShoppingCart');?>';
    $.ajax({
        url: url1,
        type : 'POST',
        data : {course_id : elem.id},
        success: function(response)
        {

            $('#cart_items').html(response);
            if ($(elem).hasClass('addedToCart')) {
                $('.big-cart-button-'+elem.id).removeClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('add_to_cart'); ?>");
            }else {
                $('.big-cart-button-'+elem.id).addClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('added_to_cart'); ?>");
            }

            $.ajax({
                url: url2,
                type : 'POST',
                success: function(response)
                {
                    $('#wishlist_items').html(response);
                }
            });

            $.ajax({
                url: url3,
                type : 'POST',
                success: function(response)
                {
                    $('#cart_items_details').html(response);
                }
            });
        }
    });
}

function handleCheckOut(amount) {
    if (amount != 'undefined' && amount != '') {
        $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>home/save_partial_amount_session",
        data:'amount='+amount,
        success: function(data){
          console.log(data);
        }
       });
    }
	var emp_code = $('#emp_code').val();
    $.ajax({
        url: '<?php echo site_url('home/isLoggedIn');?>',
        success: function(response)
        {
            if (!response) {
                window.location.replace("<?php echo site_url('login'); ?>");
            }else if("<?php echo $total_price; ?>" > 0){
                window.location.replace("<?php echo site_url('home/payment'); ?>");				
            }else{
                toastr.error('<?php echo site_phrase('there_are_no_courses_on_your_cart');?>');
            }
        }
    });
}

function handleCartItems(elem) {
    url1 = '<?php echo site_url('home/handleCartItems');?>';
    url2 = '<?php echo site_url('home/refreshWishList');?>';
    url3 = '<?php echo site_url('home/refreshShoppingCart');?>';
    $.ajax({
        url: url1,
        type : 'POST',
        data : {course_id : elem.id},
        success: function(response)
        {
            $('#cart_items').html(response);
            if ($(elem).hasClass('addedToCart')) {
                $('.big-cart-button-'+elem.id).removeClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('add_to_cart'); ?>");
            }else {
                $('.big-cart-button-'+elem.id).addClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('added_to_cart'); ?>");
            }
            $.ajax({
                url: url2,
                type : 'POST',
                success: function(response)
                {
                    $('#wishlist_items').html(response);
                }
            });

            $.ajax({
                url: url3,
                type : 'POST',
                success: function(response)
                {
                    $('#cart_items_details').html(response);
                }
            });
        }
    });
}
function validate_promocode(){
	var promocode = $('#promocode').val();
	if(promocode != ''){
	    $.ajax({
                url: '<?php echo site_url('home/validate_promocode');?>',
                type : 'POST',
				data : {promocode : promocode},
				dataType: "JSON",
                success: function(resultData)
                {
					if(resultData.status){
					  $(".toatal_amount_promocode").html(resultData.return_data);
					  toastr.success('<?php echo site_phrase('promocode_sucessfully_applied');?>');                    
					}else{  
					  toastr.error('<?php echo site_phrase('invalid_promocode');?>');
					}
                }
            });	
	}
}
function linkClicked(event) {
    event.preventDefault();
    document.getElementById('emp_code').style.display = "block";
    return false;
}
</script>
<script>
$(document).ready(function(){
  $("#emp_code").keyup(function(){
    //alert($('#emp_code').val());
	var emp_code = $('#emp_code').val();
	$.ajax({
                url: '<?php echo site_url('home/validate_emp_code');?>',
                type : 'POST',
				data : {emp_code : emp_code},
				dataType: "JSON",
                success: function(resultData)
                {
					if(resultData.status){
					  document.getElementById('greenBox').style.display = "block";
                      $("#orangeBox").hide(); 					  
					}else{  
					  document.getElementById('orangeBox').style.display = "block";
					  $("#greenBox").hide();
					}
                }
            });
  });
});
</script>
