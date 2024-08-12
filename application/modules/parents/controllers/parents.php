<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Parents extends CI_Controller {
    /**
     * This controller is using for 
     *
     * Maps to the following URL
     * 		http://example.com/index.php/parents
     * 	- or -  
     * 		http://example.com/index.php/parents/<method_name>
     */
    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
    //This function lode a view where is select class for know about parents infomation
    public function parentsInformation() {
        if ($this->input->post('submit', TRUE)) {
            $class_id = $this->input->post('class_id', TRUE);
            $data['classTitle'] = $this->common->class_title($class_id);
            $data['parents'] = $this->common->getWhere('parents_info', 'class_id', $class_id);
            $this->load->view('temp/header');
            $this->load->view('parentsInformation', $data);
            $this->load->view('temp/footer');
        } else {
            $data['s_class'] = $this->common->getAllData('class');
            $this->load->view('temp/header');
            $this->load->view('parents', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is used for filtering to get students information(which class and which section if the section in that class)
    //If any one want to select class section for get that section's parents thene he can call this ajax function from view file.
    public function ajaxClassSection() {
        $classTitle = $this->input->get('q');
        $query = $this->common->getWhere('class', 'class_title', $classTitle);
        foreach ($query as $row) {
            $data = $row;
        }
        echo '<input type="hidden" name="class" value="' . $classTitle . '">';
        if (!empty($data['section'])) {
            $section = $data['section'];
            $sectionArray = explode(",", $section);
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-4">
                            <select name="section" class="form-control">
                                <option value="all">' . lang('parc_1') . '</option>';
            foreach ($sectionArray as $sec) {
                echo '<option value="' . $sec . '">' . $sec . '</option>';
            }
            echo '</select></div>
                    </div>';
        } else {
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-warning">
                                <strong>' . lang('parc_2') . '</strong> ' . lang('parc_3') . '
                        </div></div></div>';
        }
    }
    //This function will update the parents information.
    public function editParentsInfo() {
        $userID = $this->input->get('puid');
        $parentsInfoId = $this->input->get('painid');

        if ($this->input->post('submit', TRUE)) {

            $userID = $this->input->post('puid', TRUE);
            $parentsInfoId = $this->input->post('painid', TRUE);

            $username = $this->input->post('first_name', TRUE) . ' ' . $this->input->post('last_name', TRUE);
            
            if (isset($_FILES['userfile']) && is_uploaded_file($_FILES['userfile']['tmp_name'])) 
            {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10000';
                $config['max_width'] = '10240';
                $config['max_height'] = '7680';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->do_upload();
                $uploadFileInfo = $this->upload->data();
                $this->upload->display_errors('<p>', '</p>');

                $additional_data = array(
                    'username' => $this->db->escape_like_str($username),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                    'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
                    'profile_image' => $this->db->escape_like_str($uploadFileInfo['file_name'])
                );
            }else{
                $additional_data = array(
                    'username' => $this->db->escape_like_str($username),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                    'email' => $this->db->escape_like_str($this->input->post('email', TRUE))
                );
            }
            
            $this->db->where('id', $userID);
            $this->db->update('users', $additional_data);
            $additionalData1 = array(
                'parents_name' => $this->db->escape_like_str($username),
                'relation' => $this->db->escape_like_str($this->input->post('guardianRelation', TRUE)),
                'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
                'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
            );
            $this->db->where('id', $parentsInfoId);
            $this->db->update('parents_info', $additionalData1);
            $data['s_class'] = $this->common->getAllData('class');
            $data['success'] = '<br><div class="col-md-12"><div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                        <strong>' . lang('success') . '</strong>' . lang('parc_4') . '
                                </div></div>';
            $this->load->view('temp/header');
            $this->load->view('parents', $data);
            $this->load->view('temp/footer');
        } else {
            $data['info'] = $this->common->getWhere('parents_info', 'id', $parentsInfoId);
            $data['puid'] = $userID;
            $data['painid'] = $parentsInfoId;
            $this->load->view('temp/header');
            $this->load->view('editParents', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is using for delete any parents profile.
    public function deleteParents() {
        $userID = $this->input->get('UcsHeRnHdtfgrfGshId');
        $parentsInfoId = $this->input->get('pdfdsfAjhgdfrRdfeNdsfdtSjdcfgdInfOdfgdfhIdnfd');
		
		$USER = $this->uri->segment(3);
		
		$this->db->select('user_id');
		$this->db->from('parents_info');
		$this->db->where('id',$USER);
		$user_id = $this->db->get()->row()->user_id;
		//echo $this->db->last_query();
		
		$this->db->where('id',$USER);
		$this->db->delete('parents_info');
		
		$this->db->where('id',$user_id);
		$this->db->delete('users');
		//exit;
        
        //$this->db->delete('users', array('id' => $userID));
        //$this->db->delete('parents_info', array('id' => $parentsInfoId));

        redirect("parents/parentsInformation", 'refresh');
    }
}
