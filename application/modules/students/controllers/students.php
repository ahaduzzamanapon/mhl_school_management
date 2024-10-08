<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Students extends MX_Controller {

    /**
     * This controller is using for controlling to students
     *
     * Maps to the following URL
     * 		http://example.com/index.php/users
     * 	- or -  
     * 		http://example.com/index.php/users/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->load->model('studentmodel');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
    //This function is used for get all students in this system.
    public function allStudent() {
        if ($this->input->post('submit', TRUE)) {
            $data['class_id'] = $this->input->post('class', TRUE);
            if ($this->input->post('class', TRUE) && $this->input->post('section', TRUE)) {
                //Search student by class,section.
                $class = $this->input->post('class', TRUE);
                $section = $this->input->post('section', TRUE);
                $data['section'] = $section;
                if ($section == 'all') {
                    $data['studentInfo'] = $this->studentmodel->getStudentByClassSection($class, $section);
                    if (!empty($data)) {
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = 'This class is no student.';
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                } else {
                    $data['studentInfo'] = $this->studentmodel->getStudentByClassSection($class, $section);
                    if (!empty($data)) {
                        //If the class have student then run here.
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    } else {
                        //If the class have no any student then print the massage in the view.
                        $data['message'] = lang('stuc_1');
                        $this->load->view('temp/header');
                        $this->load->view('studentclass', $data);
                        $this->load->view('temp/footer');
                    }
                }
            } elseif ($this->input->post('class', TRUE)) {
                //onley search student by class or all student the class.
                $class = $this->input->post('class', TRUE);
                $data['studentInfo'] = $this->studentmodel->getAllStudent($class);
               /* echo "<pre>";
                print_r($data['studentInfo']);
                echo "<pre>";
                exit();*/
                if (!empty($data)) {
                    //If the class have student then run here.
                    $this->load->view('temp/header');
                    $this->load->view('studentclass', $data);
                    $this->load->view('temp/footer');
                } else {
                    //If the class have no any student then print the massage in the view.
                    $data['message'] = lang('stuc_1');
                    $this->load->view('temp/header');
                    $this->load->view('studentclass', $data);
                    $this->load->view('temp/footer');
                }
            }
        }
        else {
            //First of all this method run here and load class selecting view.
            $data['s_class'] = $this->common->selectClass();
            // print_r($data['s_class']);exit;
            $this->load->view('temp/header');
            $this->load->view('slectStudent', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is used for filtering to get students information
    //Whene class and section gave in the frontend, if the class have section he cane select the section and get student information in the viwe.
    public function ajaxClassSection() {
        $classTitle = $this->input->get('classTitle');
        $query = $this->common->getWhere('class', 'id', $classTitle);
        // echo $this->db->last_query();
        foreach ($query as $row) {
            $data = $row['section'];
        }
        if (!empty($data)) {
            $sectionArray = explode(",", $data);
            echo '<div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-4">
                            <select name="section" class="form-control">
                                <option value="all">' . lang('stu_sel_cla_velue_all') . '</option>';
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
                                <strong>' . lang('stu_sel_cla_no_Info') . '</strong> ' . lang('stu_sel_cla_no_section') . '
                        </div></div></div>';
        }
    }
    //This function is giving a student's the full information. 
    public function students_details() {
        $id = $this->input->get('id');
        $studentId = $this->input->get('sid');
        $data['studentInfo'] = $this->studentmodel->studentDetails($id);
        $data['photo'] = $this->studentmodel->studentPhoto($studentId);
        $this->load->view('temp/header');
        $this->load->view('studentsDetails', $data);
        $this->load->view('temp/footer');
    }
    //This function is use for edit student's informations.
    public function editStudent() {
        $userId = $this->input->get('userId');
        $studentInfoId = $this->input->get('sid');
        $studentClass = $this->input->get('di');
        $class_id = $this->input->get('class_id');
        if ($this->input->post('submit', TRUE)) {
            $username = $this->input->post('first_name', TRUE) . ' ' . $this->input->post('last_name', TRUE);
            
            if (isset($_FILES['userfile']) && is_uploaded_file($_FILES['userfile']['tmp_name'])){
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

                $studentsInfo = array(
                    'student_nam' => $this->db->escape_like_str($username),
                    'class_id' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                    'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                    'mother_name' => $this->db->escape_like_str($this->input->post('mother_name', TRUE)),
                    'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                    'sex' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                    'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                    'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                    'father_occupation' => $this->db->escape_like_str($this->input->post('father_occupation', TRUE)),
                    'father_incom_range' => $this->db->escape_like_str($this->input->post('father_incom_range', TRUE)),
                    'mother_occupation' => $this->db->escape_like_str($this->input->post('mother_occupation', TRUE)),
                    'last_class_certificate' => $this->db->escape_like_str($this->input->post('previous_certificate', TRUE)),
                    't_c' => $this->db->escape_like_str($this->input->post('tc', TRUE)),
                    'academic_transcription' => $this->db->escape_like_str($this->input->post('at', TRUE)),
                    'national_birth_certificate' => $this->db->escape_like_str($this->input->post('nbc', TRUE)),
                    'testimonial' => $this->db->escape_like_str($this->input->post('testmonial', TRUE)),
                    'documents_info' => $this->db->escape_like_str($this->input->post('submit_file_information', TRUE)),
                    'blood' => $this->db->escape_like_str($this->input->post('blood', TRUE)),
                    'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                    'student_photo' => $this->db->escape_like_str($uploadFileInfo['file_name'])
                );
            }
            else{
                $additional_data = array(
                    'username' => $this->db->escape_like_str($username),
                    'first_name' => $this->db->escape_like_str($this->input->post('first_name', TRUE)),
                    'last_name' => $this->db->escape_like_str($this->input->post('last_name', TRUE)),
                    'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                    'email' => $this->db->escape_like_str($this->input->post('email', TRUE))
                );

                $studentsInfo = array(
                'student_nam' => $this->db->escape_like_str($username),
                'class_id' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                'farther_name' => $this->db->escape_like_str($this->input->post('father_name', TRUE)),
                'mother_name' => $this->db->escape_like_str($this->input->post('mother_name', TRUE)),
                'birth_date' => $this->db->escape_like_str($this->input->post('birthdate', TRUE)),
                'sex' => $this->db->escape_like_str($this->input->post('sex', TRUE)),
                'present_address' => $this->db->escape_like_str($this->input->post('present_address', TRUE)),
                'permanent_address' => $this->db->escape_like_str($this->input->post('permanent_address', TRUE)),
                'father_occupation' => $this->db->escape_like_str($this->input->post('father_occupation', TRUE)),
                'father_incom_range' => $this->db->escape_like_str($this->input->post('father_incom_range', TRUE)),
                'mother_occupation' => $this->db->escape_like_str($this->input->post('mother_occupation', TRUE)),
                'last_class_certificate' => $this->db->escape_like_str($this->input->post('previous_certificate', TRUE)),
                't_c' => $this->db->escape_like_str($this->input->post('tc', TRUE)),
                'academic_transcription' => $this->db->escape_like_str($this->input->post('at', TRUE)),
                'national_birth_certificate' => $this->db->escape_like_str($this->input->post('nbc', TRUE)),
                'testimonial' => $this->db->escape_like_str($this->input->post('testmonial', TRUE)),
                'documents_info' => $this->db->escape_like_str($this->input->post('submit_file_information', TRUE)),
                'blood' => $this->db->escape_like_str($this->input->post('blood', TRUE)),
                'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
                );
            }
            // echo "<pre>";
            // print_r($studentsInfo);exit;
            
            $this->db->where('id', $userId);
            $this->db->update('users', $additional_data);
            
            $this->db->where('student_id', $studentInfoId);
            $this->db->update('student_info', $studentsInfo);

            $additionalData3 = array(
                'stu_machine_id' => $this->db->escape_like_str($this->input->post('admi_stu_machine_id')),
                'class_id' => $this->db->escape_like_str($this->input->post('class')),
                'student_title' => $this->db->escape_like_str($username),
                'section' => $this->db->escape_like_str($this->input->post('section')),
                'status' => $this->db->escape_like_str($this->input->post('status')),
                'roll_number' => $this->db->escape_like_str($this->input->post('roll_number', TRUE)),
            );
            $this->db->where('id', $studentClass);
            $this->db->update('class_students', $additionalData3);

            $data['success'] = '<div class="alert alert-info alert-dismissable admisionSucceassMessageFont">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                    <strong>' . lang('success') . '</strong> ' . lang('stuc_2') . '
                                </div>';
            $data['classStudents'] = $this->common->getWhere('class_students', 'id', $studentClass);
            $data['studentInfo'] = $this->common->getWhere('student_info', 'student_id', $studentInfoId);
            $data['users'] = $this->common->getWhere('users', 'id', $userId);
            $data['s_class'] = $this->common->getAllData('class');
            $data['sectiond'] = $this->studentmodel->section($class_id);

            $this->load->view('temp/header');
            $this->load->view('editStudentInfo', $data);
            $this->load->view('temp/footer');
        }
        else {
            //first here load the edit student view with student's previous value.
            $data['classStudents'] = $this->common->getWhere('class_students', 'id', $studentClass);
            $data['studentInfo'] = $this->common->getWhere('student_info', 'student_id', $studentInfoId);
            $data['users'] = $this->common->getWhere('users', 'id', $userId);
            $data['s_class'] = $this->common->getAllData('class');
            $data['sectiond'] = $this->studentmodel->section($class_id);
            // print_r($data['s_class'] );
            // echo $class_id; exit;
            $this->load->view('temp/header');
            $this->load->view('editStudentInfo', $data);
            $this->load->view('temp/footer');
        }
    }
    //This function is use for delete a student.
    public function studentDelete() {
        $id = $this->input->get('di');
        $studentInfoId = $this->input->get('sid');
        $userId = $this->input->get('userId');
        if ($this->db->delete('class_students', array('id' => $id)) && $this->db->delete('student_info', array('id' => $studentInfoId)) && $this->db->delete('users', array('id' => $userId))) {
            redirect('students/allStudent');
        }
    }
    //This function will return only logedin students information
    public function studentsInfo() {
        $uid = $this->input->get('uisd');
        $data['userInfo'] = $this->studentmodel->userGroupDetails($uid);
        $group_id = $data['userInfo'][0]['group_id']; 

        if($group_id == 5){
            $data['parent_info'] = $this->studentmodel->parentDetails($uid); 
            $student_id = $data['parent_info'][0]['student_id'];
            $data['studentData'] = $this->studentmodel->getStudentDetails($student_id);
            $uid = $data['studentData'][0]['user_id'];
            $data['studentInfo'] = $this->studentmodel->ownStudentDetails($uid);
        }else{
            $data['studentInfo'] = $this->studentmodel->ownStudentDetails($uid);
        }

        $data['photo'] = $this->studentmodel->ownStudentPhoto($uid);
        $this->load->view('temp/header');
        $this->load->view('studentsDetails', $data);
        $this->load->view('temp/footer');
    }
}
