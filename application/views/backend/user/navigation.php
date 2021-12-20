<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">
	<div class="leftbar-user">
		<a href="javascript: void(0);">
			<img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
			<?php
			$user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
			?>
			<span class="leftbar-user-name"><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></span>
		</a>
	</div>

	<!--- Sidemenu -->
	<ul class="metismenu side-nav side-nav-light">

		<li class="side-nav-title side-nav-item"><?php echo get_phrase('navigation'); ?></li>
		<?php if ($this->session->userdata('is_instructor')): ?>
			<li class="side-nav-item">
				<a href="<?php echo site_url('user/dashboard'); ?>" class="side-nav-link <?php if ($page_name == 'dashboard')echo 'active';?>">
					<i class="dripicons-view-apps"></i>
					<span><?php echo get_phrase('dashboard'); ?></span>
				</a>
			</li>
			<li class="side-nav-item">
				<a href="<?php echo site_url('user/courses'); ?>" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit')echo 'active';?>">
					<i class="dripicons-archive"></i>
					<span><?php echo get_phrase('course_manager'); ?></span>
				</a>
			</li>
			<li class="side-nav-item">
				<a href="<?php echo site_url('user/sales_report'); ?>" class="side-nav-link <?php if ($page_name == 'report' || $page_name == 'invoice')echo 'active';?>">
					<i class="dripicons-to-do"></i>
					<span><?php echo get_phrase('sales_report'); ?></span>
				</a>
			</li>
			<li class="side-nav-item">
				<a href="<?php echo site_url('user/payout_report'); ?>" class="side-nav-link <?php if ($page_name == 'payout_report' || $page_name == 'invoice')echo 'active';?>">
					<i class="dripicons-shopping-bag"></i>
					<span><?php echo get_phrase('payout_report'); ?></span>
				</a>
			</li>
			<li class="side-nav-item">
				<a href="<?php echo site_url('user/payout_settings'); ?>" class="side-nav-link <?php if ($page_name == 'payment_settings')echo 'active';?>">
					<i class="dripicons-gear"></i>
					<span><?php echo get_phrase('payout_settings'); ?></span>
				</a>
			</li>
			<li class="side-nav-item">
			<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'meetings' || $page_name == 'settings'): ?> active <?php endif; ?>">
				<i class="dripicons-network-1"></i>
				<span> <?php echo get_phrase('live_meetings'); ?> </span>
				<span class="menu-arrow"></span>
			</a>
			<ul class="side-nav-second-level" aria-expanded="false">
				<li class = "<?php if($page_name == 'meetings') echo 'active'; ?>">
					<a href="<?php echo site_url('user/meetings'); ?>"><?php echo get_phrase('meetings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'meetings_report') echo 'active'; ?>">
					<a href="<?php echo site_url('user/meetings_report'); ?>"><?php echo get_phrase('meetings_report'); ?></a>
				</li>

				<!-- <li class = "<?php if($page_name == 'settings') echo 'active'; ?>">
					<a href="<?php echo site_url('user/zoom_settings'); ?>"><?php echo get_phrase('settings'); ?></a>
				</li> -->
			</ul>
		</li>
		<?php else: ?>
			<li class="side-nav-item">
				<a href="<?php echo site_url('user/become_an_instructor'); ?>" class="side-nav-link <?php if ($page_name == 'become_an_instructor')echo 'active';?>">
					<i class="dripicons-archive"></i>
					<span><?php echo get_phrase('become_an_instructor'); ?></span>
				</a>
			</li>
			<li class="side-nav-item">
				<a href="<?php echo site_url('user/zoom_meeting'); ?>" class="side-nav-link <?php if ($page_name == 'zoom_meeting')echo 'active';?>">
					<i class="dripicons-archive"></i>
					<span><?php echo get_phrase('meetings'); ?></span>
				</a>
			</li>

		<?php endif; ?>
		<li class="side-nav-item">
			<a href="<?php echo site_url('home/my_messages'); ?>" class="side-nav-link">
				<i class="dripicons-mail"></i>
				<span><?php echo get_phrase('message'); ?></span>
			</a>
		</li>
		<li class="side-nav-item">
			<a href="<?php echo site_url(strtolower($this->session->userdata('role')).'/manage_profile'); ?>" class="side-nav-link">
				<i class="dripicons-user"></i>
				<span><?php echo get_phrase('manage_profile'); ?></span>
			</a>
		</li>
		
		
	</ul>
</div>
