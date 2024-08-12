*<?php

    if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
    }

    class Configuration extends MX_Controller
    {

        /**
         * This controller is using for configur this system
         *
         * Maps to the following URL
         * 		http://example.com/index.php/users
         * 	- or -  
         * 		http://example.com/index.php/users/<method_name>
         */
        function __construct()
        {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('configarationmodel');
            $this->load->library('form_validation');
            if (!$this->ion_auth->logged_in()) {
                redirect('auth/login');
            }
        }

        //This function is useing for control the weekly holyday.
        public function conWeeklyDay()
        {
            if ($this->input->post('submit', TRUE)) {
                $dayId_1 = $this->input->post('dayID1', TRUE);
                $status_1 = $this->input->post('status1', TRUE);
                $data = array(
                    'status' => $this->db->escape_like_str($status_1),
                );
                $this->db->where('day_name', $dayId_1);
                $this->db->update('config_week_day', $data);
                $dayId_2 = $this->input->post('dayID2', TRUE);
                $status_2 = $this->input->post('status2', TRUE);
                $data2 = array(
                    'status' => $this->db->escape_like_str($status_2),
                );
                $this->db->where('day_name', $dayId_2);
                $this->db->update('config_week_day', $data2);
                $dayId_3 = $this->input->post('dayID3', TRUE);
                $status_3 = $this->input->post('status3', TRUE);
                $data3 = array(
                    'status' => $this->db->escape_like_str($status_3),
                );
                $this->db->where('day_name', $dayId_3);
                $this->db->update('config_week_day', $data3);
                $dayId_4 = $this->input->post('dayID4', TRUE);
                $status_4 = $this->input->post('status4', TRUE);
                $data4 = array(
                    'status' => $this->db->escape_like_str($status_4),
                );
                $this->db->where('day_name', $dayId_4);
                $this->db->update('config_week_day', $data4);
                $dayId_5 = $this->input->post('dayID5', TRUE);
                $status_5 = $this->input->post('status5', TRUE);
                $data5 = array(
                    'status' => $this->db->escape_like_str($status_5),
                );
                $this->db->where('day_name', $dayId_5);
                $this->db->update('config_week_day', $data5);
                $dayId_6 = $this->input->post('dayID6', TRUE);
                $status_6 = $this->input->post('status6', TRUE);
                $data6 = array(
                    'status' => $this->db->escape_like_str($status_6),
                );
                $this->db->where('day_name', $dayId_6);
                $this->db->update('config_week_day', $data6);
                $dayId_7 = $this->input->post('dayID7', TRUE);
                $status_7 = $this->input->post('status7', TRUE);
                $data7 = array(
                    'status' => $this->db->escape_like_str($status_7),
                );
                $this->db->where('day_name', $dayId_7);
                $this->db->update('config_week_day', $data7);
                redirect('configuration/conWeeklyDay', 'refresh');
            } else {
                $data['WeeklyDay'] = $this->common->getAllData('config_week_day');
                $this->load->view('temp/header');
                $this->load->view('configurWeeklyDay', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function is setting the examination seatting
        public function generalSetting()
        {
            if ($this->input->post('submit', TRUE)) {
                //here is checking that configuration table is empty or not.
                if ($this->db->empty_table('configuration')) {
                    $insertArray = array(
                        'school_name' => $this->db->escape_like_str($this->input->post('schoolName', TRUE)),
                        'starting_year' => $this->db->escape_like_str($this->input->post('startingDate', TRUE)),
                        'headmaster_name' => $this->db->escape_like_str($this->input->post('headmasterName', TRUE)),
                        'address' => $this->db->escape_like_str($this->input->post('address', TRUE)),
                        'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                        'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
                        'currenct' => $this->db->escape_like_str($this->input->post('currency', TRUE)),
                        'country' => $this->db->escape_like_str($this->input->post('country', TRUE)),
                        'countryPhonCode' => $this->db->escape_like_str($this->input->post('phoneNumberCode', TRUE)),
                        'time_zone' => $this->db->escape_like_str($this->input->post('timeZone', TRUE))
                    );
                    $this->db->insert('configuration', $insertArray);
                    $data['message'] = lang('') . "This system's settings is completed Now.<br><h3>" . lang('') . "Thank You</h3>";
                    $data['info'] = $this->common->getAllData('configuration');
                    //Now lode view with success message
                    $this->load->view('temp/header');
                    $this->load->view('generalSettings', $data);
                    $this->load->view('temp/footer');
                } else {
                    $insertArray = array(
                        'school_name' => $this->db->escape_like_str($this->input->post('schoolName', TRUE)),
                        'starting_year' => $this->db->escape_like_str($this->input->post('startingDate', TRUE)),
                        'headmaster_name' => $this->db->escape_like_str($this->input->post('headmasterName', TRUE)),
                        'address' => $this->db->escape_like_str($this->input->post('address', TRUE)),
                        'phone' => $this->db->escape_like_str($this->input->post('phone', TRUE)),
                        'email' => $this->db->escape_like_str($this->input->post('email', TRUE)),
                        'currenct' => $this->db->escape_like_str($this->input->post('currency', TRUE)),
                        'country' => $this->db->escape_like_str($this->input->post('country', TRUE)),
                        'time_zone' => $this->db->escape_like_str($this->input->post('timeZone', TRUE))
                    );
                    $this->db->where('id', '0');
                    $this->db->update('configuration', $insertArray);
                    $data['message'] = lang('') . "This system's settings is completed Now.<br><h3>" . lang('') . "Thank You</h3>";
                    $data['info'] = $this->common->getAllData('configuration');
                    //Now lode view with success message
                    $this->load->view('temp/header');
                    $this->load->view('generalSettings', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $data['info'] = $this->common->getAllData('configuration');
                $this->load->view('temp/header');
                $this->load->view('generalSettings', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function can select the system language
        public function language()
        {
            if ($this->input->post('submit', TRUE)) {
                $languageTitle = $this->input->post('language', TRUE);
                $insertData = array(
                    'language' => $languageTitle
                );
                $this->db->where('id', '1');
                $this->db->update('configuration', $insertData);
                redirect('configuration/language', 'refresh');
            } else {
                $data['language'] = $this->configarationmodel->language();
                $this->load->view('temp/header');
                $this->load->view('languageSetting', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function set whice message system will use in this system
        public function messageSettings()
        {
            if ($this->input->post('submit', TRUE)) {
                $updateData = array(
                    'msg_apai_email' => $this->db->escape_like_str($this->input->post('username', TRUE)),
                    'msg_hash_number' => $this->db->escape_like_str($this->input->post('hash', TRUE)),
                    'msg_sender_title' => $this->db->escape_like_str($this->input->post('senderSmsTitle', TRUE))
                );
                $this->db->where('id', '1');
                if ($this->db->update('configuration', $updateData)) {
                    $success['Message'] = '<div class="alert alert-success">
                                            <strong>' . lang('success') . '</strong>' . lang('conc_1') . '
                                    </div>';
                    $this->load->view('temp/header');
                    $this->load->view('messageSettinge', $success);
                    $this->load->view('temp/footer');
                } else {
                    $error['Message'] = '<div class="alert alert-success">
                                            <strong>' . lang('error') . '</strong> ' . lang('conc_2') . '
                                    </div>';
                    $this->load->view('temp/header');
                    $this->load->view('messageSettinge', $error);
                    $this->load->view('temp/footer');
                }
            } else {
                $this->load->view('temp/header');
                $this->load->view('messageSettinge');
                $this->load->view('temp/footer');
            }
        }

        public function numberConvertionBtE($number)
        {
            $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
            $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
            $en_number = str_replace($search_array, $replace_array, $number);

            return $en_number;
        }

        //This function is using for set student's tution and other fees
        public function setFee()
        {
            if ($this->input->post('submit', TRUE) && $this->input->post('fee_title', TRUE)) {
                $data = array(
                    // 'class_id' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                    'fee_title' => $this->db->escape_like_str($this->input->post('fee_title', TRUE)),
                    'pay_type' => $this->db->escape_like_str($this->input->post('pay_type', TRUE)),
                    // 'amount' => $this->numberConvertionBtE($this->input->post('amount', TRUE)),
                    // 'year' => $this->db->escape_like_str(date('Y')),
                );
                if ($this->db->insert('fee_type', $data)) {
                    // $data['classTile'] = $this->common->getAllData('class');
                    $data['fee_type'] = $this->common->getAllData('fee_type');
                    $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong> Success! </strong> Item added successfully.</strong>
                            </div>';
                    $this->load->view('temp/header');
                    $this->load->view('setFee', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                //$data['classTile'] = $this->common->getAllData('class');
                $data['fee_type'] = $this->common->getAllData('fee_type');
                $this->load->view('temp/header');
                $this->load->view('setFee', $data);
                $this->load->view('temp/footer');
            }
        }

        public function fee_type_edit()
        {
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

                    $data['payment_type'] = array('-Select One-' => '', 'Monthly' => 'Monthly', 'Quarterly' => 'Quarterly', 'Yearly' => 'Yearly');
                    $this->load->view('temp/header');
                    $this->load->view('setFee', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $id = $this->input->get('id');
                $data['info'] = $this->configarationmodel->fee_type_info($id);
                $data['payment_type'] = array('-Select One-' => '', 'Monthly' => 'Monthly', 'Quarterly' => 'Quarterly', 'Yearly' => 'Yearly');
                $this->load->view('temp/header');
                $this->load->view('edit_fee_type', $data);
                $this->load->view('temp/footer');
            }
        }

        public function delete_fee_type()
        {
            $id = $this->input->get('id');
            if ($this->db->delete('fee_type', array('id' => $id))) {
                // $data['classTile'] = $this->common->getAllData('class');
                $data['fee_type'] = $this->common->getAllData('fee_type');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                <strong> Success! </strong> Item deleted successfully.</strong>
                            </div>';
                $this->load->view('temp/header');
                $this->load->view('setFee', $data);
                $this->load->view('temp/footer');
            }
        }
        //Zuel 08-04-18
        public function setScholarship()
        {
            $this->form_validation->set_rules('class_id', 'Class name', 'required');
            $this->form_validation->set_rules('studentId', 'select student', 'required');
            $this->form_validation->set_rules('scholarship_type', 'select type', 'required');
            $this->form_validation->set_rules('date', 'assign date', 'required');
            // $this->form_validation->set_rules('route_id', 'select route', 'required');

            if ($this->form_validation->run() == TRUE) {
                // print_r($this->session->all_userdata());
                // print_r($this->input->post()); exit;

                $form_data = array(
                    'class_id' => $this->input->post('class_id'),
                    'student_id' => $this->input->post('studentId'),
                    's_type' => $this->input->post('scholarship_type'),
                    'amount' => $this->input->post('custome_amt'),
                    'assign_date' => date('Y-m-d', strtotime($this->input->post('date'))),
                    'user_id' => $this->session->userdata('user_id')
                );
                // print_r($form_data);
                // exit;
                $check = $this->db->select()->where('student_id', $form_data['student_id'])->get('stu_scholarship')->num_rows;
                if ($check > 0) {
                    // echo 'This ID in Scholarshiped!';
                    redirect("configuration/setScholarship");
                }

                if ($this->db->insert('stu_scholarship', $form_data)) {
                    $this->session->set_flashdata('message', 'Save successfully.');
                    // redirect("committee/national");
                }
            }

            $data['s_class'] = $this->common->getAllData('class');
            // print_r($data['s_class']); exit;

            $this->load->view('temp/header');
            $this->load->view('setScholarship', $data);
            $this->load->view('temp/footer');
        }

        function student_id()
        {
            $Class_id = $this->input->get('q', TRUE);
            $feeamount = $this->db->select('amount')->where('class_id', $Class_id)->where('fee_type_id', 1)->get('fee_item')->row('amount');
            //echo $this->db->last_query(); //exit;
            $query = $this->common->GetAll('student_info', 'class_id', $Class_id, 'roll_number');
            //$trans_route = $this->common->getAllData('transport');

            //print_r($trans_route);


            echo '<div class="col-md-5 col-md-offset-3">
                <div class="form-group">
                    <label class="control-label">Tution Fee:</label>
                    <input type="hidden" value="' . $feeamount . '" id="sho_amount">
                    <span><b>' . $feeamount . ' TK </b></span>
                </div>

                <div class="form-group">
                    <label class="control-label">Student Id <span class="requiredStar"> * </span></label>

                    <select name="studentId" onchange="studentInfo(this.value)" id="stdId" class="form-control" data-validation="required">
                        <option value="">Select one</option>';
            foreach ($query as $studentId) {
                echo '<option value="' . $studentId['student_id'] . '">' . $studentId['student_id'] . '  ( ' . $studentId['roll_number'] . ' - ' . $studentId['student_nam'] . ' )</option>';
            }
            echo '</select> 
                </div>

                <div class="form-group">
                    <label class="control-label">Select Scholarship Type<span class="requiredStar"> * </span></label>

                    <select name="scholarship_type" class="form-control" onchange="sch_cal(this.value)" data-validation="required">
                        <option value="">--Select--</option>
                        <option value="Full Free">Full Free (100%)</option>
                        <option value="Half Free">Half Free (50%)</option>
                        <option value="Fixed Amount">Fixed Amount</option>
                    </select> 
                </div>
                <div class="form-group">
                    <label class="control-label">Scholarship Amount: </label>
                    <span id="final_amount"> -- </span>
                </div>

                <div class="form-group">
                        <label class="control-label">Start Date <span class="requiredStar"> * </span></label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" name="date" class="form-control" value="' . date("d-m-Y") . '" data-validation="required" >
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-4">            
                <div id="ajaxResult"></div>
            </div>

            ';

            echo '<div style="clear:both;"> </div>';
            echo '</div>';
        }

        public function listScholarship()
        {
            $data['results'] = $this->common->listScholarship();
            $this->load->view('temp/header');
            $this->load->view('listScholarship', $data);
            $this->load->view('temp/footer');
        }

        public function deleteScholarship()
        {
            $id = $this->input->get('id');
            if ($this->db->delete('stu_scholarship', array('id' => $id))) {
                redirect('configuration/listScholarship', 'refresh');
            }
        }





        //This function is using for set student's tution and other fees
        public function setStuFee()
        {
            if ($this->input->post('submit', TRUE)) {
                $data = array(
                    'class_id' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                    'fee_type_id' => $this->db->escape_like_str($this->input->post('fee_type_id', TRUE)),
                    // 'title' => $this->db->escape_like_str($this->input->post('title', TRUE)),
                    'amount' => $this->numberConvertionBtE($this->input->post('amount', TRUE)),
                    'year' => $this->db->escape_like_str(date('Y')),
                );
                if ($this->db->insert('fee_item', $data)) {
                    $data['classTile'] = $this->common->getAllData('class');
                    $data['fee_types'] = $this->common->getAllData('fee_type');
                    $data['fee_item'] = $this->common->getAllData('fee_item');
                    $data['message'] = '<div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
								<strong> Success! </strong> Item added successfully.</strong>
							</div>';
                    $this->load->view('temp/header');
                    $this->load->view('allClassFees', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $data['classTile'] = $this->common->getAllData('class');
                $data['fee_types'] = $this->common->getAllData('fee_type');
                $data['fee_item'] = $this->common->getAllData('fee_item');

                $this->load->view('temp/header');
                $this->load->view('allClassFees', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function will edit student fee item information
        public function fee_item_edit()
        {
            if ($this->input->post('submit', TRUE)) {
                $id = $this->input->post('item_id', TRUE);
                $data = array(
                    'class_id' => $this->db->escape_like_str($this->input->post('class', TRUE)),
                    'fee_type_id' => $this->db->escape_like_str($this->input->post('fee_type_id', TRUE)),
                    // 'title' => $this->db->escape_like_str($this->input->post('title', TRUE)),
                    'amount' => $this->db->escape_like_str($this->input->post('amount', TRUE)),
                    'year' => $this->db->escape_like_str(date('Y')),
                );
                $this->db->where('id', $id);
                if ($this->db->update('fee_item', $data)) {
                    $data['classTile'] = $this->common->getAllData('class');
                    $data['fee_types'] = $this->common->getAllData('fee_type');
                    $data['fee_item'] = $this->common->getAllData('fee_item');

                    $data['message'] = '<div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
								<strong> Success! </strong> Item information updated successfully.</strong>
							</div>';
                    $this->load->view('temp/header');
                    $this->load->view('allClassFees', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $id = $this->input->get('id');
                $data['classTile'] = $this->common->getAllData('class');
                $data['fee_types'] = $this->common->getAllData('fee_type');
                $data['fee_item'] = $this->configarationmodel->item_fee_info($id);
                $this->load->view('temp/header');
                $this->load->view('edit_fee_item', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function will delete student fee collection item
        public function delete_fee_item()
        {
            $id = $this->input->get('id');
            if ($this->db->delete('fee_item', array('id' => $id))) {
                $data['classTile'] = $this->common->getAllData('class');
                $data['fee_item'] = $this->common->getAllData('fee_item');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
								<strong> Success! </strong> Item deleted from items list successfully.</strong>
							</div>';
                $this->load->view('temp/header');
                $this->load->view('allClassFees', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function will show all employe salary
        public function employSalary()
        {
            if ($this->input->post('submit', TRUE)) {
                $treatment = $this->input->post('treatment', TRUE);
                $increased = $this->input->post('increased', TRUE);
                $basic = $this->input->post('basic_pay', TRUE);
                $others = $this->input->post('others', TRUE);
                $setData = array(
                    'year' => $this->db->escape_like_str(date('Y')),
                    'employ_user_id' => $this->db->escape_like_str($this->input->post('emplyId', TRUE)),
                    'employe_title' => $this->db->escape_like_str($this->input->post('employe_title', TRUE)),
                    'job_post' => $this->db->escape_like_str($this->input->post('job_post', TRUE)),
                    'treatment' => $this->db->escape_like_str($treatment),
                    'increased' => $this->db->escape_like_str($increased),
                    'basic' => $this->db->escape_like_str($basic),
                    'others' => $this->db->escape_like_str($others),
                    'total' => $this->db->escape_like_str($treatment + $increased + $basic + $others),
                );
                if ($this->db->insert('set_salary', $setData)) {
                    $setData2 = array(
                        'salary' => $this->db->escape_like_str(1)
                    );
                    $this->db->where('id', $this->input->post('emplyId', TRUE));
                    $this->db->update('users', $setData2);
                    $data['salaryInfo'] = $this->configarationmodel->salaryInfo();
                    $data['emplaye'] = $this->configarationmodel->employ();
                    $this->load->view('temp/header');
                    $this->load->view('employSalary', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $data['salaryInfo'] = $this->configarationmodel->salaryInfo();
                $data['emplaye'] = $this->configarationmodel->employ();
                $this->load->view('temp/header');
                $this->load->view('employSalary', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function will return selected user's information.
        public function ajaxEmployInfo()
        {
            $userId = $this->input->get('uId');
            $query = $this->db->query("SELECT group_id FROM users_groups WHERE user_id=$userId");
            foreach ($query->result_array() as $row) {
                $groupId = $row['group_id'];
                if ($groupId == 1) {
                    $query2 = $this->db->query("SELECT username FROM users WHERE id=$userId");
                    foreach ($query2->result_array() as $row2) {
                        $userName = $row2['username'];
                        echo '<div class="form-group">
                                <label class="col-md-4 control-label">Employee Title <span class="requiredStar"> * </span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" placeholder="' . $row2['username'] . ' " value="' . $row2['username'] . '" name="employe_title" readonly="">
                                    
                                </div>
                            </div>';
                    }
                } elseif ($groupId == 4) {
                    $query2 = $this->db->query("SELECT username FROM users WHERE id=$userId");
                    foreach ($query2->result_array() as $row2) {
                        echo '<div class="form-group">
                                <label class="col-md-4 control-label">Employee Title <span class="requiredStar"> * </span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" placeholder="' . $row2['username'] . ' " value="' . $row2['username'] . '" name="employe_title" data-validation="required" data-validation-error-msg="Please give the amount" readonly="">
                                </div>
                            </div>';
                    }
                } else {
                    $query2 = $this->db->query("SELECT username FROM users WHERE id=$userId");
                    foreach ($query2->result_array() as $row2) {
                        echo '<div class="form-group">
                                <label class="col-md-4 control-label">Employee Title <span class="requiredStar"> * </span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" placeholder="' . $row2['username'] . ' " value="' . $row2['username'] . '" name="employe_title" data-validation="required" data-validation-error-msg="Please give the amount" readonly="">
                                    
                                </div>
                            </div>';
                    }
                }
            }
        }

        //This function will return salary persentise amount
        public function ajaxSalaryAmount()
        {
            $salaryAmount = $this->input->get('sm');
            $salaryPers = $this->input->get('spm');
            $value = ($salaryAmount * $salaryPers) / 100;
            echo '<div class="form-group">
                                <label class="col-md-4 control-label">' . lang('conc_3') . ' <span class="requiredStar">  </span></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder="' . $value . '" value="' . $value . '" name="persent_salary" data-validation="" data-validation-error-msg="' . lang('') . 'Please give the amount" readonly="">
                                </div>
                            </div>';
        }

        //This function can config to update & set new selery for emplaoy
        public function editEmploySalary()
        {
            $uid = $this->input->get('rId');
            if ($this->input->post('submit', TRUE)) {
                $treatment = $this->input->post('treatment', TRUE);
                $increased = $this->input->post('increased', TRUE);
                $basic = $this->input->post('basic_pay', TRUE);
                $others = $this->input->post('others', TRUE);
                $setData = array(
                    'year' => $this->db->escape_like_str(date('Y')),
                    'employ_user_id' => $this->db->escape_like_str($this->input->post('emplyId', TRUE)),
                    'employe_title' => $this->db->escape_like_str($this->input->post('employe_title', TRUE)),
                    'job_post' => $this->db->escape_like_str($this->input->post('job_post', TRUE)),
                    'treatment' => $this->db->escape_like_str($treatment),
                    'increased' => $this->db->escape_like_str($increased),
                    'basic' => $this->db->escape_like_str($basic),
                    'others' => $this->db->escape_like_str($others),
                    'total' => $this->db->escape_like_str($treatment + $increased + $basic + $others),
                );
                $uuId = $this->input->post('emplyId', TRUE);
                $this->db->where('employ_user_id', $uuId);
                if ($this->db->update('set_salary', $setData)) {
                    redirect('configuration/employSalary', 'refresh');
                }
            } else {
                $data['emplaye'] = $this->configarationmodel->employ();
                $data['sInfo'] = $this->configarationmodel->saleryConFigInfo($uid);
                $this->load->view('temp/header');
                $this->load->view('editEmploySalary', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function can dellet employ from set salery table
        public function setEmployDelete()
        {
            $rid = $this->input->get('rId');
            $uid = $this->input->get('uId');
            if ($this->db->delete('set_salary', array('id' => $rid))) {
                $setData2 = array(
                    'salary' => $this->db->escape_like_str(0)
                );
                $this->db->where('id', $uid);
                $this->db->update('users', $setData2);
                redirect('configuration/employSalary', 'refresh');
            }
        }

        //User role set up
        public function userAccessSettings()
        {
            $this->load->view('temp/header');
            $this->load->view('userRoleSetup');
            $this->load->view('temp/footer');
        }

        //This function will return all receiver whene give/select any user group.
        public function ajaxSelectUser()
        {
            $group = $this->input->get('q');
            if ($group == 3) {
                //If the student's groun was selected thene work here
                $query = $this->db->query("SELECT user_id,student_nam FROM student_info");
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
                echo '<option value="">' . lang('select') . '</option>';
                foreach ($data as $row1) {
                    echo '<option value="' . $row1['user_id'] . '">' . $row1['student_nam'] . ' </option>';
                }
            } elseif ($group == 4) {
                //If the teacher's groun was selected thene work here
                $query = $this->db->query("SELECT user_id,fullname FROM teachers_info");
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
                echo '<option value="">' . lang('select') . '</option>';
                foreach ($data as $row1) {
                    echo '<option value="' . $row1['user_id'] . '">' . $row1['fullname'] . ' </option>';
                }
            } elseif ($group == 5) {
                //If the parent's groun was selected thene work here
                $query = $this->db->query("SELECT user_id,parents_name FROM parents_info");
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
                echo '<option value="">' . lang('select') . '</option>';
                foreach ($data as $row1) {
                    echo '<option value="' . $row1['user_id'] . '">' . $row1['parents_name'] . ' </option>';
                }
            } elseif ($group == 6) {
                //If the parent's groun was selected thene work here
                $query = $this->db->query("SELECT user_id,full_name FROM userinfo WHERE group_id=6");
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
                echo '<option value="">' . lang('select') . '</option>';
                foreach ($data as $row5) {
                    echo '<option value="' . $row5['user_id'] . '">' . $row5['full_name'] . '</option>';
                }
            } elseif ($group == 7) {
                //If the parent's groun was selected thene work here
                $query = $this->db->query("SELECT user_id,full_name FROM userinfo WHERE group_id=7");
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
                echo '<option value="">' . lang('select') . '</option>';
                foreach ($data as $row6) {
                    echo '<option value="' . $row6['user_id'] . '">' . $row6['full_name'] . '</option>';
                }
            } elseif ($group == 8) {
                //If the parent's groun was selected thene work here
                $query = $this->db->query("SELECT user_id,full_name FROM userinfo WHERE group_id=8");
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
                echo '<option value="">' . lang('select') . '</option>';
                foreach ($data as $row1) {
                    echo '<option value="' . $row1['user_id'] . '">' . $row1['full_name'] . '</option>';
                }
            } elseif ($group == 9) {
                //If the parent's groun was selected thene work here
                $query = $this->db->query("SELECT user_id,full_name FROM userinfo WHERE group_id=9");
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
                echo '<option value="">' . lang('select') . '</option>';
                foreach ($data as $row1) {
                    echo '<option value="' . $row1['user_id'] . '">' . $row1['full_name'] . '</option>';
                }
            }
        }

        //This function will show and set individual user's role
        public function individualUser()
        {
            if ($this->input->post('submit', TRUE)) {
                $userId = $this->input->post('userId', TRUE);
                $roleArray = array(
                    'das_top_info' => $this->db->escape_like_str($this->input->post('das_top_info', TRUE)),
                    'das_grab_chart' => $this->db->escape_like_str($this->input->post('das_grab_chart', TRUE)),
                    'das_class_info' => $this->db->escape_like_str($this->input->post('das_class_info', TRUE)),
                    'das_message' => $this->db->escape_like_str($this->input->post('das_message', TRUE)),
                    'das_employ_attend' => $this->db->escape_like_str($this->input->post('das_employ_attend', TRUE)),
                    'das_notice' => $this->db->escape_like_str($this->input->post('das_notice', TRUE)),
                    'das_calender' => $this->db->escape_like_str($this->input->post('das_calender', TRUE)),
                    'admission' => $this->db->escape_like_str($this->input->post('admission', TRUE)),
                    'all_student_info' => $this->db->escape_like_str($this->input->post('all_student_info', TRUE)),
                    'stud_edit_delete' => $this->db->escape_like_str($this->input->post('stud_edit_delete', TRUE)),
                    'stu_own_info' => $this->db->escape_like_str($this->input->post('stu_own_info', TRUE)),
                    'teacher_info' => $this->db->escape_like_str($this->input->post('teacher_info', TRUE)),
                    'add_teacher' => $this->db->escape_like_str($this->input->post('add_teacher', TRUE)),
                    'teacher_details' => $this->db->escape_like_str($this->input->post('teacher_details', TRUE)),
                    'teacher_edit_delete' => $this->db->escape_like_str($this->input->post('teacher_edit_delete', TRUE)),
                    'all_parents_info' => $this->db->escape_like_str($this->input->post('all_parents_info', TRUE)),
                    'own_parents_info' => $this->db->escape_like_str($this->input->post('own_parents_info', TRUE)),
                    'make_parents_id' => $this->db->escape_like_str($this->input->post('make_parents_id', TRUE)),
                    'parents_edit_dlete' => $this->db->escape_like_str($this->input->post('parents_edit_dlete', TRUE)),
                    'add_new_class' => $this->db->escape_like_str($this->input->post('add_new_class', TRUE)),
                    'all_class_info' => $this->db->escape_like_str($this->input->post('all_class_info', TRUE)),
                    'class_details' => $this->db->escape_like_str($this->input->post('class_details', TRUE)),
                    'class_delete' => $this->db->escape_like_str($this->input->post('class_delete', TRUE)),
                    'class_promotion' => $this->db->escape_like_str($this->input->post('class_promotion', TRUE)),
                    'assin_optio_sub' => $this->db->escape_like_str($this->input->post('assin_optio_sub', TRUE)),
                    'add_class_routine' => $this->db->escape_like_str($this->input->post('add_class_routine', TRUE)),
                    'own_class_routine' => $this->db->escape_like_str($this->input->post('own_class_routine', TRUE)),
                    'all_class_routine' => $this->db->escape_like_str($this->input->post('all_class_routine', TRUE)),
                    'attendance_preview' => $this->db->escape_like_str($this->input->post('attendance_preview', TRUE)),
                    'take_studence_atten' => $this->db->escape_like_str($this->input->post('take_studence_atten', TRUE)),
                    'edit_student_atten' => $this->db->escape_like_str($this->input->post('edit_student_atten', TRUE)),
                    'add_employee' => $this->db->escape_like_str($this->input->post('add_employee', TRUE)),
                    'employee_list' => $this->db->escape_like_str($this->input->post('employee_list', TRUE)),
                    'employ_attendance' => $this->db->escape_like_str($this->input->post('employ_attendance', TRUE)),
                    'empl_atte_view' => $this->db->escape_like_str($this->input->post('empl_atte_view', TRUE)),
                    'add_subject' => $this->db->escape_like_str($this->input->post('add_subject', TRUE)),
                    'all_subject' => $this->db->escape_like_str($this->input->post('all_subject', TRUE)),
                    'make_suggestion' => $this->db->escape_like_str($this->input->post('make_suggestion', TRUE)),
                    'all_suggestion' => $this->db->escape_like_str($this->input->post('all_suggestion', TRUE)),
                    'own_suggestion' => $this->db->escape_like_str($this->input->post('own_suggestion', TRUE)),
                    'add_exam_gread' => $this->db->escape_like_str($this->input->post('add_exam_gread', TRUE)),
                    'exam_gread' => $this->db->escape_like_str($this->input->post('exam_gread', TRUE)),
                    'add_exam_routin' => $this->db->escape_like_str($this->input->post('add_exam_routin', TRUE)),
                    'all_exam_routine' => $this->db->escape_like_str($this->input->post('all_exam_routine', TRUE)),
                    'own_exam_routine' => $this->db->escape_like_str($this->input->post('own_exam_routine', TRUE)),
                    'exam_attend_preview' => $this->db->escape_like_str($this->input->post('exam_attend_preview', TRUE)),
                    'approve_result' => $this->db->escape_like_str($this->input->post('approve_result', TRUE)),
                    'view_result' => $this->db->escape_like_str($this->input->post('view_result', TRUE)),
                    'all_mark_sheet' => $this->db->escape_like_str($this->input->post('all_mark_sheet', TRUE)),
                    'own_mark_sheet' => $this->db->escape_like_str($this->input->post('own_mark_sheet', TRUE)),
                    'take_exam_attend' => $this->db->escape_like_str($this->input->post('take_exam_attend', TRUE)),
                    'change_exam_attendance' => $this->db->escape_like_str($this->input->post('change_exam_attendance', TRUE)),
                    'make_result' => $this->db->escape_like_str($this->input->post('make_result', TRUE)),
                    'add_category' => $this->db->escape_like_str($this->input->post('add_category', TRUE)),
                    'all_category' => $this->db->escape_like_str($this->input->post('all_category', TRUE)),
                    'edit_delete_category' => $this->db->escape_like_str($this->input->post('edit_delete_category', TRUE)),
                    'add_books' => $this->db->escape_like_str($this->input->post('add_books', TRUE)),
                    'all_books' => $this->db->escape_like_str($this->input->post('all_books', TRUE)),
                    'edit_delete_books' => $this->db->escape_like_str($this->input->post('edit_delete_books', TRUE)),
                    'add_library_mem' => $this->db->escape_like_str($this->input->post('add_library_mem', TRUE)),
                    'memb_list' => $this->db->escape_like_str($this->input->post('memb_list', TRUE)),
                    'issu_return' => $this->db->escape_like_str($this->input->post('issu_return', TRUE)),
                    'add_dormitories' => $this->db->escape_like_str($this->input->post('add_dormitories', TRUE)),
                    'add_set_dormi' => $this->db->escape_like_str($this->input->post('add_set_dormi', TRUE)),
                    'set_member_bed' => $this->db->escape_like_str($this->input->post('set_member_bed', TRUE)),
                    'dormi_report' => $this->db->escape_like_str($this->input->post('dormi_report', TRUE)),
                    'add_transport' => $this->db->escape_like_str($this->input->post('add_transport', TRUE)),
                    'all_transport' => $this->db->escape_like_str($this->input->post('all_transport', TRUE)),
                    'transport_edit_dele' => $this->db->escape_like_str($this->input->post('transport_edit_dele', TRUE)),
                    'add_account_title' => $this->db->escape_like_str($this->input->post('add_account_title', TRUE)),
                    'edit_dele_acco' => $this->db->escape_like_str($this->input->post('edit_dele_acco', TRUE)),
                    'trensection' => $this->db->escape_like_str($this->input->post('trensection', TRUE)),
                    'fee_collection' => $this->db->escape_like_str($this->input->post('fee_collection', TRUE)),
                    'all_slips' => $this->db->escape_like_str($this->input->post('all_slips', TRUE)),
                    'own_slip' => $this->db->escape_like_str($this->input->post('own_slip', TRUE)),
                    'slip_edit_delete' => $this->db->escape_like_str($this->input->post('slip_edit_delete', TRUE)),
                    'pay_salary' => $this->db->escape_like_str($this->input->post('pay_salary', TRUE)),
                    'creat_notice' => $this->db->escape_like_str($this->input->post('creat_notice', TRUE)),
                    'send_message' => $this->db->escape_like_str($this->input->post('send_message', TRUE)),
                    'vendor' => $this->db->escape_like_str($this->input->post('vendor', TRUE)),
                    'delet_vendor' => $this->db->escape_like_str($this->input->post('delet_vendor', TRUE)),
                    'add_inv_cat' => $this->db->escape_like_str($this->input->post('add_inv_cat', TRUE)),
                    'inve_item' => $this->db->escape_like_str($this->input->post('inve_item', TRUE)),
                    'delete_inve_ite' => $this->db->escape_like_str($this->input->post('delete_inve_ite', TRUE)),
                    'delete_inv_cat' => $this->db->escape_like_str($this->input->post('delete_inv_cat', TRUE)),
                    'inve_issu' => $this->db->escape_like_str($this->input->post('inve_issu', TRUE)),
                    'delete_inven_issu' => $this->db->escape_like_str($this->input->post('delete_inven_issu', TRUE)),
                    'check_leav_appli' => $this->db->escape_like_str($this->input->post('check_leav_appli', TRUE)),
                    'setting_manage_user' => $this->db->escape_like_str($this->input->post('setting_manage_user', TRUE)),
                    'setting_accounts' => $this->db->escape_like_str($this->input->post('setting_accounts', TRUE)),
                    'other_setting' => $this->db->escape_like_str($this->input->post('other_setting', TRUE)),
                    'front_setings' => $this->db->escape_like_str($this->input->post('front_setings', TRUE)),
                );
                $this->db->where('user_id', $userId);
                if ($this->db->update('role_based_access', $roleArray)) {
                    $data['group'] = $this->configarationmodel->allGroup();
                    $data['message'] = '<div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                        <strong>' . lang('success') . '</strong>' . lang('conc_4') . '
                                </div>';
                    $this->load->view('temp/header');
                    $this->load->view('individualRoles', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $data['group'] = $this->configarationmodel->allGroup();
                $this->load->view('temp/header');
                $this->load->view('individualRoles', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function will show all roles
        public function ajaxGetIndRole()
        {
            $data = array();
            $userId = $this->input->get('uId');
            $query = $this->db->query("SELECT * FROM role_based_access WHERE user_id=$userId");
            foreach ($query->result_array() as $row) {
                $data = $row;
            }
            echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_5') . '</div><div class="form-group"><div class="checkbox-list">';
            foreach ($data as $key => $val) {
                // Role No 1
                if ($key == 'das_top_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="das_top_info" value="1"> ' . lang('rol_1') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="das_top_info" value="1" checked> ' . lang('rol_1') . '  </label>';
                    }
                }
                // Role No 2
                if ($key == 'das_grab_chart') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1">' . lang('rol_2') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1" checked>' . lang('rol_2') . ' </label>';
                    }
                }
                // Role No 3
                if ($key == 'das_class_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="das_class_info" value="1">' . lang('rol_3') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="das_class_info" value="1" checked> ' . lang('rol_3') . '</label>';
                    }
                }
                // Role No 4
                if ($key == 'das_message') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="das_message" value="1"> ' . lang('rol_4') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="das_message" value="1" checked> ' . lang('rol_4') . '</label>';
                    }
                }
                // Role No 5
                if ($key == 'das_employ_attend') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1"> ' . lang('rol_5') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1" checked> ' . lang('rol_5') . '</label>';
                    }
                }
                // Role No 6
                if ($key == 'das_notice') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="das_notice" value="1"> ' . lang('rol_6') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="das_notice" value="1" checked> ' . lang('rol_6') . '</label>';
                    }
                }
                // Role No 7
                if ($key == 'das_calender') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="das_calender" value="1"> ' . lang('rol_7') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="das_calender" value="1" checked> ' . lang('rol_7') . '</label>';
                    }
                }
                // Role No 8
                if ($key == 'admission') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="admission" value="1" checked> ' . lang('rol_8') . '</label>';
                    }
                }
                // Role No 9
                if ($key == 'all_student_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_student_info" value="1"> ' . lang('rol_9') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_student_info" value="1" checked> ' . lang('rol_9') . '</label>';
                    }
                }
                // Role No 10
                if ($key == 'stud_edit_delete') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1" checked> ' . lang('rol_10') . '</label>';
                    }
                }
                // Role No 11
                if ($key == 'stu_own_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="stu_own_info" value="1"> ' . lang('rol_11') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="stu_own_info" value="1" checked> ' . lang('rol_11') . ' </label>';
                    }
                }
                // Role No 12
                if ($key == 'teacher_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="teacher_info" value="1"> ' . lang('rol_12') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="teacher_info" value="1" checked>' . lang('rol_12') . ' </label>';
                    }
                }
                // Role No 13
                if ($key == 'add_teacher') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_teacher" value="1">' . lang('rol_13') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_teacher" value="1" checked>' . lang('rol_13') . '</label>';
                    }
                }
                // Role No 14
                if ($key == 'teacher_details') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="teacher_details" value="1"> ' . lang('rol_14') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="teacher_details" value="1" checked> ' . lang('rol_14') . '</label>';
                    }
                }
                // Role No 15
                if ($key == 'teacher_edit_delete') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1">' . lang('rol_15') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1" checked> ' . lang('rol_15') . '</label>';
                    }
                }
                // Role No 16
                if ($key == 'all_parents_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_parents_info" value="1"> ' . lang('rol_16') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_parents_info" value="1" checked> ' . lang('rol_16') . '</label>';
                    }
                }
                // Role No 17
                if ($key == 'own_parents_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="own_parents_info" value="1"> ' . lang('rol_17') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="own_parents_info" value="1" checked> ' . lang('rol_17') . '</label>';
                    }
                }
                // Role No 18
                if ($key == 'make_parents_id') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="make_parents_id" value="1">' . lang('rol_18') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="make_parents_id" value="1" checked>' . lang('rol_18') . ' </label>';
                    }
                }
                // Role No 19
                if ($key == 'parents_edit_dlete') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1">' . lang('rol_19') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1" checked> ' . lang('rol_19') . '</label>';
                    }
                }
                // Role No 20
                if ($key == 'add_new_class') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_new_class" value="1">' . lang('rol_20') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_new_class" value="1" checked>' . lang('rol_20') . ' </label>';
                    }
                }
                // Role No 21
                if ($key == 'all_class_info') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_class_info" value="1"> ' . lang('rol_21') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_class_info" value="1" checked> ' . lang('rol_21') . '</label>';
                    }
                }
                // Role No 22
                if ($key == 'class_details') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="class_details" value="1"> ' . lang('rol_22') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="class_details" value="1" checked> ' . lang('rol_22') . '</label>';
                    }
                }
                // Role No 23
                if ($key == 'class_delete') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="class_delete" value="1"> ' . lang('rol_23') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="class_delete" value="1" checked> ' . lang('rol_23') . '</label>';
                    }
                }
                // Role No 24
                if ($key == 'class_promotion') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="class_promotion" value="1" checked>' . lang('rol_24') . ' </label>';
                    }
                }
                // Role No 25
                if ($key == 'assin_optio_sub') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1" checked> ' . lang('rol_25') . '</label>';
                    }
                }
                // Role No 26
                if ($key == 'add_class_routine') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_class_routine" value="1"> ' . lang('rol_26') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_class_routine" value="1" checked> ' . lang('rol_26') . '</label>';
                    }
                }
                // Role No 27
                if ($key == 'own_class_routine') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="own_class_routine" value="1"> ' . lang('rol_27') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="own_class_routine" value="1" checked> ' . lang('rol_27') . '</label>';
                    }
                }
                // Role No 28
                if ($key == 'all_class_routine') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_class_routine" value="1"> ' . lang('rol_28') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_class_routine" value="1" checked> ' . lang('rol_28') . '</label>';
                    }
                }
                // Role No 29
                if ($key == 'rutin_edit_delete') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('') . 'By this access user can edit or delete class routine.</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1" checked> ' . lang('') . 'By this access user can edit or delete class routine.</label>';
                    }
                }
                // Role No 30
                if ($key == 'attendance_preview') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="attendance_preview" value="1"> ' . lang('rol_30') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="attendance_preview" value="1" checked> ' . lang('rol_30') . '</label>';
                    }
                }
                // Role No 31
                if ($key == 'take_studence_atten') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1"> ' . lang('rol_31') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1" checked> ' . lang('rol_31') . '</label>';
                    }
                }
                // Role No 32
                if ($key == 'edit_student_atten') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1"> ' . lang('rol_32') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1" checked> ' . lang('rol_32') . '</label>';
                    }
                }
                // Role No 33
                if ($key == 'add_subject') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_subject" value="1"> ' . lang('rol_37') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_subject" value="1" checked> ' . lang('rol_37') . '</label>';
                    }
                }
                // Role No 34
                if ($key == 'all_subject') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_subject" value="1"> ' . lang('rol_38') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_subject" value="1" checked> ' . lang('rol_38') . '</label>';
                    }
                }
                // Role No 35
                if ($key == 'make_suggestion') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="make_suggestion" value="1"> ' . lang('rol_39') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="make_suggestion" value="1" checked> ' . lang('rol_39') . '</label>';
                    }
                }
                // Role No 36
                if ($key == 'all_suggestion') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_suggestion" value="1"> ' . lang('rol_40') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_suggestion" value="1" checked> ' . lang('rol_40') . '</label>';
                    }
                }
                // Role No 37
                if ($key == 'own_suggestion') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="own_suggestion" value="1"> ' . lang('rol_41') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="own_suggestion" value="1" checked> ' . lang('rol_41') . '</label>';
                    }
                }
                // Role No 38
                if ($key == 'add_exam_gread') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1"> ' . lang('rol_42') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1" checked> ' . lang('rol_42') . '</label>';
                    }
                }
                // Role No 39
                if ($key == 'exam_gread') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="exam_gread" value="1"> ' . lang('') . 'By this access user can check, edit and delete grade.</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="exam_gread" value="1" checked> ' . lang('') . 'By this access user can check, edit and delete grade.</label>';
                    }
                }
                // Role No 41
                if ($key == 'add_exam_routin') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1" checked> ' . lang('rol_44') . '</label>';
                    }
                }
                // Role No 42
                if ($key == 'all_exam_routine') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1">' . lang('rol_45') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1" checked>' . lang('rol_45') . '</label>';
                    }
                }
                // Role No 43
                if ($key == 'own_exam_routine') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1"> ' . lang('rol_46') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1" checked>' . lang('rol_46') . ' </label>';
                    }
                }
                // Role No 44
                if ($key == 'exam_attend_preview') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1">' . lang('rol_47') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1" checked>' . lang('rol_47') . ' </label>';
                    }
                }
                // Role No 45
                if ($key == 'approve_result') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="approve_result" value="1">' . lang('rol_48') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="approve_result" value="1" checked>' . lang('rol_48') . ' </label>';
                    }
                }
                // Role No 46
                if ($key == 'view_result') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="view_result" value="1">' . lang('rol_49') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="view_result" value="1" checked>' . lang('rol_49') . ' </label>';
                    }
                }
                // Role No 47
                if ($key == 'all_mark_sheet') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1">' . lang('rol_50') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1" checked>' . lang('rol_50') . ' </label>';
                    }
                }
                // Role No 48
                if ($key == 'own_mark_sheet') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1">' . lang('rol_51') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1" checked>' . lang('rol_51') . ' </label>';
                    }
                }
                // Role No 49
                if ($key == 'take_exam_attend') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1">' . lang('rol_52') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1" checked>' . lang('rol_52') . ' </label>';
                    }
                }
                // Role No 50
                if ($key == 'change_exam_attendance') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1">' . lang('rol_53') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1" checked>' . lang('rol_53') . ' </label>';
                    }
                }
                // Role No 51
                if ($key == 'make_result') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="make_result" value="1">' . lang('rol_54') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="make_result" value="1" checked>' . lang('rol_54') . ' </label>';
                    }
                }
                // Role No 52
                if ($key == 'add_category') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_category" value="1">' . lang('rol_55') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_category" value="1" checked>' . lang('rol_55') . ' </label>';
                    }
                }
                // Role No 53
                if ($key == 'all_category') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_category" value="1">' . lang('rol_56') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_category" value="1" checked>' . lang('rol_56') . ' </label>';
                    }
                }
                // Role No 54
                if ($key == 'edit_delete_category') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1">' . lang('rol_57') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1" checked> ' . lang('rol_57') . '</label>';
                    }
                }
                // Role No 55
                if ($key == 'add_books') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_books" value="1">' . lang('rol_58') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_books" value="1" checked>' . lang('rol_58') . ' </label>';
                    }
                }
                // Role No 56
                if ($key == 'all_books') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_books" value="1">' . lang('rol_59') . ' </label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_books" value="1" checked> ' . lang('rol_59') . '</label>';
                    }
                }
                // Role No 57
                if ($key == 'edit_delete_books') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1"> ' . lang('rol_60') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1" checked> ' . lang('rol_60') . '</label>';
                    }
                }
                // Role No 58
                if ($key == 'add_library_mem') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_library_mem" value="1"> ' . lang('rol_61') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_library_mem" value="1" checked> ' . lang('rol_61') . '</label>';
                    }
                }
                // Role No 59
                if ($key == 'memb_list') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="memb_list" value="1"> ' . lang('rol_62') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="memb_list" value="1" checked> ' . lang('rol_62') . '</label>';
                    }
                }
                // Role No 60
                if ($key == 'issu_return') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="issu_return" value="1"> ' . lang('rol_63') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="issu_return" value="1" checked>' . lang('rol_63') . '</label>';
                    }
                }
                // Role No 61
                if ($key == 'add_dormitories') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_dormitories" value="1" checked> ' . lang('rol_64') . '</label>';
                    }
                }
                // Role No 62
                if ($key == 'add_set_dormi') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1" checked> ' . lang('rol_65') . '</label>';
                    }
                }
                // Role No 63
                if ($key == 'set_member_bed') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="set_member_bed" value="1" checked> ' . lang('rol_66') . '</label>';
                    }
                }
                // Role No 64
                if ($key == 'dormi_report') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="dormi_report" value="1"> ' . lang('rol_67') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="dormi_report" value="1" checked> ' . lang('rol_67') . '</label>';
                    }
                }
                // Role No 65
                if ($key == 'add_transport') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_transport" value="1"> ' . lang('rol_68') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_transport" value="1" checked> ' . lang('rol_68') . '</label>';
                    }
                }
                // Role No 66
                if ($key == 'all_transport') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_transport" value="1"> ' . lang('rol_69') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_transport" value="1" checked> ' . lang('rol_69') . '</label>';
                    }
                }
                // Role No 67
                if ($key == 'transport_edit_dele') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1" checked> ' . lang('rol_70') . '</label>';
                    }
                }
                // Role No 68
                if ($key == 'add_account_title') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_account_title" value="1"> ' . lang('rol_71') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_account_title" value="1" checked> ' . lang('rol_71') . '</label>';
                    }
                }
                // Role No 68
                if ($key == 'edit_dele_acco') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1"> ' . lang('rol_93') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1" checked> ' . lang('rol_93') . '</label>';
                    }
                }
                // Role No 69
                if ($key == 'trensection') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="trensection" value="1"> ' . lang('rol_72') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="trensection" value="1" checked> ' . lang('rol_72') . '</label>';
                    }
                }
                // Role No 70
                if ($key == 'fee_collection') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="fee_collection" value="1"> ' . lang('rol_73') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="fee_collection" value="1" checked> ' . lang('rol_73') . '</label>';
                    }
                }
                // Role No 71
                // Role No72
                if ($key == 'all_slips') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="all_slips" value="1"> ' . lang('rol_74') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="all_slips" value="1" checked> ' . lang('rol_74') . '</label>';
                    }
                }
                // Role No 73
                if ($key == 'own_slip') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="own_slip" value="1"> ' . lang('rol_75') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="own_slip" value="1" checked> ' . lang('rol_75') . '</label>';
                    }
                }
                // Role No 74
                if ($key == 'slip_edit_delete') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1" checked> ' . lang('rol_76') . '</label>';
                    }
                }
                // Role No 79
                if ($key == 'pay_salary') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="pay_salary" value="1"> ' . lang('rol_77') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="pay_salary" value="1" checked> ' . lang('rol_77') . '</label>';
                    }
                }
                // Role No 80
                // Role No 81
                if ($key == 'creat_notice') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="creat_notice" value="1" checked> ' . lang('rol_78') . '</label>';
                    }
                }
                // Role No 82
                if ($key == 'send_message') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="send_message" value="1"> ' . lang('rol_79') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="send_message" value="1" checked> ' . lang('rol_79') . '</label>';
                    }
                }
                // Role No 83
                if ($key == 'vendor') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="vendor" value="1" checked> ' . lang('rol_80') . '</label>';
                    }
                } // Role No 84
                if ($key == 'delet_vendor') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="delet_vendor" value="1" checked> ' . lang('rol_81') . '</label>';
                    }
                } // Role No 85
                if ($key == 'add_inv_cat') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1"> ' . lang('rol_79') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1" checked> ' . lang('rol_79') . '</label>';
                    }
                } // Role No 86
                if ($key == 'delete_inv_cat') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1" checked> ' . lang('rol_83') . '</label>';
                    }
                } // Role No 87
                if ($key == 'inve_item') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="inve_item" value="1" checked> ' . lang('rol_84') . '</label>';
                    }
                } // Role No 88
                if ($key == 'delete_inve_ite') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1" checked> ' . lang('rol_85') . '</label>';
                    }
                } // Role No 89
                if ($key == 'inve_issu') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="inve_issu" value="1" checked> ' . lang('rol_86') . '</label>';
                    }
                } // Role No 90
                if ($key == 'delete_inven_issu') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1" checked> ' . lang('rol_87') . '</label>';
                    }
                }
                // Role No 91
                if ($key == 'check_leav_appli') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1" checked> ' . lang('rol_88') . '</label>';
                    }
                }
                // Role No 92
                if ($key == 'setting_manage_user') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1">  ' . lang('rol_89') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1" checked>  ' . lang('rol_89') . '</label>';
                    }
                }
                // Role No 93
                if ($key == 'setting_accounts') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="setting_accounts" value="1">  ' . lang('rol_90') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="setting_accounts" value="1" checked>  ' . lang('rol_90') . '</label>';
                    }
                }
                // Role No 94
                if ($key == 'other_setting') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('') . 'By this access user can set all general settings option for this software.</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="other_setting" value="1" checked> ' . lang('') . 'By this access user can set all general settings option for this software.</label>';
                    }
                }
                // Role No 95
                if ($key == 'front_setings') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="front_setings" value="1">' . lang('rol_92') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="front_setings" value="1" checked>' . lang('rol_92') . '</label>';
                    }
                }
                // Role No 96
                if ($key == 'add_employee') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="add_employee" value="1">' . lang('rol_33') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="add_employee" value="1" checked>' . lang('rol_33') . '</label>';
                    }
                }
                // Role No 97
                if ($key == 'employee_list') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="employee_list" value="1">' . lang('rol_34') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="employee_list" value="1" checked>' . lang('rol_34') . '</label>';
                    }
                }
                // Role No 98
                if ($key == 'employ_attendance') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('') . 'By this access user can take employee attendance by security password.</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="employ_attendance" value="1" checked> ' . lang('') . 'By this access user can take employee attendance by security password.</label>';
                    }
                }
                // Role No 99
                if ($key == 'empl_atte_view') {
                    if ($val == 0) {
                        echo '<label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1">' . lang('rol_36') . '</label>';
                    } else {
                        echo '<label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1" checked>' . lang('rol_36') . '</label>';
                    }
                }
            }
            echo '</div></div></div><div class="clearfix"></div>';
        }

        //This function will set user role by user groupe
        public function groupRole()
        {
            if ($this->input->post('submit', TRUE)) {



                $userGroupId = $this->input->post('group');
                $roleArray = array(
                    'das_top_info' => $this->db->escape_like_str($this->input->post('das_top_info', TRUE) ? 1 : 0),
                    'das_grab_chart' => $this->db->escape_like_str($this->input->post('das_grab_chart', TRUE) ? 1 : 0),
                    'das_class_info' => $this->db->escape_like_str($this->input->post('das_class_info', TRUE) ? 1 : 0),
                    'das_message' => $this->db->escape_like_str($this->input->post('das_message', TRUE) ? 1 : 0),
                    'das_employ_attend' => $this->db->escape_like_str($this->input->post('das_employ_attend', TRUE) ? 1 : 0),
                    'das_notice' => $this->db->escape_like_str($this->input->post('das_notice', TRUE) ? 1 : 0),
                    'das_calender' => $this->db->escape_like_str($this->input->post('das_calender', TRUE) ? 1 : 0),
                    'admission' => $this->db->escape_like_str($this->input->post('admission', TRUE) ? 1 : 0),
                    'all_student_info' => $this->db->escape_like_str($this->input->post('all_student_info', TRUE) ? 1 : 0),
                    'stud_edit_delete' => $this->db->escape_like_str($this->input->post('stud_edit_delete', TRUE) ? 1 : 0),
                    'stu_own_info' => $this->db->escape_like_str($this->input->post('stu_own_info', TRUE) ? 1 : 0),
                    'teacher_info' => $this->db->escape_like_str($this->input->post('teacher_info', TRUE) ? 1 : 0),
                    'add_teacher' => $this->db->escape_like_str($this->input->post('add_teacher', TRUE) ? 1 : 0),
                    'teacher_details' => $this->db->escape_like_str($this->input->post('teacher_details', TRUE) ? 1 : 0),
                    'teacher_edit_delete' => $this->db->escape_like_str($this->input->post('teacher_edit_delete', TRUE) ? 1 : 0),
                    'all_parents_info' => $this->db->escape_like_str($this->input->post('all_parents_info', TRUE) ? 1 : 0),
                    'own_parents_info' => $this->db->escape_like_str($this->input->post('own_parents_info', TRUE) ? 1 : 0),
                    'make_parents_id' => $this->db->escape_like_str($this->input->post('make_parents_id', TRUE) ? 1 : 0),
                    'parents_edit_dlete' => $this->db->escape_like_str($this->input->post('parents_edit_dlete', TRUE) ? 1 : 0),
                    'add_new_class' => $this->db->escape_like_str($this->input->post('add_new_class', TRUE) ? 1 : 0),
                    'all_class_info' => $this->db->escape_like_str($this->input->post('all_class_info', TRUE) ? 1 : 0),
                    'class_details' => $this->db->escape_like_str($this->input->post('class_details', TRUE) ? 1 : 0),
                    'class_delete' => $this->db->escape_like_str($this->input->post('class_delete', TRUE) ? 1 : 0),
                    'add_class_routine' => $this->db->escape_like_str($this->input->post('add_class_routine', TRUE) ? 1 : 0),
                    'own_class_routine' => $this->db->escape_like_str($this->input->post('own_class_routine', TRUE) ? 1 : 0),
                    'all_class_routine' => $this->db->escape_like_str($this->input->post('all_class_routine', TRUE) ? 1 : 0),
                    'rutin_edit_delete' => $this->db->escape_like_str($this->input->post('rutin_edit_delete', TRUE) ? 1 : 0),
                    'attendance_preview' => $this->db->escape_like_str($this->input->post('attendance_preview', TRUE) ? 1 : 0),
                    'take_studence_atten' => $this->db->escape_like_str($this->input->post('take_studence_atten', TRUE) ? 1 : 0),
                    'edit_student_atten' => $this->db->escape_like_str($this->input->post('edit_student_atten', TRUE) ? 1 : 0),
                    'add_employee' => $this->db->escape_like_str($this->input->post('add_employee', TRUE) ? 1 : 0),
                    'employee_list' => $this->db->escape_like_str($this->input->post('employee_list', TRUE)),
                    'employ_attendance' => $this->db->escape_like_str($this->input->post('employ_attendance', TRUE) ? 1 : 0),
                    'empl_atte_view' => $this->db->escape_like_str($this->input->post('empl_atte_view', TRUE) ? 1 : 0),
                    'add_subject' => $this->db->escape_like_str($this->input->post('add_subject', TRUE) ? 1 : 0),
                    'all_subject' => $this->db->escape_like_str($this->input->post('all_subject', TRUE) ? 1 : 0),
                    'make_suggestion' => $this->db->escape_like_str($this->input->post('make_suggestion', TRUE) ? 1 : 0),
                    'all_suggestion' => $this->db->escape_like_str($this->input->post('all_suggestion', TRUE) ? 1 : 0),
                    'own_suggestion' => $this->db->escape_like_str($this->input->post('own_suggestion', TRUE) ? 1 : 0),
                    'add_exam_gread' => $this->db->escape_like_str($this->input->post('add_exam_gread', TRUE) ? 1 : 0),
                    'employee_list' => $this->db->escape_like_str($this->input->post('employee_list', TRUE) ? 1 : 0),
                    'exam_gread' => $this->db->escape_like_str($this->input->post('exam_gread', TRUE) ? 1 : 0),
                    'add_exam_routin' => $this->db->escape_like_str($this->input->post('add_exam_routin', TRUE) ? 1 : 0),
                    'all_exam_routine' => $this->db->escape_like_str($this->input->post('all_exam_routine', TRUE) ? 1 : 0),
                    'own_exam_routine' => $this->db->escape_like_str($this->input->post('own_exam_routine', TRUE) ? 1 : 0),
                    'exam_attend_preview' => $this->db->escape_like_str($this->input->post('exam_attend_preview', TRUE) ? 1 : 0),
                    'approve_result' => $this->db->escape_like_str($this->input->post('approve_result', TRUE) ? 1 : 0),
                    'view_result' => $this->db->escape_like_str($this->input->post('view_result', TRUE) ? 1 : 0),
                    'all_mark_sheet' => $this->db->escape_like_str($this->input->post('all_mark_sheet', TRUE) ? 1 : 0),
                    'own_mark_sheet' => $this->db->escape_like_str($this->input->post('own_mark_sheet', TRUE) ? 1 : 0),
                    'take_exam_attend' => $this->db->escape_like_str($this->input->post('take_exam_attend', TRUE) ? 1 : 0),
                    'change_exam_attendance' => $this->db->escape_like_str($this->input->post('change_exam_attendance', TRUE) ? 1 : 0),
                    'make_result' => $this->db->escape_like_str($this->input->post('make_result', TRUE) ? 1 : 0),
                    'add_category' => $this->db->escape_like_str($this->input->post('add_category', TRUE) ? 1 : 0),
                    'all_category' => $this->db->escape_like_str($this->input->post('all_category', TRUE) ? 1 : 0),
                    'edit_delete_category' => $this->db->escape_like_str($this->input->post('edit_delete_category', TRUE) ? 1 : 0),
                    'add_books' => $this->db->escape_like_str($this->input->post('add_books', TRUE) ? 1 : 0),
                    'all_books' => $this->db->escape_like_str($this->input->post('all_books', TRUE) ? 1 : 0),
                    'edit_delete_books' => $this->db->escape_like_str($this->input->post('edit_delete_books', TRUE) ? 1 : 0),
                    'add_library_mem' => $this->db->escape_like_str($this->input->post('add_library_mem', TRUE) ? 1 : 0),
                    'memb_list' => $this->db->escape_like_str($this->input->post('memb_list', TRUE) ? 1 : 0),
                    'issu_return' => $this->db->escape_like_str($this->input->post('issu_return', TRUE) ? 1 : 0),
                    'add_dormitories' => $this->db->escape_like_str($this->input->post('add_dormitories', TRUE) ? 1 : 0),
                    'add_set_dormi' => $this->db->escape_like_str($this->input->post('add_set_dormi', TRUE) ? 1 : 0),
                    'set_member_bed' => $this->db->escape_like_str($this->input->post('set_member_bed', TRUE) ? 1 : 0),
                    'dormi_report' => $this->db->escape_like_str($this->input->post('dormi_report', TRUE) ? 1 : 0),
                    'add_transport' => $this->db->escape_like_str($this->input->post('add_transport', TRUE) ? 1 : 0),
                    'all_transport' => $this->db->escape_like_str($this->input->post('all_transport', TRUE) ? 1 : 0),
                    'transport_edit_dele' => $this->db->escape_like_str($this->input->post('transport_edit_dele', TRUE) ? 1 : 0),
                    'add_account_title' => $this->db->escape_like_str($this->input->post('add_account_title', TRUE) ? 1 : 0),
                    'edit_dele_acco' => $this->db->escape_like_str($this->input->post('edit_dele_acco', TRUE) ? 1 : 0),
                    'trensection' => $this->db->escape_like_str($this->input->post('trensection', TRUE) ? 1 : 0),
                    'fee_collection' => $this->db->escape_like_str($this->input->post('fee_collection', TRUE) ? 1 : 0),
                    'all_slips' => $this->db->escape_like_str($this->input->post('all_slips', TRUE) ? 1 : 0),
                    'own_slip' => $this->db->escape_like_str($this->input->post('own_slip', TRUE) ? 1 : 0),
                    'slip_edit_delete' => $this->db->escape_like_str($this->input->post('slip_edit_delete', TRUE) ? 1 : 0),
                    'pay_salary' => $this->db->escape_like_str($this->input->post('pay_salary', TRUE) ? 1 : 0),
                    'creat_notice' => $this->db->escape_like_str($this->input->post('creat_notice', TRUE) ? 1 : 0),
                    'send_message' => $this->db->escape_like_str($this->input->post('send_message', TRUE) ? 1 : 0),
                    'vendor' => $this->db->escape_like_str($this->input->post('vendor', TRUE) ? 1 : 0),
                    'delet_vendor' => $this->db->escape_like_str($this->input->post('delet_vendor', TRUE) ? 1 : 0),
                    'add_inv_cat' => $this->db->escape_like_str($this->input->post('add_inv_cat', TRUE) ? 1 : 0),
                    'inve_item' => $this->db->escape_like_str($this->input->post('inve_item', TRUE) ? 1 : 0),
                    'delete_inve_ite' => $this->db->escape_like_str($this->input->post('delete_inve_ite', TRUE) ? 1 : 0),
                    'delete_inv_cat' => $this->db->escape_like_str($this->input->post('delete_inv_cat', TRUE) ? 1 : 0),
                    'inve_issu' => $this->db->escape_like_str($this->input->post('inve_issu', TRUE) ? 1 : 0),
                    'delete_inven_issu' => $this->db->escape_like_str($this->input->post('delete_inven_issu', TRUE) ? 1 : 0),
                    'check_leav_appli' => $this->db->escape_like_str($this->input->post('check_leav_appli', TRUE) ? 1 : 0),
                    'setting_manage_user' => $this->db->escape_like_str($this->input->post('setting_manage_user', TRUE) ? 1 : 0),
                    'setting_accounts' => $this->db->escape_like_str($this->input->post('setting_accounts', TRUE) ? 1 : 0),
                    'other_setting' => $this->db->escape_like_str($this->input->post('other_setting', TRUE) ? 1 : 0),
                    'front_setings' => $this->db->escape_like_str($this->input->post('front_setings', TRUE) ? 1 : 0),
                );



                $roleInfo = $this->db->where('group_id', $userGroupId)->get('role_based_access')->result_array();
                $result = false;

                if (count($roleInfo) > 0) {
                    // If role info exists, perform an update
                    foreach ($roleInfo as $row) {
                        if ($row['group_id'] == $userGroupId) {
                            $info = $this->db->where('user_id', $row['user_id'])->update('role_based_access', $roleArray);
                            $result = true;
                        }
                    }
                } else {
                    // If no role info exists, perform an insert
                    $this->db->insert('role_based_access', $roleArray);
                }



                if ($result) {
                    $data['group'] = $this->configarationmodel->allGroup();

                    $data['message'] = '<div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                        <strong>Success !</strong>This user group\'s access updated perfectly.
                                </div>';
                    $this->load->view('temp/header');
                    $this->load->view('groupRole', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $data['group'] = $this->configarationmodel->allGroup();
                $this->load->view('temp/header');
                $this->load->view('groupRole', $data);
                $this->load->view('temp/footer');
            }
        }

        //This ajax function will show user group base role access 
        public function ajaxGroupRole()
        {
            $userGroupId = $this->input->get('usGro');
            $roleInfo = $this->db->where('group_id', $userGroupId)->get('role_based_access')->row_array();
            // echo "<pre>";
            // print_r($roleInfo);
            echo '<div class="col-md-12">
            <div class="alert alert-info">
            <strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div>
            <div class="form-group">
            <div class="checkbox-list">
            <label class="roll_row"><input type="checkbox" name="das_top_info" value="1"  ' .
                (isset($roleInfo['das_top_info']) && $roleInfo['das_top_info'] == 1 ? 'checked' : '') . '> ' . lang('rol_1') . '  </label>
            <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1" ' .
                (isset($roleInfo['das_grab_chart']) && $roleInfo['das_grab_chart'] == 1 ? 'checked' : '') . '> ' . lang('rol_2') . ' </label>
            <label class="roll_row"><input type="checkbox" name="das_class_info" value="1" ' .
                (isset($roleInfo['das_class_info']) && $roleInfo['das_class_info'] == 1 ? 'checked' : '') . '> ' . lang('rol_3') . '</label>
            <label class="roll_row"><input type="checkbox" name="das_message" value="1" ' .
                (isset($roleInfo['das_message']) && $roleInfo['das_message'] == 1 ? 'checked' : '') . '> ' . lang('rol_4') . '</label>
            <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1" ' .
                (isset($roleInfo['das_employ_attend']) && $roleInfo['das_employ_attend'] == 1 ? 'checked' : '') . '> ' . lang('rol_5') . '</label>
            <label class="roll_row"><input type="checkbox" name="das_notice" value="1" ' .
                (isset($roleInfo['das_notice']) && $roleInfo['das_notice'] == 1 ? 'checked' : '') . '> ' . lang('rol_6') . '</label>
            <label class="roll_row"><input type="checkbox" name="das_calender" value="1" ' . 
                        (isset($roleInfo['das_calender']) && $roleInfo['das_calender'] == 1 ? 'checked' : '') . '> ' . lang('rol_7') . '</label>
            <label class="roll_row"><input type="checkbox" name="admission" value="1" ' .
                (isset($roleInfo['admission']) && $roleInfo['admission'] == 1 ? 'checked' : '') . '> ' . lang('rol_8') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_student_info" value="1" ' .
                (isset($roleInfo['all_student_info']) && $roleInfo['all_student_info'] == 1 ? 'checked' : '') . '> ' . lang('rol_9') . '</label>
            <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1" ' .
                (isset($roleInfo['stud_edit_delete']) && $roleInfo['stud_edit_delete'] == 1 ? 'checked' : '') . '> ' . lang('rol_10') . '</label>
            <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1">' .
                (isset($roleInfo['stu_own_info']) && $roleInfo['stu_own_info'] == 1 ? 'checked' : '') . '>' . lang('rol_11') . ' </label>
            <label class="roll_row"><input type="checkbox" name="teacher_info" value="1" ' .
                (isset($roleInfo['teacher_info']) && $roleInfo['teacher_info'] == 1 ? 'checked' : '') . '> ' . lang('rol_12') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_teacher" value="1" ' .
                (isset($roleInfo['add_teacher']) && $roleInfo['add_teacher'] == 1 ? 'checked' : '') . '> ' . lang('rol_13') . '</label>
            <label class="roll_row"><input type="checkbox" name="teacher_details" value="1" ' .
                (isset($roleInfo['teacher_details']) && $roleInfo['teacher_details'] == 1 ? 'checked' : '') . '> ' . lang('rol_14') . '</label>
            <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1" ' .
                (isset($roleInfo['teacher_edit_delete']) && $roleInfo['teacher_edit_delete'] == 1 ? 'checked' : '') . '> ' . lang('rol_15') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1" ' .
                (isset($roleInfo['all_parents_info']) && $roleInfo['all_parents_info'] == 1 ? 'checked' : '') . '> ' . lang('rol_16') . '</label>
            <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1">' .
                (isset($roleInfo['das_notice']) && $roleInfo['das_notice'] == 1 ? 'checked' : '') . '' . lang('rol_17') . '</label>
            <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1" ' .
                (isset($roleInfo['make_parents_id']) && $roleInfo['make_parents_id'] == 1 ? 'checked' : '') . '> ' . lang('rol_18') . '</label>
            <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1" ' .
                (isset($roleInfo['parents_edit_dlete']) && $roleInfo['parents_edit_dlete'] == 1 ? 'checked' : '') . '> ' . lang('rol_19') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_new_class" value="1" ' .
                (isset($roleInfo['add_new_class']) && $roleInfo['add_new_class'] == 1 ? 'checked' : '') . '> ' . lang('rol_20') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_class_info" value="1" ' .
                (isset($roleInfo['all_class_info']) && $roleInfo['all_class_info'] == 1 ? 'checked' : '') . '> ' . lang('rol_21') . '</label>
            <label class="roll_row"><input type="checkbox" name="class_details" value="1" ' .
                (isset($roleInfo['class_details']) && $roleInfo['class_details'] == 1 ? 'checked' : '') . '> ' . lang('rol_22') . '</label>
            <label class="roll_row"><input type="checkbox" name="class_delete" value="1" ' .
                (isset($roleInfo['class_delete']) && $roleInfo['class_delete'] == 1 ? 'checked' : '') . '> ' . lang('rol_23') . '</label>
            <label class="roll_row"><input type="checkbox" name="class_promotion" value="1" ' .
                (isset($roleInfo['class_promotion']) && $roleInfo['class_promotion'] == 1 ? 'checked' : '') . '> ' . lang('rol_24') . '</label>
            <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1" ' .
                (isset($roleInfo['assin_optio_sub']) && $roleInfo['assin_optio_sub'] == 1 ? 'checked' : '') . '> ' . lang('rol_25') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1" ' .
                (isset($roleInfo['add_class_routine']) && $roleInfo['add_class_routine'] == 1 ? 'checked' : '') . '> ' . lang('rol_26') . '</label>
            <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1">' .
                (isset($roleInfo['own_class_routine']) && $roleInfo['own_class_routine'] == 1 ? 'checked' : '') . '>' . lang('rol_27') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1" ' .
                (isset($roleInfo['all_class_routine']) && $roleInfo['all_class_routine'] == 1 ? 'checked' : '') . '> ' . lang('rol_28') . '</label>
            <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1" ' .
                (isset($roleInfo['rutin_edit_delete']) && $roleInfo['rutin_edit_delete'] == 1 ? 'checked' : '') . '> ' . lang('rol_29') . '</label>
            <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1" ' .
                (isset($roleInfo['attendance_preview']) && $roleInfo['attendance_preview'] == 1 ? 'checked' : '') . '> ' . lang('rol_30') . '</label>
            <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1" ' .
                (isset($roleInfo['take_studence_atten']) && $roleInfo['take_studence_atten'] == 1 ? 'checked' : '') . '> ' . lang('rol_31') . '</label>
            <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1" ' .
                (isset($roleInfo['edit_student_atten']) && $roleInfo['edit_student_atten'] == 1 ? 'checked' : '') . '> ' . lang('rol_32') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_employee" value="1" ' .
                (isset($roleInfo['add_employee']) && $roleInfo['add_employee'] == 1 ? 'checked' : '') . '> ' . lang('rol_33') . '</label>
            <label class="roll_row"><input type="checkbox" name="employee_list" value="1" ' .
                (isset($roleInfo['employee_list']) && $roleInfo['employee_list'] == 1 ? 'checked' : '') . '> ' . lang('rol_34') . '</label>
            <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1" ' .
                (isset($roleInfo['employ_attendance']) && $roleInfo['employ_attendance'] == 1 ? 'checked' : '') . '> ' . lang('rol_35') . '</label>
            <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1" ' .
                (isset($roleInfo['empl_atte_view']) && $roleInfo['empl_atte_view'] == 1 ? 'checked' : '') . '> ' . lang('rol_36') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_subject" value="1" ' .
                (isset($roleInfo['add_subject']) && $roleInfo['add_subject'] == 1 ? 'checked' : '') . '> ' . lang('rol_37') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_subject" value="1" ' .
                (isset($roleInfo['all_subject']) && $roleInfo['all_subject'] == 1 ? 'checked' : '') . '> ' . lang('rol_38') . '</label>
            <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1" ' .
                (isset($roleInfo['make_suggestion']) && $roleInfo['make_suggestion'] == 1 ? 'checked' : '') . '> ' . lang('rol_39') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1" ' .
                (isset($roleInfo['all_suggestion']) && $roleInfo['all_suggestion'] == 1 ? 'checked' : '') . '> ' . lang('rol_40') . '</label>
            <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1">' .
                (isset($roleInfo['own_suggestion']) && $roleInfo['own_suggestion'] == 1 ? 'checked' : '') . '>' . lang('rol_41') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1" ' .
                (isset($roleInfo['add_exam_gread']) && $roleInfo['add_exam_gread'] == 1 ? 'checked' : '') . '> ' . lang('rol_42') . '</label>
            <label class="roll_row"><input type="checkbox" name="exam_gread" value="1" ' .
                (isset($roleInfo['exam_gread']) && $roleInfo['exam_gread'] == 1 ? 'checked' : '') . '> ' . lang('rol_43') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1" ' .
                (isset($roleInfo['add_exam_routin']) && $roleInfo['add_exam_routin'] == 1 ? 'checked' : '') . '> ' . lang('rol_44') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1" ' .
                (isset($roleInfo['all_exam_routine']) && $roleInfo['all_exam_routine'] == 1 ? 'checked' : '') . '>  ' . lang('rol_45') . '</label>
            <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1"' .
                (isset($roleInfo['own_exam_routine']) && $roleInfo['own_exam_routine'] == 1 ? 'checked' : '') . '>' . lang('rol_46') . ' </label>
            <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1" ' .
                (isset($roleInfo['exam_attend_preview']) && $roleInfo['exam_attend_preview'] == 1 ? 'checked' : '') . '> ' . lang('rol_47') . '</label>
            <label class="roll_row"><input type="checkbox" name="approve_result" value="1" ' .
                (isset($roleInfo['approve_result']) && $roleInfo['approve_result'] == 1 ? 'checked' : '') . '> ' . lang('rol_48') . '</label>
            <label class="roll_row"><input type="checkbox" name="view_result" value="1" ' .
                (isset($roleInfo['view_result']) && $roleInfo['view_result'] == 1 ? 'checked' : '') . '> ' . lang('rol_49') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1" ' .
                (isset($roleInfo['all_mark_sheet']) && $roleInfo['all_mark_sheet'] == 1 ? 'checked' : '') . '> ' . lang('rol_50') . '</label>
            <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1">' .
                (isset($roleInfo['own_mark_sheet']) && $roleInfo['own_mark_sheet'] == 1 ? 'checked' : '') . '' . lang('rol_51') . '</label>
            <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1" ' .
                (isset($roleInfo['take_exam_attend']) && $roleInfo['take_exam_attend'] == 1 ? 'checked' : '') . '> ' . lang('rol_52') . '</label>
            <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1" ' .
                (isset($roleInfo['change_exam_attendance']) && $roleInfo['change_exam_attendance'] == 1 ? 'checked' : '') . '> ' . lang('rol_53') . '</label>
            <label class="roll_row"><input type="checkbox" name="make_result" value="1" ' .
                (isset($roleInfo['make_result']) && $roleInfo['make_result'] == 1 ? 'checked' : '') . '> ' . lang('rol_54') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_category" value="1" ' .
                (isset($roleInfo['add_category']) && $roleInfo['add_category'] == 1 ? 'checked' : '') . '> ' . lang('rol_55') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_category" value="1" ' .
                (isset($roleInfo['all_category']) && $roleInfo['all_category'] == 1 ? 'checked' : '') . '> ' . lang('rol_56') . '</label>
            <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1" ' .
                (isset($roleInfo['edit_delete_category']) && $roleInfo['edit_delete_category'] == 1 ? 'checked' : '') . '> ' . lang('rol_57') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_books" value="1" ' .
                (isset($roleInfo['add_books']) && $roleInfo['add_books'] == 1 ? 'checked' : '') . '>  ' . lang('rol_58') . ' </label>
            <label class="roll_row"><input type="checkbox" name="all_books" value="1" ' .
                (isset($roleInfo['all_books']) && $roleInfo['all_books'] == 1 ? 'checked' : '') . '> ' . lang('rol_59') . '</label>
            <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1" ' .
                (isset($roleInfo['edit_delete_books']) && $roleInfo['edit_delete_books'] == 1 ? 'checked' : '') . '> ' . lang('rol_60') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1" ' .
                (isset($roleInfo['add_library_mem']) && $roleInfo['add_library_mem'] == 1 ? 'checked' : '') . '> ' . lang('rol_61') . '</label>
            <label class="roll_row"><input type="checkbox" name="memb_list" value="1" ' .
                (isset($roleInfo['memb_list']) && $roleInfo['memb_list'] == 1 ? 'checked' : '') . '> ' . lang('rol_62') . '</label>
            <label class="roll_row"><input type="checkbox" name="issu_return" value="1" ' .
                (isset($roleInfo['issu_return']) && $roleInfo['issu_return'] == 1 ? 'checked' : '') . '> ' . lang('rol_63') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1" ' .
                (isset($roleInfo['add_dormitories']) && $roleInfo['add_dormitories'] == 1 ? 'checked' : '') . '> ' . lang('rol_64') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1" ' .
                (isset($roleInfo['add_set_dormi']) && $roleInfo['add_set_dormi'] == 1 ? 'checked' : '') . '> ' . lang('rol_65') . '</label>
            <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1" ' .
                (isset($roleInfo['set_member_bed']) && $roleInfo['set_member_bed'] == 1 ? 'checked' : '') . '> ' . lang('rol_66') . '</label>
            <label class="roll_row"><input type="checkbox" name="dormi_report" value="1" ' .
                (isset($roleInfo['dormi_report']) && $roleInfo['dormi_report'] == 1 ? 'checked' : '') . '> ' . lang('rol_67') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_transport" value="1" ' .
                (isset($roleInfo['add_transport']) && $roleInfo['add_transport'] == 1 ? 'checked' : '') . '> ' . lang('rol_68') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_transport" value="1" ' .
                (isset($roleInfo['all_transport']) && $roleInfo['all_transport'] == 1 ? 'checked' : '') . '> ' . lang('rol_69') . '</label>
            <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1" ' .
                (isset($roleInfo['transport_edit_dele']) && $roleInfo['transport_edit_dele'] == 1 ? 'checked' : '') . '> ' . lang('rol_70') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_account_title" value="1" ' .
                (isset($roleInfo['add_account_title']) && $roleInfo['add_account_title'] == 1 ? 'checked' : '') . '> ' . lang('rol_71') . '</label>
            <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1" ' .
                (isset($roleInfo['edit_dele_acco']) && $roleInfo['edit_dele_acco'] == 1 ? 'checked' : '') . '> ' . lang('rol_93') . '</label>
            <label class="roll_row"><input type="checkbox" name="trensection" value="1" ' .
                (isset($roleInfo['trensection']) && $roleInfo['trensection'] == 1 ? 'checked' : '') . '> ' . lang('rol_72') . '</label>
            <label class="roll_row"><input type="checkbox" name="fee_collection" value="1" ' .
                (isset($roleInfo['fee_collection']) && $roleInfo['fee_collection'] == 1 ? 'checked' : '') . '> ' . lang('rol_73') . '</label>
            <label class="roll_row"><input type="checkbox" name="all_slips" value="1" ' .
                (isset($roleInfo['all_slips']) && $roleInfo['all_slips'] == 1 ? 'checked' : '') . '> ' . lang('rol_74') . '</label>
            <label class="roll_row"><input type="checkbox" name="own_slip" value="1">' .
                (isset($roleInfo['own_slip']) && $roleInfo['own_slip'] == 1 ? 'checked' : '') . '' . lang('rol_75') . '</label>
            <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1" ' .
                (isset($roleInfo['slip_edit_delete']) && $roleInfo['slip_edit_delete'] == 1 ? 'checked' : '') . '>' . lang('rol_76') . '</label>
            <label class="roll_row"><input type="checkbox" name="pay_salary" value="1" ' .
                (isset($roleInfo['pay_salary']) && $roleInfo['pay_salary'] == 1 ? 'checked' : '') . '>' . lang('rol_77') . '</label>
            <label class="roll_row"><input type="checkbox" name="creat_notice" value="1" ' .
                (isset($roleInfo['creat_notice']) && $roleInfo['creat_notice'] == 1 ? 'checked' : '') . '> ' . lang('rol_78') . '</label>
            <label class="roll_row"><input type="checkbox" name="send_message" value="1" ' .
                (isset($roleInfo['send_message']) && $roleInfo['send_message'] == 1 ? 'checked' : '') . '> ' . lang('rol_79') . '</label>
            <label class="roll_row"><input type="checkbox" name="vendor" value="1" ' .
                (isset($roleInfo['vendor']) && $roleInfo['vendor'] == 1 ? 'checked' : '') . '> ' . lang('rol_80') . '</label>
            <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1" ' .
                (isset($roleInfo['delet_vendor']) && $roleInfo['delet_vendor'] == 1 ? 'checked' : '') . '> ' . lang('rol_81') . '</label>
            <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1" ' .
                (isset($roleInfo['add_inv_cat']) && $roleInfo['add_inv_cat'] == 1 ? 'checked' : '') . '> ' . lang('rol_82') . '</label>
            <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1" ' .
                (isset($roleInfo['delete_inv_cat']) && $roleInfo['delete_inv_cat'] == 1 ? 'checked' : '') . '> ' . lang('rol_83') . '</label>
            <label class="roll_row"><input type="checkbox" name="inve_item" value="1" ' .
                (isset($roleInfo['inve_item']) && $roleInfo['inve_item'] == 1 ? 'checked' : '') . '> ' . lang('rol_84') . '</label>
            <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1" ' .
                (isset($roleInfo['delete_inve_ite']) && $roleInfo['delete_inve_ite'] == 1 ? 'checked' : '') . '> ' . lang('rol_85') . '</label>
            <label class="roll_row"><input type="checkbox" name="inve_issu" value="1" ' .
                (isset($roleInfo['inve_issu']) && $roleInfo['inve_issu'] == 1 ? 'checked' : '') . '> ' . lang('rol_86') . '</label>
            <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1" ' .
                (isset($roleInfo['delete_inven_issu']) && $roleInfo['delete_inven_issu'] == 1 ? 'checked' : '') . '> ' . lang('rol_87') . '</label>
            <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1" ' .
                (isset($roleInfo['check_leav_appli']) && $roleInfo['check_leav_appli'] == 1 ? 'checked' : '') . '> ' . lang('rol_88') . '</label>
            <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1" ' .
                (isset($roleInfo['setting_manage_user']) && $roleInfo['setting_manage_user'] == 1 ? 'checked' : '') . '> ' . lang('rol_89') . ' </label>
            <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1" ' .
                (isset($roleInfo['setting_accounts']) && $roleInfo['setting_accounts'] == 1 ? 'checked' : '') . '>  ' . lang('rol_90') . '</label>
            <label class="roll_row"><input type="checkbox" name="other_setting" value="1" ' .
                (isset($roleInfo['other_setting']) && $roleInfo['other_setting'] == 1 ? 'checked' : '') . '> ' . lang('rol_91') . '</label>
            <label class="roll_row"><input type="checkbox" name="front_setings" value="1" ' .
                (isset($roleInfo['front_setings']) && $roleInfo['front_setings'] == 1 ? 'checked' : '') . '>' . lang('rol_92') . '</label>
            </div></div></div><div class="clearfix"></div>';


            // if ($userGroupId == '1') {
            //     //System admin access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1" checked> ' . lang('rol_1') . '  </label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1" checked> ' . lang('rol_2') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1" checked> ' . lang('rol_3') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1" checked> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1" checked> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1" checked> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1" checked> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1" checked> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1" checked> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1" checked> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1"> ' . lang('rol_11') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1" checked> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1" checked> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1" checked> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1" checked> ' . lang('rol_15') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1" checked> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1"> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1" checked> ' . lang('rol_18') . '</label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1" checked> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1" checked> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1" checked> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1" checked> ' . lang('rol_22') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1" checked> ' . lang('rol_23') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1" checked> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1" checked> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1" checked> ' . lang('rol_26') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1"> ' . lang('rol_27') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1" checked> ' . lang('rol_28') . '</label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1" checked> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1" checked> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1" checked> ' . lang('rol_31') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1" checked> ' . lang('rol_32') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" checked> ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1" checked> ' . lang('rol_34') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1" checked> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1" checked> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1" checked> ' . lang('rol_37') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1" checked> ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1" checked> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1" checked> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1"> ' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1" checked> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1" checked> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1" checked> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1" checked>  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1">' . lang('rol_46') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1" checked> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1" checked> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1" checked> ' . lang('rol_49') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1" checked> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1"> ' . lang('rol_51') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1" checked> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1" checked> ' . lang('rol_53') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1" checked> ' . lang('rol_54') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1" checked> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1" checked> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1" checked> ' . lang('rol_57') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1" checked>  ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1" checked> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1" checked> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1" checked> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1" checked> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1" checked> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1" checked> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1" checked> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1" checked> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1" checked> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1" checked> ' . lang('rol_68') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1" checked> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1" checked> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1" checked> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1" checked> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1" checked> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1" checked> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1" checked> ' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1"> ' . lang('rol_75') . '</label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1" checked>' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1" checked>' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1" checked> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1" checked> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1" checked> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1" checked> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1" checked> ' . lang('rol_82') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1" checked> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1" checked> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1" checked> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1" checked> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1" checked> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1" checked> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1" checked> ' . lang('rol_89') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1" checked>  ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1" checked> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1" checked>' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // } elseif ($userGroupId == '3') {
            //     //Students access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1" > ' . lang('rol_1') . '  </label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1"> ' . lang('rol_2') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1">' . lang('rol_3') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1" checked> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1"> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1" checked> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1" checked> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1"> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1" checked>' . lang('rol_11') . '  </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1" checked> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1"> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1"> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1">' . lang('rol_15') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1"> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1" checked> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1"> ' . lang('rol_18') . '</label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1"> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1"> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1"> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1">' . lang('rol_22') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1"> ' . lang('rol_23') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1"> ' . lang('rol_26') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1" checked> ' . lang('rol_27') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1">' . lang('rol_28') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1"> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1">' . lang('rol_31') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1">' . lang('rol_32') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" > ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1">' . lang('rol_34') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1"> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1">' . lang('rol_37') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1" > ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1"> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1"> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1" checked>' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1"> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1"> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1">  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1" checked> ' . lang('rol_46') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1"> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1"> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1" checked>' . lang('rol_49') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1"> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1" checked> ' . lang('rol_51') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1"> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1">' . lang('rol_53') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1">' . lang('rol_54') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1"> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1" checked> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1">' . lang('rol_57') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1">  ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1" checked> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1"> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1"> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1"> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1"> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1" checked> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1">' . lang('rol_68') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1" checked> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1"> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1"> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1"> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1"> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1">' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1" checked> ' . lang('rol_75') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1"> ' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1"> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1">' . lang('rol_82') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1"> ' . lang('rol_89') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1"> ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1"> ' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // } elseif ($userGroupId == '4') {
            //     //teacher access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1" checked> ' . lang('rol_1') . '  </label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1"> ' . lang('rol_2') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1" checked> ' . lang('rol_3') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1" checked> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1"> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1" checked> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1" checked> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1" checked> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1"> ' . lang('rol_11') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1"> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1"> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1"> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1"> ' . lang('rol_15') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1" checked> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1"> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1"> ' . lang('rol_18') . '</label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1"> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1"> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1" checked> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1" checked> ' . lang('rol_22') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1">' . lang('rol_23') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1">' . lang('rol_26') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1">' . lang('rol_27') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1" checked> ' . lang('rol_28') . '</label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1" checked> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1" checked> ' . lang('rol_31') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1"> ' . lang('rol_32') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" > ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1"> ' . lang('rol_34') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1"> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1"> ' . lang('rol_37') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1" checked> ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1" checked> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1" checked> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1"> ' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1"> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1" checked> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1" checked>  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1"> ' . lang('rol_46') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1" checked> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1"> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1" checked> ' . lang('rol_49') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1" checked> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1"> ' . lang('rol_51') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1" checked> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1"> ' . lang('rol_53') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1" checked> ' . lang('rol_54') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1"> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1" checked> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1"> ' . lang('rol_57') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1"> ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1" checked> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1"> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1"> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1"> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1"> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1" checked> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1"> ' . lang('rol_68') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1" checked> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1"> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1" checked> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1"> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1" checked> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1" checked> ' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1"> ' . lang('rol_75') . '</label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1"> ' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1" checked> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1"> ' . lang('rol_82') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1"> ' . lang('rol_89') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1"> ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1"> ' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // } elseif ($userGroupId == '5') {
            //     //Parents access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1"> ' . lang('rol_1') . '  </label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1"> ' . lang('rol_2') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1"> ' . lang('rol_3') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1" checked> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1"> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1" checked> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1" checked> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1"> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1" checked> ' . lang('rol_11') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1" checked> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1"> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1"> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1"> ' . lang('rol_15') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1"> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1" checked> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1"> ' . lang('rol_18') . '</label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1"> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1"> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1"> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1"> ' . lang('rol_22') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1"> ' . lang('rol_23') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1"> ' . lang('rol_26') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1" checked> ' . lang('rol_27') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1"> ' . lang('rol_28') . '</label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1"> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1"> ' . lang('rol_31') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1"> ' . lang('rol_32') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" > ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1"> ' . lang('rol_34') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1"> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1"> ' . lang('rol_37') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1" > ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1"> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1"> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1" checked> ' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1" checked> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1"> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1">  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1" checked> ' . lang('rol_46') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1"> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1"> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1" checked> ' . lang('rol_49') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1"> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1" checked> ' . lang('rol_51') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1"> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1"> ' . lang('rol_53') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1"> ' . lang('rol_54') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1"> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1" checked> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1"> ' . lang('rol_57') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1"> ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1" checked> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1"> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1"> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1"> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1"> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1" checked> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1"> ' . lang('rol_68') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1" checked> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1"> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1" checked> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1"> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1"> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1"> ' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1" checked> ' . lang('rol_75') . '</label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1"> ' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1"> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1"> ' . lang('rol_82') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1"> ' . lang('rol_89') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1"> ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1"> ' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // } elseif ($userGroupId == '6') {
            //     //accountant access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1" checked> ' . lang('rol_1') . '  </label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1" checked> ' . lang('rol_2') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1" checked> ' . lang('rol_3') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1" checked> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1" checked> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1" checked> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1" checked> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1" checked> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1"> ' . lang('rol_11') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1" checked> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1"> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1" checked> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1"> ' . lang('rol_15') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1" checked> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1"> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1">' . lang('rol_18') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1"> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1"> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1" checked> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1" checked> ' . lang('rol_22') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1"> ' . lang('rol_23') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1">' . lang('rol_26') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1"> ' . lang('rol_27') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1" checked> ' . lang('rol_28') . '</label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1" checked> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1"> ' . lang('rol_31') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1"> ' . lang('rol_32') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" > ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1"> ' . lang('rol_34') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1"> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1"> ' . lang('rol_37') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1" checked> ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1"> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1" checked> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1"> ' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1"> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1" checked> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1" checked>  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1"> ' . lang('rol_46') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1" checked> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1"> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1" checked> ' . lang('rol_49') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1" checked> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1">' . lang('rol_51') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1"> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1"> ' . lang('rol_53') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1" checked> ' . lang('rol_54') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1"> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1" checked> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1"> ' . lang('rol_57') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1"> ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1" checked> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1"> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1"> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1"> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1"> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1" checked> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1"> ' . lang('rol_68') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1" checked> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1" checked> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1" checked> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1" checked> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1" checked> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1" checked> ' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1"> ' . lang('rol_75') . '</label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1" checked> ' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1" checked> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1"> ' . lang('rol_82') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1">  ' . lang('rol_89') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1" checked>  ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1">  ' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // } elseif ($userGroupId == '7') {
            //     //library_man access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1" checked> ' . lang('rol_1') . '  </label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1"> ' . lang('rol_2') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1" checked> ' . lang('rol_3') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1" checked> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1"> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1" checked> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1" checked> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1" checked> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1"> ' . lang('rol_11') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1" checked> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1"> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1" checked> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1"> ' . lang('rol_15') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1" checked> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1"> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1"> ' . lang('rol_18') . '</label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1"> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1"> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1" checked> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1" checked> ' . lang('rol_22') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1"> ' . lang('rol_23') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1"> ' . lang('rol_26') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1"> ' . lang('rol_27') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1" checked> ' . lang('rol_28') . '</label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1" checked> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1"> ' . lang('rol_31') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1"> ' . lang('rol_32') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" > ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1"> ' . lang('rol_34') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1"> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1"> ' . lang('rol_37') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1" checked> ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1"> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1" checked> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1"> ' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1"> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1" checked> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1" checked>  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1"> ' . lang('rol_46') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1" checked> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1"> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1" checked> ' . lang('rol_49') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1"> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1"> ' . lang('rol_51') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1"> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1"> ' . lang('rol_53') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1" checked> ' . lang('rol_54') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1" checked> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1" checked> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1" checked> ' . lang('rol_57') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1" checked>  ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1" checked> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1" checked> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1" checked> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1" checked> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1" checked> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1" checked> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1"> ' . lang('rol_68') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1" checked> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1"> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1"> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1"> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1"> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1"> ' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1">  ' . lang('rol_75') . '</label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1"> ' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1" checked> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1"> ' . lang('rol_82') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1">  ' . lang('rol_89') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1">  ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1">  ' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // } elseif ($userGroupId == '8') {
            //     //4th_class_employ access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1" checked> ' . lang('rol_1') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1" checked> ' . lang('rol_2') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1" checked> ' . lang('rol_3') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1"> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1"> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1"> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1"> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1"> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1"> ' . lang('rol_11') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1"> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1"> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1"> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1"> ' . lang('rol_15') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1"> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1"> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1"> ' . lang('rol_18') . '</label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1"> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1"> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1"> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1"> ' . lang('rol_22') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1"> ' . lang('rol_23') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1"> ' . lang('rol_26') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1"> ' . lang('rol_27') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1"> ' . lang('rol_28') . '</label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1"> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1"> ' . lang('rol_31') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1"> ' . lang('rol_32') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" > ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1"> ' . lang('rol_34') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1"> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1"> ' . lang('rol_37') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1"> ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1"> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1"> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1"> ' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1"> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1"> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1">  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1"> ' . lang('rol_46') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1"> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1"> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1"> ' . lang('rol_49') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1"> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1"> ' . lang('rol_51') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1"> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1"> ' . lang('rol_53') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1"> ' . lang('rol_54') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1"> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1"> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1"> ' . lang('rol_57') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1">  ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1"> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1"> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1"> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1"> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1"> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1"> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1"> ' . lang('rol_68') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1"> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1"> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1"> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1"> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1"> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1"> ' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1">  ' . lang('rol_75') . '</label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1"> ' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1"> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1"> ' . lang('rol_82') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1">  ' . lang('rol_89') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1">  ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1">  ' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // } elseif ($userGroupId == '9') {
            //     //driver access here
            //     echo '<div class="col-md-12"><div class="alert alert-info"><strong>' . lang('conc_role') . '</strong> ' . lang('conc_6') . '</div><div class="form-group"><div class="checkbox-list">
            // <label class="roll_row"><input type="checkbox" name="das_top_info" value="1"> ' . lang('rol_1') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_grab_chart" value="1"> ' . lang('rol_2') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="das_class_info" value="1"> ' . lang('rol_3') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_message" value="1"> ' . lang('rol_4') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_employ_attend" value="1"> ' . lang('rol_5') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_notice" value="1"> ' . lang('rol_6') . '</label>
            // <label class="roll_row"><input type="checkbox" name="das_calender" value="1"> ' . lang('rol_7') . '</label>
            // <label class="roll_row"><input type="checkbox" name="admission" value="1"> ' . lang('rol_8') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_student_info" value="1"> ' . lang('rol_9') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stud_edit_delete" value="1"> ' . lang('rol_10') . '</label>
            // <label class="roll_row"><input type="checkbox" name="stu_own_info" value="1"> ' . lang('rol_11') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="teacher_info" value="1"> ' . lang('rol_12') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_teacher" value="1"> ' . lang('rol_13') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_details" value="1"> ' . lang('rol_14') . '</label>
            // <label class="roll_row"><input type="checkbox" name="teacher_edit_delete" value="1"> ' . lang('rol_15') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_parents_info" value="1"> ' . lang('rol_16') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_parents_info" value="1"> ' . lang('rol_17') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_parents_id" value="1"> ' . lang('rol_18') . '</label>
            // <label class="roll_row"><input type="checkbox" name="parents_edit_dlete" value="1"> ' . lang('rol_19') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_new_class" value="1"> ' . lang('rol_20') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_info" value="1"> ' . lang('rol_21') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_details" value="1"> ' . lang('rol_22') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_delete" value="1"> ' . lang('rol_23') . '</label>
            // <label class="roll_row"><input type="checkbox" name="class_promotion" value="1"> ' . lang('rol_24') . '</label>
            // <label class="roll_row"><input type="checkbox" name="assin_optio_sub" value="1"> ' . lang('rol_25') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_class_routine" value="1"> ' . lang('rol_26') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_class_routine" value="1"> ' . lang('rol_27') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_class_routine" value="1"> ' . lang('rol_28') . '</label>
            // <label class="roll_row"><input type="checkbox" name="rutin_edit_delete" value="1"> ' . lang('rol_29') . '</label>
            // <label class="roll_row"><input type="checkbox" name="attendance_preview" value="1"> ' . lang('rol_30') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_studence_atten" value="1"> ' . lang('rol_31') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_student_atten" value="1"> ' . lang('rol_32') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_employee" value="1" > ' . lang('rol_33') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employee_list" value="1"> ' . lang('rol_34') . '</label>
            // <label class="roll_row"><input type="checkbox" name="employ_attendance" value="1"> ' . lang('rol_35') . '</label>
            // <label class="roll_row"><input type="checkbox" name="empl_atte_view" value="1"> ' . lang('rol_36') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_subject" value="1"> ' . lang('rol_37') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_subject" value="1"> ' . lang('rol_38') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_suggestion" value="1"> ' . lang('rol_39') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_suggestion" value="1"> ' . lang('rol_40') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_suggestion" value="1"> ' . lang('rol_41') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_gread" value="1"> ' . lang('rol_42') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_gread" value="1"> ' . lang('rol_43') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_exam_routin" value="1"> ' . lang('rol_44') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_exam_routine" value="1">  ' . lang('rol_45') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_exam_routine" value="1"> ' . lang('rol_46') . '</label>
            // <label class="roll_row"><input type="checkbox" name="exam_attend_preview" value="1"> ' . lang('rol_47') . '</label>
            // <label class="roll_row"><input type="checkbox" name="approve_result" value="1"> ' . lang('rol_48') . '</label>
            // <label class="roll_row"><input type="checkbox" name="view_result" value="1"> ' . lang('rol_49') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_mark_sheet" value="1"> ' . lang('rol_50') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_mark_sheet" value="1"> ' . lang('rol_51') . '</label>
            // <label class="roll_row"><input type="checkbox" name="take_exam_attend" value="1"> ' . lang('rol_52') . '</label>
            // <label class="roll_row"><input type="checkbox" name="change_exam_attendance" value="1"> ' . lang('rol_53') . '</label>
            // <label class="roll_row"><input type="checkbox" name="make_result" value="1"> ' . lang('rol_54') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_category" value="1"> ' . lang('rol_55') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_category" value="1"> ' . lang('rol_56') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_category" value="1"> ' . lang('rol_57') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_books" value="1">  ' . lang('rol_58') . ' </label>
            // <label class="roll_row"><input type="checkbox" name="all_books" value="1"> ' . lang('rol_59') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_delete_books" value="1"> ' . lang('rol_60') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_library_mem" value="1"> ' . lang('rol_61') . '</label>
            // <label class="roll_row"><input type="checkbox" name="memb_list" value="1"> ' . lang('rol_62') . '</label>
            // <label class="roll_row"><input type="checkbox" name="issu_return" value="1"> ' . lang('rol_63') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_dormitories" value="1"> ' . lang('rol_64') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_set_dormi" value="1"> ' . lang('rol_65') . '</label>
            // <label class="roll_row"><input type="checkbox" name="set_member_bed" value="1"> ' . lang('rol_66') . '</label>
            // <label class="roll_row"><input type="checkbox" name="dormi_report" value="1"> ' . lang('rol_67') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_transport" value="1"> ' . lang('rol_68') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_transport" value="1"> ' . lang('rol_69') . '</label>
            // <label class="roll_row"><input type="checkbox" name="transport_edit_dele" value="1"> ' . lang('rol_70') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_account_title" value="1"> ' . lang('rol_71') . '</label>
            // <label class="roll_row"><input type="checkbox" name="edit_dele_acco" value="1"> ' . lang('rol_93') . '</label>
            // <label class="roll_row"><input type="checkbox" name="trensection" value="1"> ' . lang('rol_72') . '</label>
            // <label class="roll_row"><input type="checkbox" name="fee_collection" value="1"> ' . lang('rol_73') . '</label>
            // <label class="roll_row"><input type="checkbox" name="all_slips" value="1"> ' . lang('rol_74') . '</label>
            // <label class="roll_row"><input type="checkbox" name="own_slip" value="1">  ' . lang('rol_75') . '</label>
            // <label class="roll_row"><input type="checkbox" name="slip_edit_delete" value="1"> ' . lang('rol_76') . '</label>
            // <label class="roll_row"><input type="checkbox" name="pay_salary" value="1"> ' . lang('rol_77') . '</label>
            // <label class="roll_row"><input type="checkbox" name="creat_notice" value="1"> ' . lang('rol_78') . '</label>
            // <label class="roll_row"><input type="checkbox" name="send_message" value="1"> ' . lang('rol_79') . '</label>
            // <label class="roll_row"><input type="checkbox" name="vendor" value="1"> ' . lang('rol_80') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delet_vendor" value="1"> ' . lang('rol_81') . '</label>
            // <label class="roll_row"><input type="checkbox" name="add_inv_cat" value="1"> ' . lang('rol_82') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inv_cat" value="1"> ' . lang('rol_83') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_item" value="1"> ' . lang('rol_84') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inve_ite" value="1"> ' . lang('rol_85') . '</label>
            // <label class="roll_row"><input type="checkbox" name="inve_issu" value="1"> ' . lang('rol_86') . '</label>
            // <label class="roll_row"><input type="checkbox" name="delete_inven_issu" value="1"> ' . lang('rol_87') . '</label>
            // <label class="roll_row"><input type="checkbox" name="check_leav_appli" value="1"> ' . lang('rol_88') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_manage_user" value="1">  ' . lang('rol_89') . '</label>
            // <label class="roll_row"><input type="checkbox" name="setting_accounts" value="1">  ' . lang('rol_90') . '</label>
            // <label class="roll_row"><input type="checkbox" name="other_setting" value="1"> ' . lang('rol_91') . '</label>
            // <label class="roll_row"><input type="checkbox" name="front_setings" value="1">  ' . lang('rol_92') . '</label>
            // </div></div></div><div class="clearfix"></div>';
            // }
        }

        //This function will reset all users role access
        public function resetRole()
        {
            $admin = array(
                'das_top_info' => $this->db->escape_like_str(1),
                'das_grab_chart' => $this->db->escape_like_str(1),
                'das_class_info' => $this->db->escape_like_str(1),
                'das_message' => $this->db->escape_like_str(1),
                'das_employ_attend' => $this->db->escape_like_str(1),
                'das_notice' => $this->db->escape_like_str(1),
                'das_calender' => $this->db->escape_like_str(1),
                'admission' => $this->db->escape_like_str(1),
                'all_student_info' => $this->db->escape_like_str(1),
                'stud_edit_delete' => $this->db->escape_like_str(1),
                'stu_own_info' => $this->db->escape_like_str(0),
                'teacher_info' => $this->db->escape_like_str(1),
                'add_teacher' => $this->db->escape_like_str(1),
                'teacher_details' => $this->db->escape_like_str(1),
                'teacher_edit_delete' => $this->db->escape_like_str(1),
                'all_parents_info' => $this->db->escape_like_str(1),
                'own_parents_info' => $this->db->escape_like_str(0),
                'make_parents_id' => $this->db->escape_like_str(1),
                'parents_edit_dlete' => $this->db->escape_like_str(1),
                'add_new_class' => $this->db->escape_like_str(1),
                'all_class_info' => $this->db->escape_like_str(1),
                'class_details' => $this->db->escape_like_str(1),
                'class_delete' => $this->db->escape_like_str(1),
                'class_promotion' => $this->db->escape_like_str(1),
                'assin_optio_sub' => $this->db->escape_like_str(1),
                'add_class_routine' => $this->db->escape_like_str(1),
                'own_class_routine' => $this->db->escape_like_str(0),
                'all_class_routine' => $this->db->escape_like_str(1),
                'rutin_edit_delete' => $this->db->escape_like_str(1),
                'attendance_preview' => $this->db->escape_like_str(1),
                'take_studence_atten' => $this->db->escape_like_str(0),
                'edit_student_atten' => $this->db->escape_like_str(1),
                'add_employee' => $this->db->escape_like_str(1),
                'employee_list' => $this->db->escape_like_str(1),
                'employ_attendance' => $this->db->escape_like_str(1),
                'empl_atte_view' => $this->db->escape_like_str(1),
                'add_subject' => $this->db->escape_like_str(1),
                'all_subject' => $this->db->escape_like_str(1),
                'make_suggestion' => $this->db->escape_like_str(1),
                'all_suggestion' => $this->db->escape_like_str(1),
                'own_suggestion' => $this->db->escape_like_str(0),
                'add_exam_gread' => $this->db->escape_like_str(1),
                'exam_gread' => $this->db->escape_like_str(1),
                'add_exam_routin' => $this->db->escape_like_str(1),
                'all_exam_routine' => $this->db->escape_like_str(1),
                'own_exam_routine' => $this->db->escape_like_str(0),
                'exam_attend_preview' => $this->db->escape_like_str(1),
                'approve_result' => $this->db->escape_like_str(1),
                'view_result' => $this->db->escape_like_str(1),
                'all_mark_sheet' => $this->db->escape_like_str(1),
                'own_mark_sheet' => $this->db->escape_like_str(0),
                'take_exam_attend' => $this->db->escape_like_str(1),
                'change_exam_attendance' => $this->db->escape_like_str(1),
                'make_result' => $this->db->escape_like_str(1),
                'add_category' => $this->db->escape_like_str(1),
                'all_category' => $this->db->escape_like_str(1),
                'edit_delete_category' => $this->db->escape_like_str(1),
                'add_books' => $this->db->escape_like_str(1),
                'all_books' => $this->db->escape_like_str(1),
                'edit_delete_books' => $this->db->escape_like_str(1),
                'add_library_mem' => $this->db->escape_like_str(1),
                'memb_list' => $this->db->escape_like_str(1),
                'issu_return' => $this->db->escape_like_str(1),
                'add_dormitories' => $this->db->escape_like_str(1),
                'add_set_dormi' => $this->db->escape_like_str(1),
                'set_member_bed' => $this->db->escape_like_str(1),
                'dormi_report' => $this->db->escape_like_str(1),
                'add_transport' => $this->db->escape_like_str(1),
                'all_transport' => $this->db->escape_like_str(1),
                'transport_edit_dele' => $this->db->escape_like_str(1),
                'add_account_title' => $this->db->escape_like_str(1),
                'edit_dele_acco' => $this->db->escape_like_str(1),
                'trensection' => $this->db->escape_like_str(1),
                'fee_collection' => $this->db->escape_like_str(1),
                'all_slips' => $this->db->escape_like_str(1),
                'own_slip' => $this->db->escape_like_str(0),
                'slip_edit_delete' => $this->db->escape_like_str(1),
                'pay_salary' => $this->db->escape_like_str(1),
                'creat_notice' => $this->db->escape_like_str(1),
                'send_message' => $this->db->escape_like_str(1),
                'vendor' => $this->db->escape_like_str(1),
                'delet_vendor' => $this->db->escape_like_str(1),
                'add_inv_cat' => $this->db->escape_like_str(1),
                'inve_item' => $this->db->escape_like_str(1),
                'delete_inve_ite' => $this->db->escape_like_str(1),
                'delete_inv_cat' => $this->db->escape_like_str(1),
                'inve_issu' => $this->db->escape_like_str(1),
                'delete_inven_issu' => $this->db->escape_like_str(1),
                'check_leav_appli' => $this->db->escape_like_str(1),
                'setting_manage_user' => $this->db->escape_like_str(1),
                'setting_accounts' => $this->db->escape_like_str(1),
                'other_setting' => $this->db->escape_like_str(1),
                'front_setings' => $this->db->escape_like_str(1),
            );
            $this->db->where('group_id', 1);
            $this->db->update('role_based_access', $admin);
            $student = array(
                'das_top_info' => $this->db->escape_like_str(0),
                'das_grab_chart' => $this->db->escape_like_str(0),
                'das_class_info' => $this->db->escape_like_str(0),
                'das_message' => $this->db->escape_like_str(1),
                'das_employ_attend' => $this->db->escape_like_str(0),
                'das_notice' => $this->db->escape_like_str(1),
                'das_calender' => $this->db->escape_like_str(1),
                'admission' => $this->db->escape_like_str(0),
                'all_student_info' => $this->db->escape_like_str(0),
                'stud_edit_delete' => $this->db->escape_like_str(0),
                'stu_own_info' => $this->db->escape_like_str(1),
                'teacher_info' => $this->db->escape_like_str(1),
                'add_teacher' => $this->db->escape_like_str(0),
                'teacher_details' => $this->db->escape_like_str(0),
                'teacher_edit_delete' => $this->db->escape_like_str(0),
                'all_parents_info' => $this->db->escape_like_str(0),
                'own_parents_info' => $this->db->escape_like_str(1),
                'make_parents_id' => $this->db->escape_like_str(0),
                'parents_edit_dlete' => $this->db->escape_like_str(0),
                'add_new_class' => $this->db->escape_like_str(0),
                'all_class_info' => $this->db->escape_like_str(0),
                'class_details' => $this->db->escape_like_str(0),
                'class_delete' => $this->db->escape_like_str(0),
                'class_promotion' => $this->db->escape_like_str(0),
                'assin_optio_sub' => $this->db->escape_like_str(0),
                'add_class_routine' => $this->db->escape_like_str(0),
                'own_class_routine' => $this->db->escape_like_str(1),
                'all_class_routine' => $this->db->escape_like_str(0),
                'rutin_edit_delete' => $this->db->escape_like_str(0),
                'attendance_preview' => $this->db->escape_like_str(0),
                'take_studence_atten' => $this->db->escape_like_str(0),
                'edit_student_atten' => $this->db->escape_like_str(0),
                'add_employee' => $this->db->escape_like_str(0),
                'employee_list' => $this->db->escape_like_str(0),
                'employ_attendance' => $this->db->escape_like_str(0),
                'empl_atte_view' => $this->db->escape_like_str(0),
                'add_subject' => $this->db->escape_like_str(0),
                'all_subject' => $this->db->escape_like_str(1),
                'make_suggestion' => $this->db->escape_like_str(0),
                'all_suggestion' => $this->db->escape_like_str(0),
                'own_suggestion' => $this->db->escape_like_str(1),
                'add_exam_gread' => $this->db->escape_like_str(0),
                'exam_gread' => $this->db->escape_like_str(1),
                'add_exam_routin' => $this->db->escape_like_str(0),
                'all_exam_routine' => $this->db->escape_like_str(0),
                'own_exam_routine' => $this->db->escape_like_str(1),
                'exam_attend_preview' => $this->db->escape_like_str(0),
                'approve_result' => $this->db->escape_like_str(0),
                'view_result' => $this->db->escape_like_str(1),
                'all_mark_sheet' => $this->db->escape_like_str(0),
                'own_mark_sheet' => $this->db->escape_like_str(1),
                'take_exam_attend' => $this->db->escape_like_str(0),
                'change_exam_attendance' => $this->db->escape_like_str(0),
                'make_result' => $this->db->escape_like_str(0),
                'add_category' => $this->db->escape_like_str(0),
                'all_category' => $this->db->escape_like_str(1),
                'edit_delete_category' => $this->db->escape_like_str(0),
                'add_books' => $this->db->escape_like_str(0),
                'all_books' => $this->db->escape_like_str(1),
                'edit_delete_books' => $this->db->escape_like_str(0),
                'add_library_mem' => $this->db->escape_like_str(0),
                'memb_list' => $this->db->escape_like_str(0),
                'issu_return' => $this->db->escape_like_str(0),
                'add_dormitories' => $this->db->escape_like_str(0),
                'add_set_dormi' => $this->db->escape_like_str(0),
                'set_member_bed' => $this->db->escape_like_str(0),
                'dormi_report' => $this->db->escape_like_str(1),
                'add_transport' => $this->db->escape_like_str(0),
                'all_transport' => $this->db->escape_like_str(1),
                'transport_edit_dele' => $this->db->escape_like_str(0),
                'add_account_title' => $this->db->escape_like_str(0),
                'edit_dele_acco' => $this->db->escape_like_str(0),
                'trensection' => $this->db->escape_like_str(0),
                'fee_collection' => $this->db->escape_like_str(0),
                'all_slips' => $this->db->escape_like_str(0),
                'own_slip' => $this->db->escape_like_str(1),
                'slip_edit_delete' => $this->db->escape_like_str(0),
                'pay_salary' => $this->db->escape_like_str(0),
                'creat_notice' => $this->db->escape_like_str(0),
                'send_message' => $this->db->escape_like_str(0),
                'vendor' => $this->db->escape_like_str(0),
                'delet_vendor' => $this->db->escape_like_str(0),
                'add_inv_cat' => $this->db->escape_like_str(0),
                'inve_item' => $this->db->escape_like_str(0),
                'delete_inve_ite' => $this->db->escape_like_str(0),
                'delete_inv_cat' => $this->db->escape_like_str(0),
                'inve_issu' => $this->db->escape_like_str(0),
                'delete_inven_issu' => $this->db->escape_like_str(0),
                'check_leav_appli' => $this->db->escape_like_str(0),
                'setting_manage_user' => $this->db->escape_like_str(0),
                'setting_accounts' => $this->db->escape_like_str(0),
                'other_setting' => $this->db->escape_like_str(0),
                'front_setings' => $this->db->escape_like_str(1),
            );
            $this->db->where('group_id', 3);
            $this->db->update('role_based_access', $student);
            $teacher = array(
                'das_top_info' => $this->db->escape_like_str(1),
                'das_grab_chart' => $this->db->escape_like_str(1),
                'das_class_info' => $this->db->escape_like_str(1),
                'das_message' => $this->db->escape_like_str(1),
                'das_employ_attend' => $this->db->escape_like_str(0),
                'das_notice' => $this->db->escape_like_str(1),
                'das_calender' => $this->db->escape_like_str(1),
                'admission' => $this->db->escape_like_str(0),
                'all_student_info' => $this->db->escape_like_str(1),
                'stud_edit_delete' => $this->db->escape_like_str(0),
                'stu_own_info' => $this->db->escape_like_str(0),
                'teacher_info' => $this->db->escape_like_str(0),
                'add_teacher' => $this->db->escape_like_str(0),
                'teacher_details' => $this->db->escape_like_str(0),
                'teacher_edit_delete' => $this->db->escape_like_str(0),
                'all_parents_info' => $this->db->escape_like_str(1),
                'own_parents_info' => $this->db->escape_like_str(0),
                'make_parents_id' => $this->db->escape_like_str(0),
                'parents_edit_dlete' => $this->db->escape_like_str(0),
                'add_new_class' => $this->db->escape_like_str(0),
                'all_class_info' => $this->db->escape_like_str(1),
                'class_details' => $this->db->escape_like_str(1),
                'class_delete' => $this->db->escape_like_str(0),
                'class_promotion' => $this->db->escape_like_str(0),
                'assin_optio_sub' => $this->db->escape_like_str(0),
                'add_class_routine' => $this->db->escape_like_str(0),
                'own_class_routine' => $this->db->escape_like_str(0),
                'all_class_routine' => $this->db->escape_like_str(1),
                'rutin_edit_delete' => $this->db->escape_like_str(0),
                'attendance_preview' => $this->db->escape_like_str(1),
                'take_studence_atten' => $this->db->escape_like_str(1),
                'edit_student_atten' => $this->db->escape_like_str(0),
                'add_employee' => $this->db->escape_like_str(0),
                'employee_list' => $this->db->escape_like_str(0),
                'employ_attendance' => $this->db->escape_like_str(0),
                'empl_atte_view' => $this->db->escape_like_str(0),
                'add_subject' => $this->db->escape_like_str(0),
                'all_subject' => $this->db->escape_like_str(1),
                'make_suggestion' => $this->db->escape_like_str(1),
                'all_suggestion' => $this->db->escape_like_str(1),
                'own_suggestion' => $this->db->escape_like_str(0),
                'add_exam_gread' => $this->db->escape_like_str(0),
                'exam_gread' => $this->db->escape_like_str(1),
                'add_exam_routin' => $this->db->escape_like_str(0),
                'all_exam_routine' => $this->db->escape_like_str(1),
                'own_exam_routine' => $this->db->escape_like_str(0),
                'exam_attend_preview' => $this->db->escape_like_str(1),
                'approve_result' => $this->db->escape_like_str(0),
                'view_result' => $this->db->escape_like_str(1),
                'all_mark_sheet' => $this->db->escape_like_str(1),
                'own_mark_sheet' => $this->db->escape_like_str(0),
                'take_exam_attend' => $this->db->escape_like_str(1),
                'change_exam_attendance' => $this->db->escape_like_str(0),
                'make_result' => $this->db->escape_like_str(0),
                'add_category' => $this->db->escape_like_str(0),
                'all_category' => $this->db->escape_like_str(1),
                'edit_delete_category' => $this->db->escape_like_str(0),
                'add_books' => $this->db->escape_like_str(0),
                'all_books' => $this->db->escape_like_str(1),
                'edit_delete_books' => $this->db->escape_like_str(0),
                'add_library_mem' => $this->db->escape_like_str(0),
                'memb_list' => $this->db->escape_like_str(0),
                'issu_return' => $this->db->escape_like_str(0),
                'add_dormitories' => $this->db->escape_like_str(0),
                'add_set_dormi' => $this->db->escape_like_str(0),
                'set_member_bed' => $this->db->escape_like_str(0),
                'dormi_report' => $this->db->escape_like_str(1),
                'add_transport' => $this->db->escape_like_str(0),
                'all_transport' => $this->db->escape_like_str(1),
                'transport_edit_dele' => $this->db->escape_like_str(0),
                'add_account_title' => $this->db->escape_like_str(0),
                'edit_dele_acco' => $this->db->escape_like_str(0),
                'trensection' => $this->db->escape_like_str(0),
                'fee_collection' => $this->db->escape_like_str(1),
                'all_slips' => $this->db->escape_like_str(0),
                'own_slip' => $this->db->escape_like_str(0),
                'slip_edit_delete' => $this->db->escape_like_str(0),
                'pay_salary' => $this->db->escape_like_str(0),
                'creat_notice' => $this->db->escape_like_str(0),
                'send_message' => $this->db->escape_like_str(0),
                'vendor' => $this->db->escape_like_str(0),
                'delet_vendor' => $this->db->escape_like_str(0),
                'add_inv_cat' => $this->db->escape_like_str(0),
                'inve_item' => $this->db->escape_like_str(0),
                'delete_inve_ite' => $this->db->escape_like_str(0),
                'delete_inv_cat' => $this->db->escape_like_str(0),
                'inve_issu' => $this->db->escape_like_str(0),
                'delete_inven_issu' => $this->db->escape_like_str(0),
                'check_leav_appli' => $this->db->escape_like_str(0),
                'setting_manage_user' => $this->db->escape_like_str(0),
                'setting_accounts' => $this->db->escape_like_str(0),
                'other_setting' => $this->db->escape_like_str(0),
                'front_setings' => $this->db->escape_like_str(1),
            );
            $this->db->where('group_id', 4);;
            $this->db->update('role_based_access', $teacher);

            $parents = array(
                'das_top_info' => $this->db->escape_like_str(0),
                'das_grab_chart' => $this->db->escape_like_str(0),
                'das_class_info' => $this->db->escape_like_str(0),
                'das_message' => $this->db->escape_like_str(1),
                'das_employ_attend' => $this->db->escape_like_str(0),
                'das_notice' => $this->db->escape_like_str(1),
                'das_calender' => $this->db->escape_like_str(1),
                'admission' => $this->db->escape_like_str(0),
                'all_student_info' => $this->db->escape_like_str(0),
                'stud_edit_delete' => $this->db->escape_like_str(0),
                'stu_own_info' => $this->db->escape_like_str(1),
                'teacher_info' => $this->db->escape_like_str(1),
                'add_teacher' => $this->db->escape_like_str(0),
                'teacher_details' => $this->db->escape_like_str(0),
                'teacher_edit_delete' => $this->db->escape_like_str(0),
                'all_parents_info' => $this->db->escape_like_str(0),
                'own_parents_info' => $this->db->escape_like_str(1),
                'make_parents_id' => $this->db->escape_like_str(0),
                'parents_edit_dlete' => $this->db->escape_like_str(0),
                'add_new_class' => $this->db->escape_like_str(0),
                'all_class_info' => $this->db->escape_like_str(0),
                'class_details' => $this->db->escape_like_str(0),
                'class_delete' => $this->db->escape_like_str(0),
                'class_promotion' => $this->db->escape_like_str(0),
                'assin_optio_sub' => $this->db->escape_like_str(0),
                'add_class_routine' => $this->db->escape_like_str(0),
                'own_class_routine' => $this->db->escape_like_str(1),
                'all_class_routine' => $this->db->escape_like_str(0),
                'rutin_edit_delete' => $this->db->escape_like_str(0),
                'attendance_preview' => $this->db->escape_like_str(0),
                'take_studence_atten' => $this->db->escape_like_str(0),
                'edit_student_atten' => $this->db->escape_like_str(0),
                'add_employee' => $this->db->escape_like_str(0),
                'employee_list' => $this->db->escape_like_str(0),
                'employ_attendance' => $this->db->escape_like_str(0),
                'empl_atte_view' => $this->db->escape_like_str(0),
                'add_subject' => $this->db->escape_like_str(0),
                'all_subject' => $this->db->escape_like_str(1),
                'make_suggestion' => $this->db->escape_like_str(0),
                'all_suggestion' => $this->db->escape_like_str(0),
                'own_suggestion' => $this->db->escape_like_str(1),
                'add_exam_gread' => $this->db->escape_like_str(0),
                'exam_gread' => $this->db->escape_like_str(1),
                'add_exam_routin' => $this->db->escape_like_str(0),
                'all_exam_routine' => $this->db->escape_like_str(0),
                'own_exam_routine' => $this->db->escape_like_str(1),
                'exam_attend_preview' => $this->db->escape_like_str(0),
                'approve_result' => $this->db->escape_like_str(0),
                'view_result' => $this->db->escape_like_str(1),
                'all_mark_sheet' => $this->db->escape_like_str(0),
                'own_mark_sheet' => $this->db->escape_like_str(1),
                'take_exam_attend' => $this->db->escape_like_str(0),
                'change_exam_attendance' => $this->db->escape_like_str(0),
                'make_result' => $this->db->escape_like_str(0),
                'add_category' => $this->db->escape_like_str(0),
                'all_category' => $this->db->escape_like_str(1),
                'edit_delete_category' => $this->db->escape_like_str(0),
                'add_books' => $this->db->escape_like_str(0),
                'all_books' => $this->db->escape_like_str(1),
                'edit_delete_books' => $this->db->escape_like_str(0),
                'add_library_mem' => $this->db->escape_like_str(0),
                'memb_list' => $this->db->escape_like_str(0),
                'issu_return' => $this->db->escape_like_str(0),
                'add_dormitories' => $this->db->escape_like_str(0),
                'add_set_dormi' => $this->db->escape_like_str(0),
                'set_member_bed' => $this->db->escape_like_str(0),
                'dormi_report' => $this->db->escape_like_str(1),
                'add_transport' => $this->db->escape_like_str(0),
                'all_transport' => $this->db->escape_like_str(1),
                'transport_edit_dele' => $this->db->escape_like_str(0),
                'add_account_title' => $this->db->escape_like_str(0),
                'edit_dele_acco' => $this->db->escape_like_str(0),
                'trensection' => $this->db->escape_like_str(0),
                'fee_collection' => $this->db->escape_like_str(0),
                'all_slips' => $this->db->escape_like_str(0),
                'own_slip' => $this->db->escape_like_str(1),
                'slip_edit_delete' => $this->db->escape_like_str(0),
                'pay_salary' => $this->db->escape_like_str(0),
                'creat_notice' => $this->db->escape_like_str(0),
                'send_message' => $this->db->escape_like_str(0),
                'vendor' => $this->db->escape_like_str(0),
                'delet_vendor' => $this->db->escape_like_str(0),
                'add_inv_cat' => $this->db->escape_like_str(0),
                'inve_item' => $this->db->escape_like_str(0),
                'delete_inve_ite' => $this->db->escape_like_str(0),
                'delete_inv_cat' => $this->db->escape_like_str(0),
                'inve_issu' => $this->db->escape_like_str(0),
                'delete_inven_issu' => $this->db->escape_like_str(0),
                'check_leav_appli' => $this->db->escape_like_str(0),
                'setting_manage_user' => $this->db->escape_like_str(0),
                'setting_accounts' => $this->db->escape_like_str(0),
                'other_setting' => $this->db->escape_like_str(0),
                'front_setings' => $this->db->escape_like_str(1),
            );
            $this->db->where('group_id', 5);
            $this->db->update('role_based_access', $parents);

            $accountant = array(
                'das_top_info' => $this->db->escape_like_str(1),
                'das_grab_chart' => $this->db->escape_like_str(1),
                'das_class_info' => $this->db->escape_like_str(1),
                'das_message' => $this->db->escape_like_str(1),
                'das_employ_attend' => $this->db->escape_like_str(1),
                'das_notice' => $this->db->escape_like_str(1),
                'das_calender' => $this->db->escape_like_str(1),
                'admission' => $this->db->escape_like_str(1),
                'all_student_info' => $this->db->escape_like_str(1),
                'stud_edit_delete' => $this->db->escape_like_str(0),
                'stu_own_info' => $this->db->escape_like_str(0),
                'teacher_info' => $this->db->escape_like_str(0),
                'add_teacher' => $this->db->escape_like_str(0),
                'teacher_details' => $this->db->escape_like_str(0),
                'teacher_edit_delete' => $this->db->escape_like_str(0),
                'all_parents_info' => $this->db->escape_like_str(1),
                'own_parents_info' => $this->db->escape_like_str(0),
                'make_parents_id' => $this->db->escape_like_str(0),
                'parents_edit_dlete' => $this->db->escape_like_str(0),
                'add_new_class' => $this->db->escape_like_str(0),
                'all_class_info' => $this->db->escape_like_str(1),
                'class_details' => $this->db->escape_like_str(1),
                'class_delete' => $this->db->escape_like_str(0),
                'class_promotion' => $this->db->escape_like_str(0),
                'assin_optio_sub' => $this->db->escape_like_str(0),
                'add_class_routine' => $this->db->escape_like_str(0),
                'own_class_routine' => $this->db->escape_like_str(0),
                'all_class_routine' => $this->db->escape_like_str(1),
                'rutin_edit_delete' => $this->db->escape_like_str(0),
                'attendance_preview' => $this->db->escape_like_str(1),
                'take_studence_atten' => $this->db->escape_like_str(0),
                'edit_student_atten' => $this->db->escape_like_str(0),
                'add_employee' => $this->db->escape_like_str(0),
                'employee_list' => $this->db->escape_like_str(0),
                'employ_attendance' => $this->db->escape_like_str(0),
                'empl_atte_view' => $this->db->escape_like_str(0),
                'add_subject' => $this->db->escape_like_str(0),
                'all_subject' => $this->db->escape_like_str(1),
                'make_suggestion' => $this->db->escape_like_str(0),
                'all_suggestion' => $this->db->escape_like_str(1),
                'own_suggestion' => $this->db->escape_like_str(0),
                'add_exam_gread' => $this->db->escape_like_str(0),
                'exam_gread' => $this->db->escape_like_str(1),
                'add_exam_routin' => $this->db->escape_like_str(0),
                'all_exam_routine' => $this->db->escape_like_str(1),
                'own_exam_routine' => $this->db->escape_like_str(0),
                'exam_attend_preview' => $this->db->escape_like_str(1),
                'approve_result' => $this->db->escape_like_str(0),
                'view_result' => $this->db->escape_like_str(1),
                'all_mark_sheet' => $this->db->escape_like_str(1),
                'own_mark_sheet' => $this->db->escape_like_str(0),
                'take_exam_attend' => $this->db->escape_like_str(0),
                'change_exam_attendance' => $this->db->escape_like_str(0),
                'make_result' => $this->db->escape_like_str(0),
                'add_category' => $this->db->escape_like_str(0),
                'all_category' => $this->db->escape_like_str(1),
                'edit_delete_category' => $this->db->escape_like_str(0),
                'add_books' => $this->db->escape_like_str(0),
                'all_books' => $this->db->escape_like_str(1),
                'edit_delete_books' => $this->db->escape_like_str(0),
                'add_library_mem' => $this->db->escape_like_str(0),
                'memb_list' => $this->db->escape_like_str(0),
                'issu_return' => $this->db->escape_like_str(0),
                'add_dormitories' => $this->db->escape_like_str(0),
                'add_set_dormi' => $this->db->escape_like_str(0),
                'set_member_bed' => $this->db->escape_like_str(0),
                'dormi_report' => $this->db->escape_like_str(1),
                'add_transport' => $this->db->escape_like_str(0),
                'all_transport' => $this->db->escape_like_str(1),
                'transport_edit_dele' => $this->db->escape_like_str(0),
                'add_account_title' => $this->db->escape_like_str(1),
                'edit_dele_acco' => $this->db->escape_like_str(1),
                'trensection' => $this->db->escape_like_str(1),
                'fee_collection' => $this->db->escape_like_str(1),
                'all_slips' => $this->db->escape_like_str(1),
                'own_slip' => $this->db->escape_like_str(0),
                'slip_edit_delete' => $this->db->escape_like_str(1),
                'pay_salary' => $this->db->escape_like_str(1),
                'creat_notice' => $this->db->escape_like_str(0),
                'send_message' => $this->db->escape_like_str(1),
                'vendor' => $this->db->escape_like_str(0),
                'delet_vendor' => $this->db->escape_like_str(0),
                'add_inv_cat' => $this->db->escape_like_str(0),
                'inve_item' => $this->db->escape_like_str(0),
                'delete_inve_ite' => $this->db->escape_like_str(0),
                'delete_inv_cat' => $this->db->escape_like_str(0),
                'inve_issu' => $this->db->escape_like_str(0),
                'delete_inven_issu' => $this->db->escape_like_str(0),
                'check_leav_appli' => $this->db->escape_like_str(0),
                'setting_manage_user' => $this->db->escape_like_str(0),
                'setting_accounts' => $this->db->escape_like_str(1),
                'other_setting' => $this->db->escape_like_str(0),
                'front_setings' => $this->db->escape_like_str(1),
            );
            $this->db->where('group_id', 6);;
            $this->db->update('role_based_access', $accountant);
            $libraryman = array(
                'das_top_info' => $this->db->escape_like_str(1),
                'das_grab_chart' => $this->db->escape_like_str(0),
                'das_class_info' => $this->db->escape_like_str(0),
                'das_message' => $this->db->escape_like_str(1),
                'das_employ_attend' => $this->db->escape_like_str(0),
                'das_notice' => $this->db->escape_like_str(1),
                'das_calender' => $this->db->escape_like_str(1),
                'admission' => $this->db->escape_like_str(0),
                'all_student_info' => $this->db->escape_like_str(1),
                'stud_edit_delete' => $this->db->escape_like_str(0),
                'stu_own_info' => $this->db->escape_like_str(0),
                'teacher_info' => $this->db->escape_like_str(1),
                'add_teacher' => $this->db->escape_like_str(0),
                'teacher_details' => $this->db->escape_like_str(0),
                'teacher_edit_delete' => $this->db->escape_like_str(0),
                'all_parents_info' => $this->db->escape_like_str(1),
                'own_parents_info' => $this->db->escape_like_str(0),
                'make_parents_id' => $this->db->escape_like_str(0),
                'parents_edit_dlete' => $this->db->escape_like_str(0),
                'add_new_class' => $this->db->escape_like_str(0),
                'all_class_info' => $this->db->escape_like_str(1),
                'class_details' => $this->db->escape_like_str(1),
                'class_delete' => $this->db->escape_like_str(0),
                'class_promotion' => $this->db->escape_like_str(0),
                'assin_optio_sub' => $this->db->escape_like_str(0),
                'add_class_routine' => $this->db->escape_like_str(0),
                'own_class_routine' => $this->db->escape_like_str(0),
                'all_class_routine' => $this->db->escape_like_str(1),
                'rutin_edit_delete' => $this->db->escape_like_str(0),
                'attendance_preview' => $this->db->escape_like_str(1),
                'take_studence_atten' => $this->db->escape_like_str(0),
                'edit_student_atten' => $this->db->escape_like_str(0),
                'add_employee' => $this->db->escape_like_str(0),
                'employee_list' => $this->db->escape_like_str(0),
                'employ_attendance' => $this->db->escape_like_str(0),
                'empl_atte_view' => $this->db->escape_like_str(0),
                'add_subject' => $this->db->escape_like_str(0),
                'all_subject' => $this->db->escape_like_str(1),
                'make_suggestion' => $this->db->escape_like_str(0),
                'all_suggestion' => $this->db->escape_like_str(0),
                'own_suggestion' => $this->db->escape_like_str(0),
                'add_exam_gread' => $this->db->escape_like_str(0),
                'exam_gread' => $this->db->escape_like_str(0),
                'add_exam_routin' => $this->db->escape_like_str(0),
                'all_exam_routine' => $this->db->escape_like_str(1),
                'own_exam_routine' => $this->db->escape_like_str(0),
                'exam_attend_preview' => $this->db->escape_like_str(1),
                'approve_result' => $this->db->escape_like_str(0),
                'view_result' => $this->db->escape_like_str(1),
                'all_mark_sheet' => $this->db->escape_like_str(0),
                'own_mark_sheet' => $this->db->escape_like_str(0),
                'take_exam_attend' => $this->db->escape_like_str(0),
                'change_exam_attendance' => $this->db->escape_like_str(0),
                'make_result' => $this->db->escape_like_str(0),
                'add_category' => $this->db->escape_like_str(1),
                'all_category' => $this->db->escape_like_str(1),
                'edit_delete_category' => $this->db->escape_like_str(1),
                'add_books' => $this->db->escape_like_str(1),
                'all_books' => $this->db->escape_like_str(1),
                'edit_delete_books' => $this->db->escape_like_str(1),
                'add_library_mem' => $this->db->escape_like_str(1),
                'memb_list' => $this->db->escape_like_str(1),
                'issu_return' => $this->db->escape_like_str(1),
                'add_dormitories' => $this->db->escape_like_str(0),
                'add_set_dormi' => $this->db->escape_like_str(0),
                'set_member_bed' => $this->db->escape_like_str(0),
                'dormi_report' => $this->db->escape_like_str(1),
                'add_transport' => $this->db->escape_like_str(0),
                'all_transport' => $this->db->escape_like_str(1),
                'transport_edit_dele' => $this->db->escape_like_str(0),
                'add_account_title' => $this->db->escape_like_str(0),
                'edit_dele_acco' => $this->db->escape_like_str(0),
                'trensection' => $this->db->escape_like_str(0),
                'fee_collection' => $this->db->escape_like_str(0),
                'all_slips' => $this->db->escape_like_str(0),
                'own_slip' => $this->db->escape_like_str(0),
                'slip_edit_delete' => $this->db->escape_like_str(0),
                'pay_salary' => $this->db->escape_like_str(0),
                'creat_notice' => $this->db->escape_like_str(0),
                'send_message' => $this->db->escape_like_str(1),
                'vendor' => $this->db->escape_like_str(0),
                'delet_vendor' => $this->db->escape_like_str(0),
                'add_inv_cat' => $this->db->escape_like_str(0),
                'inve_item' => $this->db->escape_like_str(0),
                'delete_inve_ite' => $this->db->escape_like_str(0),
                'delete_inv_cat' => $this->db->escape_like_str(0),
                'inve_issu' => $this->db->escape_like_str(0),
                'delete_inven_issu' => $this->db->escape_like_str(0),
                'check_leav_appli' => $this->db->escape_like_str(0),
                'setting_manage_user' => $this->db->escape_like_str(0),
                'setting_accounts' => $this->db->escape_like_str(0),
                'other_setting' => $this->db->escape_like_str(0),
                'front_setings' => $this->db->escape_like_str(0),
            );
            $this->db->where('group_id', 7);;
            $this->db->update('role_based_access', $libraryman);

            $class_employ = array(
                'das_top_info' => $this->db->escape_like_str(1),
                'das_grab_chart' => $this->db->escape_like_str(0),
                'das_class_info' => $this->db->escape_like_str(0),
                'das_message' => $this->db->escape_like_str(1),
                'das_employ_attend' => $this->db->escape_like_str(0),
                'das_notice' => $this->db->escape_like_str(1),
                'das_calender' => $this->db->escape_like_str(1),
                'admission' => $this->db->escape_like_str(0),
                'all_student_info' => $this->db->escape_like_str(0),
                'stud_edit_delete' => $this->db->escape_like_str(0),
                'stu_own_info' => $this->db->escape_like_str(0),
                'teacher_info' => $this->db->escape_like_str(1),
                'add_teacher' => $this->db->escape_like_str(0),
                'teacher_details' => $this->db->escape_like_str(0),
                'teacher_edit_delete' => $this->db->escape_like_str(0),
                'all_parents_info' => $this->db->escape_like_str(1),
                'own_parents_info' => $this->db->escape_like_str(0),
                'make_parents_id' => $this->db->escape_like_str(0),
                'parents_edit_dlete' => $this->db->escape_like_str(0),
                'add_new_class' => $this->db->escape_like_str(0),
                'all_class_info' => $this->db->escape_like_str(0),
                'class_details' => $this->db->escape_like_str(0),
                'class_delete' => $this->db->escape_like_str(0),
                'class_promotion' => $this->db->escape_like_str(0),
                'assin_optio_sub' => $this->db->escape_like_str(0),
                'add_class_routine' => $this->db->escape_like_str(0),
                'own_class_routine' => $this->db->escape_like_str(0),
                'all_class_routine' => $this->db->escape_like_str(1),
                'rutin_edit_delete' => $this->db->escape_like_str(0),
                'attendance_preview' => $this->db->escape_like_str(0),
                'take_studence_atten' => $this->db->escape_like_str(0),
                'edit_student_atten' => $this->db->escape_like_str(0),
                'add_employee' => $this->db->escape_like_str(0),
                'employee_list' => $this->db->escape_like_str(0),
                'employ_attendance' => $this->db->escape_like_str(0),
                'empl_atte_view' => $this->db->escape_like_str(0),
                'add_subject' => $this->db->escape_like_str(0),
                'all_subject' => $this->db->escape_like_str(1),
                'make_suggestion' => $this->db->escape_like_str(0),
                'all_suggestion' => $this->db->escape_like_str(0),
                'own_suggestion' => $this->db->escape_like_str(0),
                'add_exam_gread' => $this->db->escape_like_str(0),
                'exam_gread' => $this->db->escape_like_str(0),
                'add_exam_routin' => $this->db->escape_like_str(0),
                'all_exam_routine' => $this->db->escape_like_str(1),
                'own_exam_routine' => $this->db->escape_like_str(0),
                'exam_attend_preview' => $this->db->escape_like_str(0),
                'approve_result' => $this->db->escape_like_str(0),
                'view_result' => $this->db->escape_like_str(1),
                'all_mark_sheet' => $this->db->escape_like_str(0),
                'own_mark_sheet' => $this->db->escape_like_str(0),
                'take_exam_attend' => $this->db->escape_like_str(0),
                'change_exam_attendance' => $this->db->escape_like_str(0),
                'make_result' => $this->db->escape_like_str(0),
                'add_category' => $this->db->escape_like_str(0),
                'all_category' => $this->db->escape_like_str(1),
                'edit_delete_category' => $this->db->escape_like_str(0),
                'add_books' => $this->db->escape_like_str(0),
                'all_books' => $this->db->escape_like_str(1),
                'edit_delete_books' => $this->db->escape_like_str(0),
                'add_library_mem' => $this->db->escape_like_str(0),
                'memb_list' => $this->db->escape_like_str(0),
                'issu_return' => $this->db->escape_like_str(0),
                'add_dormitories' => $this->db->escape_like_str(0),
                'add_set_dormi' => $this->db->escape_like_str(0),
                'set_member_bed' => $this->db->escape_like_str(0),
                'dormi_report' => $this->db->escape_like_str(1),
                'add_transport' => $this->db->escape_like_str(0),
                'all_transport' => $this->db->escape_like_str(1),
                'transport_edit_dele' => $this->db->escape_like_str(0),
                'add_account_title' => $this->db->escape_like_str(0),
                'edit_dele_acco' => $this->db->escape_like_str(0),
                'trensection' => $this->db->escape_like_str(0),
                'fee_collection' => $this->db->escape_like_str(0),
                'all_slips' => $this->db->escape_like_str(0),
                'own_slip' => $this->db->escape_like_str(0),
                'slip_edit_delete' => $this->db->escape_like_str(0),
                'pay_salary' => $this->db->escape_like_str(0),
                'creat_notice' => $this->db->escape_like_str(0),
                'send_message' => $this->db->escape_like_str(0),
                'vendor' => $this->db->escape_like_str(0),
                'delet_vendor' => $this->db->escape_like_str(0),
                'add_inv_cat' => $this->db->escape_like_str(0),
                'inve_item' => $this->db->escape_like_str(0),
                'delete_inve_ite' => $this->db->escape_like_str(0),
                'delete_inv_cat' => $this->db->escape_like_str(0),
                'inve_issu' => $this->db->escape_like_str(0),
                'delete_inven_issu' => $this->db->escape_like_str(0),
                'check_leav_appli' => $this->db->escape_like_str(0),
                'setting_manage_user' => $this->db->escape_like_str(0),
                'setting_accounts' => $this->db->escape_like_str(0),
                'other_setting' => $this->db->escape_like_str(0),
                'front_setings' => $this->db->escape_like_str(0),
            );
            $this->db->where('group_id', 8);;
            if ($this->db->update('role_based_access', $class_employ)) {
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                                            <strong>' . lang('success') . '</strong> ' . lang('conc_7') . '
                                    </div>';
                $this->load->view('temp/header');
                $this->load->view('userRoleSetup', $data);
                $this->load->view('temp/footer');
            }
        }

        //This function will set employe attendance secourity pass
        public function att_pass()
        {
            if ($this->input->post('submit', TRUE)) {
                $pass = $this->input->post('password', TRUE);
                $con = $this->input->post('password_confirm', TRUE);
                if ($pass == $con) {
                    $info = array(
                        't_a_s_p' => $this->db->escape_like_str($con),
                    );
                    $this->db->where('id', '0');
                    if ($this->db->update('configuration', $info)) {
                        $data['message'] = '<div class="col-md-12"> <br><div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
								<strong>' . lang('success') . '</strong> ' . lang('con_easpsucc_1') . '</div></div>';
                        $this->load->view('temp/header');
                        $this->load->view('emp_att_pass', $data);
                        $this->load->view('temp/footer');
                    }
                } else {
                    $data['message'] = '<div class="col-md-12"> <br><div class="alert alert-danger alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
								<strong>' . lang('error') . '</strong> ' . lang('con_easpm') . '</div></div>';
                    $this->load->view('temp/header');
                    $this->load->view('emp_att_pass', $data);
                    $this->load->view('temp/footer');
                }
            } else {
                $this->load->view('temp/header');
                $this->load->view('emp_att_pass');
                $this->load->view('temp/footer');
            }
        }
    }
