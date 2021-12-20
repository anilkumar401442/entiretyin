<head>
    
<title>Entiretycourses</title>
<meta property="title" content="Entiretycourses"/>
<meta property="og:title" content="Entiretycourses"/>

 <link rel="canonical" href="https://courses.entiretyin.com/"/> <meta name="copyright" content="entiretyin">  
<meta name="description" content="Everyone needs attention, but you need people to observe and appreciate your child's activities, we entirety people oversee the interests and make sure to enhance the best online course platform in entiretyin.Design for managing the overall school system in online like class,Exams,Activity,event,etc....">
<meta property="og:type" content="website"/>   
<meta property="og:url" content="https://courses.entiretyin.com/"/>
<meta property="og:url" content="https://courses.entiretyin.com/home"/>
<link rel="canonical" href="https://courses.entiretyin.com/">

<meta property="og:site_name" content="ENTIRETYIN"/>
<meta content="website" property="og:type" />
<meta name="keywords" content="School enhancement platform,Entiretyin Course,careers,school enhancement system career opportunity,certificate,internships,Entiretyin Course,courses entiretyin,telangana startup,affordable price,affordable price,career entiretyin,Academic entiretyin,school enhancement system ,certificate,Entiretyin Course,career opportunity,internships,online school enhancement platform in entiretyin ,course entiretyin,career opportunity,Academic entiretyinted talk, internships,school enhancement system ,Academic entiretyin, school Management system, Entiretyin Course, Online school managment  software,internships,Entiretyin Course,affordable price,affordable price,ted talk,certificate,courses entiretyinstudent Management system software, Entiretyin Course,entiretyin Pvt Ltd,careers,Academic,entirety in Pvt Ltdentirety in Pvt Ltd,entirety in Pvt Ltd, school administrative software, Entiretyin Course,entiretyin Pvt Ltd,courses entiretyin,school enhancement software,entirety in Pvt Ltd,entirety in Pvt Ltd,Academic entiretyin,affordable price,career entiretyin school Management software in entirety in Pvt Ltd,entirety in Pvt Ltd,,Academic entiretyin,entirety in Pvt Ltd,ted talk ,course entiretyin, entiretyin Pvt Ltd,internships ,course entiretyin, entiretyin Pvt Ltd,affordable price,entirety in Pvt Ltd,Entiretyin Course,internships,telangana startup,school Management platform,certificate,entirety in Pvt Ltd,course entiretyinmcareer opportunity,student Management system software,courses entiretyinstudent enhancement system entiretyin,school enhancement system ,telangana startup,entirety in Pvt Ltd,Academic,course entiretyin, entiretyin Pvt Ltd,career entiretyin,certificate ,course entiretyin,affordable price,courses entiretyin,careers,telangana startup,entirety in Pvt Ltd, entiretyin Pvt Ltd,Academic entiretyin, course entiretyin, entiretyin Pvt Ltd,student enhancement system, career opportunity,courses entiretyin,student enhancement platform,career entiretyin ,Entiretyin Course, entiretyin Pvt Ltd,careers,affordable price,internships,Entiretyin Course,entirety in Pvt Ltd,Entiretyin Courseentirety in Pvt Ltd,course entiretyin,student enhancement software entiretyin,online school Management system,ted talk,Academic entiretyin, entiretyin Pvt Ltd,career opportunity,entirety in Pvt Ltd,course entiretyin,telangana startup,Entiretyin Course,career entiretyin, school Management software entiretyin,Academic student Management system,courses entiretyin, career opportunity,Entiretyin Courseentirety in Pvt Ltd,Academic entiretyin,entiretyin,affordable price, Entiretyin Course,school administrative system,ted talk,entirety in Pvt Ltd,course entiretyin, students administrative system,entirety in Pvt Ltd,career opportunity, entiretyin Pvt Ltd,Academic,careersstudent Management system software,student Management system software,Academic entiretyin ,course entiretyin,career opportunity,ted talk, student information system,Entiretyin Course entiretyin Pvt Ltd, student information software,career opportunity,careers,career entiretyin,Academic,Academic entiretyin, entiretyin Pvt Ltd,ted talk,courses entiretyin,Entiretyin Course,entirety in Pvt Ltd, affordable price,certificate,course entiretyin,Entiretyin Course,entiretyin Pvt Ltd,entirety in Pvt Ltd" />
</head>


<!-- Topbar Start -->
<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="<?php echo site_url($this->session->userdata('role')); ?>" class="topnav-logo" style = "min-width: unset;">
            <span class="topnav-logo-lg">
                <img src="<?php echo base_url('uploads/system/'.get_frontend_settings('light_logo'));?>" alt="" height="40">
            </span>
            <span class="topnav-logo-sm">
                <img src="<?php echo base_url('uploads/system/'.get_frontend_settings('small_logo'));?>" alt="" height="40">
            </span>
        </a>

        <ul class="list-unstyled topbar-right-menu float-right mb-0">
            <?php if($this->session->userdata('is_instructor') == 1 || $this->session->userdata('admin_login') == 1): ?>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="dripicons-view-apps noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg p-0 mt-5 border-top-0" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-278px, 70px, 0px);">

                        <div class="rounded-top py-3 border-bottom bg-primary">
                            <h4 class="text-center text-white"><?php echo get_phrase('quick_actions') ?></h4>
                        </div>

                        <div class="row row-paddingless" style="padding-left: 15px; padding-right: 15px;">
                            <!--begin:Item-->
                            <div class="col-6 p-0 border-bottom border-right">
                                <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?= site_url($logged_in_user_role.'/course_form/add_course_shortcut'); ?>', '<?= get_phrase('create_course'); ?>')">
                                    <i class="dripicons-archive text-20"></i>
                                    <span class="w-100 d-block text-muted"><?= get_phrase('add_course'); ?></span>
                                </a>
                            </div>

                            <div class="col-6 p-0 border-bottom">
                                <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_types/add_shortcut_lesson'); ?>', '<?php echo get_phrase('add_new_lesson'); ?>')">
                                    <i class="dripicons-media-next text-20"></i>
                                    <span class="d-block text-muted"><?= get_phrase('add_lesson'); ?></span>
                                </a>
                            </div>

                            <?php if($this->session->userdata('admin_login')): ?>
                                <div class="col-6 p-0 border-right">
                                    <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/shortcut_add_student'); ?>', '<?php echo get_phrase('add_student'); ?>')">
                                        <i class="dripicons-user text-20"></i>
                                        <span class="w-100 d-block text-muted"><?= get_phrase('add_student'); ?></span>
                                    </a>
                                </div>

                                <div class="col-6 p-0">
                                    <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/shortcut_enrol_student'); ?>', '<?php echo get_phrase('enrol_a_student'); ?>')">
                                        <i class="dripicons-network-3 text-20"></i>
                                        <span class="d-block text-muted"><?= get_phrase('enrol_student'); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop"
                href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" class="rounded-circle">
                </span>
                <span  style="color: #fff;">
                    <?php
                    $logged_in_user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();;
                    ?>
                    <span class="account-user-name"><?php echo $logged_in_user_details['first_name'].' '.$logged_in_user_details['last_name'];?></span>
                    <span class="account-position"><?php echo strtolower($this->session->userdata('role')) == 'user' ? get_phrase('instructor') : get_phrase('admin'); ?></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
            aria-labelledby="topbar-userdrop">
            <!-- item-->
            <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0"><?php echo get_phrase('welcome'); ?> !</h6>
            </div>

            <!-- Account -->
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')).'/manage_profile'); ?>" class="dropdown-item notify-item">
                <i class="mdi mdi-account-circle mr-1"></i>
                <span><?php echo get_phrase('my_account'); ?></span>
            </a>

            <?php if (strtolower($this->session->userdata('role')) == 'admin'): ?>
                <!-- settings-->
                <a href="<?php echo site_url('admin/system_settings'); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-settings mr-1"></i>
                    <span><?php echo get_phrase('settings'); ?></span>
                </a>

            <?php endif; ?>

            <!-- Logout-->
            <a href="<?php echo site_url('login/logout'); ?>" class="dropdown-item notify-item">
                <i class="mdi mdi-logout mr-1"></i>
                <span><?php echo get_phrase('logout'); ?></span>
            </a>

        </div>
    </li>
</ul>
<a class="button-menu-mobile disable-btn">
    <div class="lines">
        <span></span>
        <span></span>
        <span></span>
    </div>
</a>
<div class="visit_website">
    <h4 style="color: #fff; float: left;"> <?php echo $this->db->get_where('settings' , array('key'=>'system_name'))->row()->value; ?></h4>
    <a href="<?php echo site_url('home'); ?>" target="" class="btn btn-outline-light ml-3"><?php echo get_phrase('visit_website'); ?></a>
</div>
</div>
</div>
<!-- end Topbar -->