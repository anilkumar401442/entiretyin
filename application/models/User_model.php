<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function get_admin_details() {
        return $this->db->get_where('users', array('role_id' => 1));
    }

    public function get_user($user_id = 0) {
        if ($user_id > 0) {
            $this->db->where('id', $user_id);
        }
        $this->db->where('role_id', 2);
        return $this->db->get('users');
    }

    public function get_all_user($user_id = 0) {
        if ($user_id > 0) {
            $this->db->where('id', $user_id);
        }
        return $this->db->get('users');
    }

    public function add_user($is_instructor = false) {
        $validity = $this->check_duplication('on_create', $this->input->post('email'));
        if ($validity == false) {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }else {
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));
            $data['email'] = html_escape($this->input->post('email'));
            $data['password'] = sha1(html_escape($this->input->post('password')));
            $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
            $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
            $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
            $data['social_links'] = json_encode($social_link);
            $data['biography'] = $this->input->post('biography');
            $data['role_id'] = 2;
            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $data['wishlist'] = json_encode(array());
            $data['watch_history'] = json_encode(array());
            $data['status'] = 1;
            $data['image'] = md5(rand(10000, 10000000));

            // Add paypal keys
            $paypal_info = array();
            $paypal['production_client_id']  = html_escape($this->input->post('paypal_client_id'));
            $paypal['production_secret_key'] = html_escape($this->input->post('paypal_secret_key'));
            array_push($paypal_info, $paypal);
            $data['paypal_keys'] = json_encode($paypal_info);

            // Add Stripe keys
            $stripe_info = array();
            $stripe_keys = array(
                'public_live_key' => html_escape($this->input->post('stripe_public_key')),
                'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
            );
            array_push($stripe_info, $stripe_keys);
            $data['stripe_keys'] = json_encode($stripe_info);

            if ($is_instructor) {
                $data['is_instructor'] = 1;
            }

            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();
            $this->upload_user_image($data['image']);
            $this->session->set_flashdata('flash_message', get_phrase('user_added_successfully'));
        }
    }

    public function add_shortcut_user($is_instructor = false) {
        $validity = $this->check_duplication('on_create', $this->input->post('email'));
        if ($validity == false) {
            $response['status'] = 0;
            $response['message'] = get_phrase('this_email_already_exits').'. '.get_phrase('please_use_another_email');
            return json_encode($response);
        }else {
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));
            $data['email'] = html_escape($this->input->post('email'));
            $data['password'] = sha1(html_escape($this->input->post('password')));
            $social_link['facebook'] = '';
            $social_link['twitter'] = '';
            $social_link['linkedin'] = '';
            $data['social_links'] = json_encode($social_link);
            $data['role_id'] = 2;
            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $data['wishlist'] = json_encode(array());
            $data['watch_history'] = json_encode(array());
            $data['status'] = 1;
            $data['image'] = md5(rand(10000, 10000000));

            // Add paypal keys
            $paypal_info = array();
            $paypal['production_client_id']  = '';
            $paypal['production_secret_key'] = '';
            array_push($paypal_info, $paypal);
            $data['paypal_keys'] = json_encode($paypal_info);

            // Add Stripe keys
            $stripe_info = array();
            $stripe_keys = array(
                'public_live_key' => '',
                'secret_live_key' => ''
            );
            array_push($stripe_info, $stripe_keys);
            $data['stripe_keys'] = json_encode($stripe_info);

            if ($is_instructor) {
                $data['is_instructor'] = 1;
            }
            $this->db->insert('users', $data);

            $this->session->set_flashdata('flash_message', get_phrase('user_added_successfully'));
            $response['status'] = 1;
            return json_encode($response);
        }
    }

    public function check_duplication($action = "", $email = "", $user_id = "") {
        $duplicate_email_check = $this->db->get_where('users', array('email' => $email));

        if ($action == 'on_create') {
            if ($duplicate_email_check->num_rows() > 0) {
                if($duplicate_email_check->row()->status == 1){
                    return false;
                }else{
                    return 'unverified_user';
                }
            }else {
                return true;
            }
        }elseif ($action == 'on_update') {
            if ($duplicate_email_check->num_rows() > 0) {
                if ($duplicate_email_check->row()->id == $user_id) {
                    return true;
                }else {
                    return false;
                }
            }else {
                return true;
            }
        }
    }

    public function edit_user($user_id = "") { // Admin does this editing
        $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
        if ($validity) {
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));

            if (isset($_POST['email'])) {
                $data['email'] = html_escape($this->input->post('email'));
            }
            $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
            $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
            $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
            $data['social_links'] = json_encode($social_link);
            $data['biography'] = $this->input->post('biography');
            $data['title'] = html_escape($this->input->post('title'));
            $data['last_modified'] = strtotime(date("Y-m-d H:i:s"));

            if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
                unlink('uploads/user_image/' . $this->db->get_where('users', array('id' => $user_id))->row('image').'.jpg');
                $data['image'] = md5(rand(10000, 10000000));
            }

            // Update paypal keys
            $paypal_info = array();
            $paypal['production_client_id']  = html_escape($this->input->post('paypal_client_id'));
            $paypal['production_secret_key'] = html_escape($this->input->post('paypal_secret_key'));
            array_push($paypal_info, $paypal);
            $data['paypal_keys'] = json_encode($paypal_info);
            // Update Stripe keys
            $stripe_info = array();
            $stripe_keys = array(
                'public_live_key' => html_escape($this->input->post('stripe_public_key')),
                'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
            );
            array_push($stripe_info, $stripe_keys);
            $data['stripe_keys'] = json_encode($stripe_info);

            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
            $this->upload_user_image($data['image']);
            $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
        }else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }

    }
    public function delete_user($user_id = "") {
        $this->db->where('id', $user_id);
        $this->db->delete('users');
        $this->session->set_flashdata('flash_message', get_phrase('user_deleted_successfully'));
    }

    public function unlock_screen_by_password($password = "") {
        $password = sha1($password);
        return $this->db->get_where('users', array('id' => $this->session->userdata('user_id'), 'password' => $password))->num_rows();
    }

    public function register_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function register_user_update_code($data) {
        $update_code['verification_code'] = $data['verification_code'];
        $update_code['password'] = $data['password'];
        $this->db->where('email', $data['email']);
        $this->db->update('users', $update_code);
    }

    public function my_courses($user_id = "") {
        if ($user_id == "") {
            $user_id = $this->session->userdata('user_id');
        }
        return $this->db->get_where('enrol', array('user_id' => $user_id));
    }

    public function upload_user_image($image_code) {
        if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
            move_uploaded_file($_FILES['user_image']['tmp_name'], 'uploads/user_image/'.$image_code.'.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
        }
    }

    public function update_account_settings($user_id) {
        $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
        if ($validity) {
            if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
                $user_details = $this->get_user($user_id)->row_array();
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password');
                $confirm_password = $this->input->post('confirm_password');
                if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                    $data['password'] = sha1($new_password);
                }else {
                    $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
                    return;
                }
            }
            $data['email'] = html_escape($this->input->post('email'));
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
            $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        }else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }
    }

    public function change_password($user_id) {
        $data = array();
        if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $user_details = $this->get_all_user($user_id)->row_array();
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                $data['password'] = sha1($new_password);
            }else {
                $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
                return;
            }
        }

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
    }


    public function get_instructor($id = 0) {
        if ($id > 0) {
            return $this->db->get_where('users', array('id' => $id, 'is_instructor' => 1));
        }else{
            return $this->db->get_where('users', array('is_instructor' => 1));
        }
    }

    public function get_number_of_active_courses_of_instructor($instructor_id) {
        $checker = array(
          'user_id' => $instructor_id,
          'status'  => 'active'
        );
        $result = $this->db->get_where('course', $checker)->num_rows();
        return $result;
    }

    public function get_user_image_url($user_id) {
        $user_profile_image = $this->db->get_where('users', array('id' => $user_id))->row('image');
        if (file_exists('uploads/user_image/'.$user_profile_image.'.jpg'))
             return base_url().'uploads/user_image/'.$user_profile_image.'.jpg';
        else
            return base_url().'uploads/user_image/placeholder.png';
    }
    public function get_instructor_list() {
        $query1 = $this->db->get_where('course', array('status' => 'active'))->result_array();
        $instructor_ids = array();
        $query_result = array();
        foreach ($query1 as $row1) {
            if (!in_array($row1['user_id'], $instructor_ids) && $row1['user_id'] != "") {
                array_push($instructor_ids, $row1['user_id']);
            }
        }
        if (count($instructor_ids) > 0) {
            $this->db->where_in('id', $instructor_ids);
            $query_result = $this->db->get('users');
        }else {
            $query_result = $this->get_admin_details();
        }

        return $query_result;
    }

    public function update_instructor_paypal_settings($user_id = '') {
        // Update paypal keys
        $paypal_info = array();
        $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
        $paypal['production_secret_key'] = html_escape($this->input->post('paypal_secret_key'));
        array_push($paypal_info, $paypal);
        $data['paypal_keys'] = json_encode($paypal_info);
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }
    public function update_instructor_stripe_settings($user_id = '') {
        // Update Stripe keys
        $stripe_info = array();
        $stripe_keys = array(
            'public_live_key' => html_escape($this->input->post('stripe_public_key')),
            'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
        );
        array_push($stripe_info, $stripe_keys);
        $data['stripe_keys'] = json_encode($stripe_info);
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    // POST INSTRUCTOR APPLICATION FORM AND INSERT INTO DATABASE IF EVERYTHING IS OKAY
    public function post_instructor_application() {
        // FIRST GET THE USER DETAILS
        $user_details = $this->get_all_user($this->input->post('id'))->row_array();

        // CHECK IF THE PROVIDED ID AND EMAIL ARE COMING FROM VALID USER
        if ($user_details['email'] == $this->input->post('email')) {

            // GET PREVIOUS DATA FROM APPLICATION TABLE
            $previous_data = $this->get_applications($user_details['id'], 'user')->num_rows();
            // CHECK IF THE USER HAS SUBMITTED FORM BEFORE
            if($previous_data > 0) {
                $this->session->set_flashdata('error_message', get_phrase('already_submitted'));
                redirect(site_url('user/become_an_instructor'), 'refresh');
            }
            $data['user_id'] = $this->input->post('id');
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['message'] = $this->input->post('message');
            if (isset($_FILES['document']) && $_FILES['document']['name'] != "") {
                if (!file_exists('uploads/document')) {
                    mkdir('uploads/document', 0777, true);
                }
                $accepted_ext = array('doc', 'docs', 'pdf', 'txt', 'png', 'jpg', 'jpeg');
                $path = $_FILES['document']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (in_array(strtolower($ext), $accepted_ext)) {
                    $document_custom_name = random(15).'.'.$ext;
                    $data['document'] = $document_custom_name;
                    move_uploaded_file($_FILES['document']['tmp_name'], 'uploads/document/'.$document_custom_name);
                }else{
                    $this->session->set_flashdata('error_message', get_phrase('invalide_file'));
                    redirect(site_url('user/become_an_instructor'), 'refresh');
                }

            }
            $this->db->insert('applications', $data);
            $this->session->set_flashdata('flash_message', get_phrase('application_submitted_successfully'));
            redirect(site_url('user/become_an_instructor'), 'refresh');
        }else{
            $this->session->set_flashdata('error_message', get_phrase('user_not_found'));
            redirect(site_url('user/become_an_instructor'), 'refresh');
        }
    }


    // GET INSTRUCTOR APPLICATIONS
    public function get_applications($id = "", $type = "") {
        if ($id > 0 && !empty($type)) {
            if ($type == 'user') {
                $applications = $this->db->get_where('applications', array('user_id' => $id));
                return $applications;
            }else {
                $applications = $this->db->get_where('applications', array('id' => $id));
                return $applications;
            }
        }else{
            $this->db->order_by("id", "DESC");
            $applications = $this->db->get_where('applications');
            return $applications;
        }
    }

    // GET APPROVED APPLICATIONS
    public function get_approved_applications() {
        $applications = $this->db->get_where('applications', array('status' => 1));
        return $applications;
    }

    // GET PENDING APPLICATIONS
    public function get_pending_applications() {
        $applications = $this->db->get_where('applications', array('status' => 0));
        return $applications;
    }

    //UPDATE STATUS OF INSTRUCTOR APPLICATION
    public function update_status_of_application($status, $application_id) {
        $application_details = $this->get_applications($application_id, 'application');
        if ($application_details->num_rows() > 0) {
            $application_details = $application_details->row_array();
            if ($status == 'approve') {
                $application_data['status'] = 1;
                $this->db->where('id', $application_id);
                $this->db->update('applications', $application_data);

                $instructor_data['is_instructor'] = 1;
                $this->db->where('id', $application_details['user_id']);
                $this->db->update('users', $instructor_data);

                $this->session->set_flashdata('flash_message', get_phrase('application_approved_successfully'));
                redirect(site_url('admin/instructor_application'), 'refresh');
            }else{
                $this->db->where('id', $application_id);
                $this->db->delete('applications');
                $this->session->set_flashdata('flash_message', get_phrase('application_deleted_successfully'));
                redirect(site_url('admin/instructor_application'), 'refresh');
            }
        }else{
            $this->session->set_flashdata('error_message', get_phrase('invalid_application'));
            redirect(site_url('admin/instructor_application'), 'refresh');
        }
    }
	public function is_track_present($course_id,$user_id) {
        $this->db->where('user_id', $user_id);
		$this->db->where('course_id', $course_id);
        return $this->db->get('registration_track');
    }
	public function add_registration_track($data) {
        $this->db->insert('registration_track', $data);
        return $this->db->insert_id();
    }
	public function get_registration_tracks_count() {
		$sql = "SELECT COUNT(tid) AS total_count FROM registration_track";
        $result = $this->db->query($sql)->row_array();
        return $result['total_count'];
    }
	public function get_promocode_count() {
		$sql = "SELECT COUNT(id) AS total_count FROM promocode";
        $result = $this->db->query($sql)->row_array();
        return $result['total_count'];
    }
	public function get_registration_tracks($limit,$start) {
		$sql = "SELECT registration_track.*,users.*,course.title FROM registration_track LEFT JOIN users ON users.id=registration_track.user_id LEFT JOIN course ON course.id=registration_track.course_id ORDER BY registration_track.tid DESC LIMIT $start,$limit";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_promocode($limit,$start) {
		$sql = "SELECT * FROM promocode ORDER BY id DESC LIMIT $start,$limit";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_regtracks(){
        $sql = "SELECT DISTINCT date(createdon) AS createdon FROM registration_track";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_regtrack_courses(){
        $sql = "SELECT * FROM course";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_promcode(){
        $sql = "SELECT * FROM promocode";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_registration_tracks_filter($limit,$start,$course_id,$date) {
		$conditions = [];
        $search_where = '';

        if (!empty($course_id)){
            $conditions[] = 'course.id = '.$course_id;
        }
        if (!empty($date)){
            $conditions[] = "DATE(registration_track.createdon) = '".$date."'";
        }
        if ($conditions){
            $search_where .= " WHERE ".implode(" AND ", $conditions);
        }
		
		$sql = "SELECT registration_track.*,users.*,course.title FROM registration_track LEFT JOIN users ON users.id=registration_track.user_id LEFT JOIN course ON course.id=registration_track.course_id ".$search_where." ORDER BY registration_track.tid DESC LIMIT $start,$limit";
	    
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_registration_tracks_filter_count($course_id,$date) {
		$conditions = [];
        $search_where = '';

        if (!empty($course_id)){
            $conditions[] = 'course.id = '.$course_id;
        }
        if (!empty($date)){
            $conditions[] = "registration_track.createdon = '".$date."'";
        }
        if ($conditions){
            $search_where .= " WHERE ".implode(" AND ", $conditions);
        }
		
		$sql = "SELECT registration_track.*,users.*,course.title FROM registration_track LEFT JOIN users ON users.id=registration_track.user_id LEFT JOIN course ON course.id=registration_track.course_id ".$search_where;
        $result = $this->db->query($sql)->num_rows();
        return $result;
    }
	public function get_registration_tracks_searched_list($limit,$start,$search){
        $sql = "SELECT registration_track.*,users.*,course.title FROM registration_track LEFT JOIN users ON users.id=registration_track.user_id LEFT JOIN course ON course.id=registration_track.course_id
                WHERE (course.title LIKE '%$search%' OR users.first_name LIKE'%$search%' OR registration_track.createdon LIKE '%$search%' ) ORDER BY registration_track.tid DESC LIMIT $start,$limit";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_registration_tracks_searched_list_count($search){
        $sql = "SELECT registration_track.*,users.*,course.title FROM registration_track LEFT JOIN users ON users.id=registration_track.user_id LEFT JOIN course ON course.id=registration_track.course_id
                WHERE (course.title LIKE '%$search%' OR users.first_name LIKE'%$search%' OR registration_track.createdon LIKE '%$search%' )";
        $result = $this->db->query($sql)->num_rows();
        return $result;
    }
	public function get_promocode_list($limit,$start,$search){
        $sql = "SELECT * FROM promocode WHERE (promocode LIKE'%$search%' OR created_on LIKE '%$search%' ) ORDER BY id DESC LIMIT $start,$limit";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	public function get_promocode_list_count($search){
        $sql = "SELECT * FROM promocode WHERE (promocode LIKE'%$search%' OR created_on LIKE '%$search%' )";
        $result = $this->db->query($sql)->num_rows();
        return $result;
    }
	public function trackExport($course_id,$date) {
		$conditions = [];
        $search_where = '';

        if (!empty($course_id)){
            $conditions[] = 'course.id = '.$course_id;
        }
        if (!empty($date)){
            $conditions[] = "registration_track.createdon = '".$date."'";
        }
        if ($conditions){
            $search_where .= " WHERE ".implode(" AND ", $conditions);
        }
		
		$sql = "SELECT registration_track.*,users.*,course.title FROM registration_track LEFT JOIN users ON users.id=registration_track.user_id LEFT JOIN course ON course.id=registration_track.course_id ".$search_where;
	
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function get_setting(){
        $sql="SELECT * FROM zoom_credentials";
        $result = $this->db->query($sql)->result_array();
        return $result;
       // return $this->db->get_where('zoom_settings', array('user_id' => $uid))->result_array(); 
    }
    public function updateCredentials($id,$data){
        $this->db->where('id', $id);
        $query = $this->db->update("zoom_settings", $data);
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function addZoomSettingData($data){
        $this->db->insert('zoom_settings',$data);
        return $this->db->insert_id();
    }
    public function getCourses($id){
        $sql="SELECT * FROM course WHERE user_id=$id AND status='active'";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
    public function getUserDetails($id){
        return $this->db->get_where('users', array('id' => $id))->result_array();
    }

    public function addData($data){
        $this->db->insert('zoom_meeting_list',$data);
        return $this->db->insert_id();
    }
    public function getMeetingData($id){
        $sql="SELECT zoom_meeting_list.*,course.title AS ctitle
        FROM zoom_meeting_list 
        LEFT JOIN course ON course.id=zoom_meeting_list.course_id
        WHERE zoom_meeting_list.created_id=$id";
        $result = $this->db->query($sql)->result();
        return $result;
        //return $this->db->get_where('zoom_meeting_list', array('created_id' => $id))->result_array();
    }

    public function getMeetingJoinData($id){
        $sql = "SELECT zoom_meeting_list.*,users.first_name as creted_by_name
        FROM zoom_meeting_list 
        LEFT JOIN users ON users.id=zoom_meeting_list.created_id 
        WHERE zoom_meeting_list.mid=$id";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function getMeetingReportData($id){
        $sql = "SELECT zoom_meeting_list.*,users.first_name as created_by_name,course.title AS course_name,(SELECT COUNT(*)
            FROM zoom_history
            WHERE zoom_history.class_id= zoom_meeting_list.mid) as `total_viewers`
        FROM zoom_meeting_list 
        LEFT JOIN users ON users.id=zoom_meeting_list.created_id 
        LEFT JOIN course ON course.id=zoom_meeting_list.course_id
        WHERE zoom_meeting_list.created_id=$id AND zoom_meeting_list.status=2";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function getJoinedUsersData($id){
        $sql="SELECT zoom_history.*,users.first_name as fname, users.last_name as lname
        FROM zoom_history
        LEFT JOIN users ON users.id=zoom_history.user_id
        WHERE zoom_history.class_id=$id
        ORDER BY zoom_history.id";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function getUserMeetingDetails($id){
        $sql = "SELECT enrol.*,zoom_meeting_list.*,users.first_name AS created_by_name,course.title AS course_name
            FROM enrol 
            LEFT JOIN zoom_meeting_list ON zoom_meeting_list.course_id=enrol.course_id 
            LEFT JOIN users ON users.id=zoom_meeting_list.created_id
            LEFT JOIN course ON course.id=zoom_meeting_list.course_id
            WHERE enrol.user_id=$id";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function updateData($id,$data){
        $this->db->where('mid', $id);
        $query = $this->db->update("zoom_meeting_list", $data);
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function updatehistory($data){
        $this->db->where('class_id', $data['class_id']);
        $q = $this->db->get('zoom_history');
        if ($q->num_rows() > 0) {
            $row = $q->row();
            $total_hit = $row->total_hit + 1;
            $data['total_hit'] = $total_hit;
            $this->db->where('id', $row->id);
            $this->db->update('zoom_history', $data);
        } else {
            $this->db->insert('zoom_history', $data);
        }

    }
}