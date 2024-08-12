<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

Class Transport extends CI_Controller {

    /**
     * This controller is using for control transport
     *
     * Maps to the following URL
     * 		http://example.com/index.php/transport
     * 	- or -  
     * 		http://example.com/index.php/transport/<method_name>
     */
    public function __construct() {
        parent::__construct();
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->load->library('form_validation');        
    }

    public function assignTrnsStudentEdit($id) {
        //$id = $this->input->get('id');

        $this->form_validation->set_rules('class_id', 'Class name', 'required');
        $this->form_validation->set_rules('studentId', 'select student', 'required');
        $this->form_validation->set_rules('date', 'assign date', 'required');
        $this->form_validation->set_rules('route_id', 'select route', 'required');

        if($this->form_validation->run() == TRUE){
            // print_r($this->session->all_userdata());
            // print_r($this->input->post()); exit;

            $form_data = array(
                'class_id' => $this->input->post('class_id'),
                'route_id' => $this->input->post('route_id'),
                'student_id' => $this->input->post('studentId'),
                'enroll_date' => date('Y-m-d', strtotime($this->input->post('date'))),                
                'user_id' => $this->session->userdata('user_id')
                );

            $this->db->where('id', $id);
            if ($this->db->update('transport_assign', $form_data)) {
                $this->session->set_flashdata('message', 'Update successfully.');
                redirect("transport/assignTrnsList");
            }
        }

        $data['info'] = $this->common->getWhere('transport_assign', 'id', $id);
        // echo $data['info'][0]['class_id'];

        $data['s_class'] = $this->common->getAllData('class');
        $data['query'] = $this->common->GetAll('student_info', 'class_id', $data['info'][0]['class_id'],'roll_number');
        // print_r($query); exit;

        $data['trans_route'] = $this->common->getAllData('transport');
        // print_r($data['s_class']); exit;$Class_id

        $this->load->view('temp/header');
        $this->load->view('assignTrnsStudentEdit', $data);
        $this->load->view('temp/footer');
        
    }

    public function assignTrnsStudent() {
        $this->form_validation->set_rules('class_id', 'Class name', 'required');
        $this->form_validation->set_rules('studentId', 'select student', 'required');
        $this->form_validation->set_rules('date', 'assign date', 'required');
        $this->form_validation->set_rules('route_id', 'select route', 'required');

        if($this->form_validation->run() == TRUE){
            // print_r($this->session->all_userdata());
            // print_r($this->input->post()); exit;

            $form_data = array(
                'class_id' => $this->input->post('class_id'),
                'route_id' => $this->input->post('route_id'),
                'student_id' => $this->input->post('studentId'),
                'enroll_date' => date('Y-m-d', strtotime($this->input->post('date'))),                
                'user_id' => $this->session->userdata('user_id')
                );

            if($this->db->insert('transport_assign', $form_data)){                
                $this->session->set_flashdata('message', 'Save successfully.');
                // redirect("committee/national");
            }
        }

        $data['s_class'] = $this->common->getAllData('class');
        // print_r($data['s_class']); exit;

        $this->load->view('temp/header');
        $this->load->view('assignTrnsStudent', $data);
        $this->load->view('temp/footer');
    }

    public function assignTrnsList() {
        $data['results'] = $this->common->transport_assign_list();
        $this->load->view('temp/header');
        $this->load->view('assignTrnsList', $data);
        $this->load->view('temp/footer');
    }

    //This function is using for adding transport and it's informations.
    public function addTransport() {
        if ($this->input->post('submit', TRUE)) {
            $routeInfoInsert = array(
                'rout_title' => $this->db->escape_like_str($this->input->post('routeTitle', TRUE)),
                'start_end' => $this->db->escape_like_str($this->input->post('startEnd', TRUE)),
                'vicles_amount' => $this->db->escape_like_str($this->input->post('vehiclesAmount', TRUE)),
                'descriptions' => $this->db->escape_like_str($this->input->post('description', TRUE)),
            );
            //now submit data into database and load view.
            if ($this->db->insert('transport', $routeInfoInsert)) {
                redirect('transport/allTransport', 'refresh');
            }
        } else {
            $data['transport_route'] = $this->common->getAllData('transport_route'); 
            $this->load->view('temp/header');
            $this->load->view('addTransport',$data);
            $this->load->view('temp/footer');
        }
    }
    public function addTransportroute() {
        if ($this->input->post('submit', TRUE)) {
            $routeInfoInsert = array(
                'start_end' => $this->db->escape_like_str($this->input->post('startEnd', TRUE)),
                'descriptions' => $this->db->escape_like_str($this->input->post('description', TRUE)),
            );
            //now submit data into database and load view.
            if ($this->db->insert('transport_route', $routeInfoInsert)) {
                $data['transport_route'] = $this->common->getAllData('transport_route');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong> Success! </strong> Route(Start/End) added successfully.</strong>
                            </div>';
                $this->load->view('temp/header');
                $this->load->view('addTransportroute', $data);
                $this->load->view('temp/footer');
                redirect('transport/addTransportroute', 'refresh');
            }
        } else {
            $data['transport_route'] = $this->common->getAllData('transport_route');
            $this->load->view('temp/header');
            $this->load->view('addTransportroute',$data);
            $this->load->view('temp/footer');
        }
    }

    public function transportRouteEdit() {
        $id = $this->input->get('id');

        if ($this->input->post('submit', TRUE)) {
            // $id = $this->input->post('item_id', TRUE);
            $data = array(
                'start_end' => $this->db->escape_like_str($this->input->post('start_end', TRUE)),
                'descriptions' => $this->db->escape_like_str($this->input->post('description', TRUE)),
            );
            $this->db->where('id', $id);
            if ($this->db->update('transport_route', $data)) {
                $data['transport_route'] = $this->common->getAllData('transport_route');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong> Success! </strong> Route(Start/End) Update successfully.</strong>
                            </div>';
                $this->load->view('temp/header');
                $this->load->view('addTransportroute', $data);
                $this->load->view('temp/footer');
                redirect('transport/addTransportroute', 'refresh');
            }
        } else {
            //$data['transport_route'] = $this->common->getAllData('transport_route');
            $data['transport_route'] = $this->common->getWhere('transport_route', 'id', $id);
            $this->load->view('temp/header');
            $this->load->view('editTransportroute',$data);
            $this->load->view('temp/footer');
        }
    }
   /* public function transpoRtroute_edit() {
        $id = $this->input->post('hide_id', TRUE);

        if ($this->input->post('submit', TRUE)) {
            // $id = $this->input->post('item_id', TRUE);
            $data = array(
                'fee_title' => $this->db->escape_like_str($this->input->post('fee_title', TRUE)),
                'pay_type' => $this->db->escape_like_str($this->input->post('pay_type', TRUE)),
                'status' => $this->db->escape_like_str($this->input->post('status', TRUE)),
            );
            $this->db->where('id', $id);
            if ($this->db->update('fee_type', $data)) {
                $data['fee_type'] = $this->common->getAllData('fee_type');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong> Success! </strong> Information updated successfully.</strong>
                            </div>';

                $data['payment_type'] = array('-Select One-'=>'', 'Monthly'=>'Monthly', 'Quarterly'=>'Quarterly', 'Yearly'=>'Yearly');
                $this->load->view('temp/header');
                $this->load->view('setFee', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $id = $this->input->get('id');
            $data['info'] = $this->configarationmodel->fee_type_info($id);
            $data['payment_type'] = array('-Select One-'=>'', 'Monthly'=>'Monthly', 'Quarterly'=>'Quarterly', 'Yearly'=>'Yearly');
            $this->load->view('temp/header');
            $this->load->view('edit_fee_type', $data);
            $this->load->view('temp/footer');
        }
    }*/
    // This function is showing all transport
    public function allTransport() {
        $data['transport'] = $this->common->transportAll('transport');
        // print_r($data);
        $this->load->view('temp/header');
        $this->load->view('allTransport', $data);
        $this->load->view('temp/footer');
    }

    //Here edit or update the previos information whisch 
    public function editTransport() {
        $id = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {
            $routeInfoInsert = array(
                'rout_title' => $this->db->escape_like_str($this->input->post('routeTitle', TRUE)),
                'start_end' => $this->db->escape_like_str($this->input->post('startEnd', TRUE)),
                'vicles_amount' => $this->db->escape_like_str($this->input->post('vehiclesAmount', TRUE)),
                'descriptions' => $this->db->escape_like_str($this->input->post('description', TRUE)),
            );
            //now submit data into database and load view.
            $this->db->where('id', $id);
            if ($this->db->update('transport', $routeInfoInsert)) {
                redirect('transport/allTransport', 'refresh');
            }
        } else {
            $data['trans_route'] = $this->common->getAllData('transport_route');
            $data['transport'] = $this->common->getWhere('transport', 'id', $id);
            $this->load->view('temp/header');
            $this->load->view('editTransport', $data);
            $this->load->view('temp/footer');
        }
    }

    //THis function is using to delete Transport
    public function deleteTransport() {
        $id = $this->input->get('id');
        if ($this->db->delete('transport', array('id' => $id))) {
            redirect('transport/allTransport', 'refresh');
        }
    }

    public function deleteTransportroute() {
        $id = $this->input->get('id');
        if ($this->db->delete('transport_route', array('id' => $id))) {
            redirect('transport/addTransportroute', 'refresh');
        }
    }
    public function deleteAssignTransport() {
        $id = $this->input->get('id');
        if ($this->db->delete('transport_assign', array('id' => $id))) {
            redirect('transport/assignTrnsList', 'refresh');
        }
    }
    

    function student_id()
    {
        $Class_id = $this->input->get('q', TRUE);
        $feeItem = $this->common->getWhere('fee_item', 'class_id', $Class_id);
        //echo $this->db->last_query(); //exit;
        $query = $this->common->GetAll('student_info', 'class_id', $Class_id,'roll_number');
        $trans_start_route = $this->common->getAllData('transport_route');
        //$trans_route = $this->common->getWhere('transport','start_end',$route_id_n);

        //print_r($trans_route);
        echo '
        <div class="col-md-5 col-md-offset-3">
            <div class="form-group">
                <label class="control-label">Student Id <span class="requiredStar"> * </span></label>

                <select name="studentId" onchange="studentInfo(this.value)" id="stdId" class="form-control" data-validation="required">
                    <option value="">Select one</option>';
                    foreach ($query as $studentId) 
                    {
                        echo '<option value="' . $studentId['student_id'] . '">' . $studentId['student_id'].'  ( '.$studentId['roll_number'].' - '.$studentId['student_nam']. ' )</option>';
                    }
            echo '</select> 
            </div>
            <div class="form-group">
                <label class="control-label">Select Route (Start/End)<span class="requiredStar"> * </span></label>
                <select name="" class="form-control" onchange="allRoute(this.value)">
                    <option value="">Select one</option>';
                    foreach ($trans_start_route as $row) 
                    {
                        echo '<option value="' . $row['id'] . '">' . $row['start_end'].'</option>';
                    }
                echo '</select> 
            </div>

            <div class="form-group">
                <label class="control-label">Select Route (Place)<span class="requiredStar"> * </span></label>
                <select name="route_id" class="form-control" data-validation="required" id="route">
                    <option value="">Select one</option>';
                    foreach ($trans_route as $row) 
                    {
                        echo '<option value="' . $row['id'] . '">' . $row['rout_title'].'</option>';
                    }
                echo '</select> 
            </div>
            <div class="form-group">
                <label class="control-label">Start Date <span class="requiredStar"> * </span></label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" name="date" class="form-control" value="'.date("d-m-Y").'" data-validation="required" >
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">            
            <div id="ajaxResult"></div>
        </div>';

        echo '<div style="clear:both;"> </div>';
    }

    function routes_id()
    {
        $trans_id = $this->input->get('q', TRUE);
        $trans_route = $this->common->getWhere('transport','start_end',$trans_id);
        echo'<option value="">Select one</option>';
        foreach ($trans_route as $row) 
        {
            echo '<option value="' . $row['id'] . '">' . $row['rout_title'].' - '.$row['vicles_amount'].'</option>';
        }
    }

    public function studentInfoById() 
    {
        $studentId = $this->input->get('q', TRUE);
        $query = $this->common->stuInfoId($studentId);
        if (empty($query)) {
            echo '<div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <strong>Info:</strong> This student ID <strong>' . $studentId . '</strong> is not matching in our student\'s list.
                </div></div></div>';
            } else {
                echo 'Image <br><div class="col-md-4 stuInfoIdBox">   
                <img src="assets/uploads/' . $query->student_photo . '" class="img-responsive" alt=""><br>
            </div>';
        }
    }

}
