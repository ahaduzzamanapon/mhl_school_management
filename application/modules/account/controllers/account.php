<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Account extends MX_Controller {
    /**
     * This controller is using for controlling account and tranjection
     * Maps to the following URL
     * 		http://example.com/index.php/account
     * 	- or -  
     * 		http://example.com/index.php/account/<method_name>
     */
    function __construct() {
        parent::__construct();
        $this->load->model('accountmodel');
        $this->load->library('form_validation');
        ini_set("date.timezone", "Asia/Dhaka");
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
    

    //This function is adding now account title
    public function addAccountTitle() {
        if ($this->input->post('submit', TRUE)) {
            $accuntInfo = array(
                'account_title' => $this->db->escape_like_str($this->input->post('accountTitle', TRUE)),
                'category' => $this->db->escape_like_str($this->input->post('type', TRUE)),
                'description' => $this->db->escape_like_str($this->input->post('description', TRUE))
                );
            if ($this->db->insert('account_title', $accuntInfo)) {
                $data['allAccount'] = $this->common->getAllData('account_title');
                $data['message'] = '<div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>Success ! </strong> Account title added successfully. 
            </div>';
            $this->load->view('temp/header');
            $this->load->view('addAccountTitle', $data);
            $this->load->view('temp/footer');
        }
    } else {
        $data['allAccount'] = $this->common->getAllData('account_title');
        $this->load->view('temp/header');
        $this->load->view('addAccountTitle', $data);
        $this->load->view('temp/footer');
    }
}



// show all uewr account this function is using

public function allAccountUser() {
    
    $data['accountUser'] =  $this->accountmodel->allAccountUser();
    $this->load->view('temp/header');
    $this->load->view('allAccountUser', $data);
    $this->load->view('temp/footer');
}

// show details Account section user this function is using
public function accountUserDetails() {
    $id = $this->input->get('id');
    $userId = $this->input->get('uid');
    $data['account'] = $this->common->getWhere('account_info', 'id', $id);
    $data['user'] = $this->common->getWhere('users', 'id', $userId);
    $this->load->view('temp/header');
    $this->load->view('details_user_account', $data);
    $this->load->view('temp/footer');
}

// delete user account this function is using
public function accountUserDelete() {
    $teacherId = $this->input->get('id');
    $userId = $this->input->get('uid');
    $this->db->delete('account_info', array('id' => $teacherId));
    $this->db->delete('users', array('id' => $userId));
    redirect('account/allAccountUser', 'refresh');
}

    //This function is using for show all account title view
public function allAccount() {
    $this->load->view('temp/header');
    $this->load->view('allAccount', $data);
    $this->load->view('temp/footer');
}

    //This function will edit Account title information here.
public function editAccountInfo() {
    $id = $this->input->get('id', TRUE);
    if ($this->input->post('submit', TRUE)) {
        $accuntInfo = array(
            'account_title' => $this->db->escape_like_str($this->input->post('accountTitle', TRUE)),
            'category' => $this->db->escape_like_str($this->input->post('type', TRUE)),
            'description' => $this->db->escape_like_str($this->input->post('description', TRUE))
            );
        $this->db->where('id', $id);
        if ($this->db->update('account_title', $accuntInfo)) {
            $data['allAccount'] = $this->common->getAllData('account_title');
            $data['message'] = '<div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Success ! </strong>  Account title\'s information updated successfully. 
        </div>';
        $this->load->view('temp/header');
        $this->load->view('addAccountTitle', $data);
        $this->load->view('temp/footer');
    }
} else {
    $data['accountInfo'] = $this->common->getWhere('account_title', 'id', $id);
    $this->load->view('temp/header');
    $this->load->view('editAccount', $data);
    $this->load->view('temp/footer');
}
}

    //This function will delete Account Title.
public function deleteAccount() {
    $id = $this->input->get('id', TRUE);
    $this->db->delete('account_title', array('id' => $id));
        //After deleteing the account lode all Account info.
    $data['allAccount'] = $this->common->getAllData('account_title');
    $data['message'] = '<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Success ! </strong>  Account title deleted successfully. 
</div>';
$this->load->view('temp/header');
$this->load->view('addAccountTitle', $data);
$this->load->view('temp/footer');
}

    //This function will show students own due and pay
public function due_pay() {
    $user = $this->ion_auth->user()->row();
    $user_id = $user->id;
    $student_id = $this->common->student_id($user_id);
    $data['slips'] = $this->accountmodel->own_slips($student_id);
    $this->load->view('temp/header');
    $this->load->view('due_pay', $data);
    $this->load->view('temp/footer');
}

    //This function will load all students trangections slips
public function allSlips() {
    $data['slips'] = $this->accountmodel->stud_payment();
    $this->load->view('temp/header');
    $this->load->view('allSlips', $data);
    $this->load->view('temp/footer');
}
    /* public function student()
    {
        $Class_id = $this->input->get('q', TRUE);
        $feeItem = $this->common->getWhere('fee_item', 'class_id', $Class_id);
        $studentInfo = $this->common->getWhere('student_info', 'class_id', $Class_id);
        echo json_encode(array('studentInfo'=>$studentInfo));
     
    }*/
    public function student()
    {
        $Class_id = $this->input->get('q', TRUE);
        $Class_id = explode('-', $Class_id);
        $Class_id = $Class_id[0];
        $feeItem = $this->common->getWhere('fee_item', 'class_id', $Class_id);
        $studentInfo = $this->common->getWhere('student_info', 'class_id', $Class_id);

        echo '<div class="form-group">
        <label class="col-md-3 control-label">Student Id <span class="requiredStar"> * </span></label>
        <div class="col-md-6">
            <select name="studentId" id="studentId" class="form-control">
                <option value="">Select one</option>';
                foreach ($studentInfo as $studentId) 
                {
                    echo '<option value="' . $studentId['student_id'] . '">' . $studentId['student_id'].'  ( '.$studentId['roll_number'].' - '.$studentId['student_nam']. ' )</option>';
                }
            echo '</select></div>
        </div>';
    }

    public function student_list()
    {
        $Class_id = $this->input->get('q', TRUE);        
        $studentInfo = $this->common->getWhere('student_info', 'class_id', $Class_id);

        echo '<select name="studentId" id="studentId">
                <option value="">Select Student</option>';
                foreach ($studentInfo as $studentId) 
                {
                    echo '<option value="' . $studentId['student_id'] . '">' . $studentId['student_id'].'  ( '.$studentId['roll_number'].' - '.$studentId['student_nam']. ' )</option>';
                }
        echo '</select>';
        echo '<input type="submit" name="sumbit" value="Search">';
    }

    /*public function SearchStudentPayment()
    {
        $classId = '';
        $studentId = '';
        $startDate = '';
        $endDate = '';
        $item = '';
        if (isset($_POST['search'])) {
            if (isset($_POST['class_id']) && $_POST['class_id']) {
                $classId = $this->input->post('class_id');
            }
            if (isset($_POST['studentId']) && $_POST['studentId']) {
                $studentId = $this->input->post('studentId');
            }
            if (isset($_POST['item']) && $_POST['item']) {
                $item = $this->input->post('item');
            }
            if (isset($_POST['startDate']) && $_POST['startDate']) {
                $date = $this->input->post('startDate');
                $fromFormat = 'd-m-Y';
                $toFormat = 'Y-m-d';
                $startDate = $this->GetDateInGivenFormat($fromFormat,$toFormat,$date);
            }
            if (isset($_POST['endDate']) && $_POST['endDate']) {
                $date = $this->input->post('endDate');
                $fromFormat = 'd-m-Y';
                $toFormat = 'Y-m-d';
                $endDate = $this->GetDateInGivenFormat($fromFormat,$toFormat,$date);
            }
            

            $data['fees'] = $this->accountmodel->StudentFees($classId,$studentId,$startDate,$endDate,$item);
            $data['s_class'] = $this->common->getAllData('class');
            $data['fee_item'] = $this->common->getAllData('fee_item');

            $data['classId'] = $this->common->getAllData('classId');
            $data['studentId'] = $this->common->getAllData('studentId');
            $data['startDate'] = $this->common->getAllData('startDate');
            $data['endDate'] = $this->common->getAllData('endDate');

            $this->load->view('temp/header');
            $this->load->view('view_payment', $data);
            $this->load->view('temp/footer');
        }
        
    }*/
    public function ViewPayment()
    {        
        $data['invoice'] = $this->accountmodel->student_invoice();
        // print_r($data['fees']); exit;
        $data['s_class'] = $this->common->getAllData('class');
        $data['studentInfo'] = $this->common->getAllData('student_info');
        $data['fee_item'] = $this->common->getAllData('fee_item');

    
        $this->load->view('temp/header');
        $this->load->view('view_payment', $data);
        $this->load->view('temp/footer');
    }

    public function DuePayment()
    {        
        // print_r($data['fees']); exit;
        $data['s_class'] = $this->common->getAllData('class');
        // $data['fee_item'] = $this->common->getAllData('fee_item');
        $data['invoice']='';
        
        if($this->input->get('sumbit') == 'Search'){
            //print_r($this->feeInfo()); 
            $data['results'] = $this->accountmodel->get_fee_item($this->input->get('class'), $this->input->get('studentId'));
            //$data['invoice'] = $this->accountmodel->student_due_search(); //exit;
        }
        $this->load->view('temp/header');
        $this->load->view('due_payment', $data);
        $this->load->view('temp/footer');
    }

    public function PaymentTransaction()
    {        
        // print_r($data['fees']); exit;
        //$data['s_class'] = $this->common->getAllData('class');
        // $data['fee_item'] = $this->common->getAllData('fee_item');
        //$data['invoice']='';
        
            //$data['invoice'] = $this->accountmodel->student_due_search(); //exit;
        //}
    
        $data['results'] = $this->accountmodel->get_payment_transaction();

        $this->load->view('temp/header');
        $this->load->view('payment_transaction', $data);
        $this->load->view('temp/footer');
    } 

    public function TransectionHistory()
    {            
        // $data['results'] = $this->accountmodel->get_payment_transaction();
        $data['s_class'] = $this->common->getAllData('class');
        $data['studentInfo'] = $this->common->getAllData('student_info');
        $data['feeInfo'] = $this->common->getAllData('fee_type');

        if($this->input->get('sumbit') == 'Search'){
            // echo "Search";
            // exit;
            //print_r($this->feeInfo()); 
            $class=$this->input->get('class');
            $stu_id=$this->input->get('studentId');
            $feeId=$this->input->get('feeId');
            $from_date=$this->input->get('from_date');
            $to_date=$this->input->get('to_date');
// echo $class.'-'.$stu_id.'-'.$feeId.'-'.$from_date.'-'.$to_date;exit;
            $data['results'] = $this->accountmodel->get_transection_history($class,$stu_id,$feeId,$from_date,$to_date);
            //$data['invoice'] = $this->accountmodel->student_due_search(); //exit;
            $data['class']=$class;
            $data['stu_id']=$stu_id;
            $data['feeId']=$feeId;
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;
            
            // echo "<pre>"; print_r($data);exit;
        }
        else if($this->input->get('sumbit') == 'Fees Summary'){
            $from_date=$this->input->get('from_date');
            $to_date=$this->input->get('to_date');
            $data['results'] = $this->accountmodel->get_transection_fees_summary($from_date,$to_date);
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;
        }
        else if($this->input->get('sumbit') == 'Class Summary'){
            // echo "Class Summary";
            // exit;
            // $class=$this->input->get('class');
            $from_date=$this->input->get('from_date');
            $to_date=$this->input->get('to_date');
            $data['results'] = $this->accountmodel->get_transection_class_summary($from_date,$to_date);
            // $data['class']=$class;
            // $data['stu_id']=$stu_id;
            // $data['feeId']=$feeId;
            $data['from_date']=$from_date;
            $data['to_date']=$to_date;
        }

        $this->load->view('temp/header');
        $this->load->view('transection_history', $data);
        $this->load->view('temp/footer');
    }

    public function invoice_details($id){
        $data['page_title'] = 'Invoice Details';

        $id = (int) $id;
        $data['invoice'] = $this->accountmodel->invoice_details($id);

        // print_r($data['invoice']);exit;

        $this->load->view('temp/header');
        $this->load->view('invoice_details', $data);
        $this->load->view('temp/footer');
    }

    public function ViewStorePayment()
    {        
        $data['invoice'] = $this->accountmodel->student_store_invoice();
        // print_r($data['fees']); exit;
        $data['s_class'] = $this->common->getAllData('class');
        $data['fee_item'] = $this->common->getAllData('fee_item');
    
        $this->load->view('temp/header');
        $this->load->view('view_store_payment', $data);
        $this->load->view('temp/footer');
    }

    public function store_invoice_details($id){
        $data['page_title'] = 'Store Invoice Details';

        $id = (int) $id;
        $data['invoice'] = $this->accountmodel->store_invoice_details($id);

        // print_r($data['invoice']);exit;

        $this->load->view('temp/header');
        $this->load->view('store_invoice_details', $data);
        $this->load->view('temp/footer');
    }

    /*public function MoneyReceipt() {
        $data['slips'] = $this->accountmodel->stud_payment();
        $data['s_class'] = $this->common->getAllData('class');
        $data['fee_item'] = $this->common->getAllData('fee_item');
        $this->load->view('temp/header');
        $this->load->view('money_receipt', $data);
        $this->load->view('temp/footer');
    }*/

    public function get_student_fees() {
        $classId = $_GET['classId'];
        // result query
        $this->db->select('fi.*, ft.fee_title, ft.pay_type');
        $this->db->from('fee_item fi');
        $this->db->join('fee_type ft', 'fi.fee_type_id=ft.id', 'LEFT');
        $this->db->where('class_id', $classId);
        $query = $this->db->get()->result_array();

        $item = json_encode(array('feeItem' =>$query));

        echo $item;
    }

    public function feeInfo(){
        $classId = $_GET['classId'];
        $feeItem = $this->common->getWhere('fee_item', 'class_id', $classId);
        $item = json_encode(array('feeItem' =>$feeItem));

        echo $item;
    }

    function student_id()
    {
        $Class_id = $this->input->get('q', TRUE);
        // print_r($Class_id);exit;
        $feeItem = $this->common->getWhere('fee_item', 'class_id', $Class_id);
       
        //echo $this->db->last_query(); //exit;
        $query = $this->common->GetAll('student_info', 'class_id', $Class_id,'roll_number');
        //echo "<pre>"; 
        //print_r($query);
        //echo  $this->db->last_query();

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
                    <label class="control-label">Payment Date <span class="requiredStar"> * </span></label>
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

            echo '<div class="row"> 
            <div class="col-md-2 col-md-offset-1"><label >Pay For<span class="requiredStar"> * </span></label></div>
            <div class="col-md-1"><label class=""><span >Desc. </span></label></div>
            <div class="col-md-1"><label class=""><span > Unit </span></label></div>
            <div class="col-md-1"><label class=""><span > Scholarship </span></label></div>
            <div class="col-md-1"><label class=""><span >From </span></label></div>
            <div class="col-md-1"><label class=""><span >To Date</span></label></div>
            <div class="col-md-1"><label class=" "><span >Quantity</span></label></div>
            <div class="col-md-1"><label class=" "><span>Total</span></label></div>
            <div class="col-md-1"><label class=""><span >Comment</span></label></div>
        </div>';

        echo '<div id="fieldList"><div class="form-group" style="margin-bottom: 0px;">';

        echo  '<div class="col-md-2 col-md-offset-1">
        <select style="height: 24px;width: 181px;" name="item[]" id="item" onchange="payItem(this.value)" class="">
            <option value="">Select one</option>';
            foreach ($feeItem as $item) {
              echo '<option value="'.$item['id']."-".$item['amount']."-".$item['fee_type_id'].'">'.$this->common->fee_type_title($item['fee_type_id'])."-".$item['amount'].'</option>';
          }
          echo '</select>
        </div>';
        echo '<div class="col-md-1">            
              <input type="text" class="pay_desc" name="desc[]" id="desc" value="" />
          </div>';
        echo '<div class="col-md-1">            
              <input type="text" name="amount[]" id="amount" value="" />
          </div>';

        echo '<div class="col-md-1">            
              <input type="text" name="scholar_amt[]" id="scholarship" value="" />
          </div>';

        echo '<div class="col-md-1">
                <select name="from_date[]" onchange="b_month(this.value)" id="f_d" style="height:24px; width: 90px;">
                    <option value="">--Select--</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">Septembore</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select></div>';

        echo '<div class="col-md-1">
                <select name="to_date[]" onchange="b_month(this.value)" id="t_d" style="height:24px; width: 90px;">
                    <option value="">--Select--</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">Septembore</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>';

        echo '<div class="col-md-1">                
          <input type="text" onchange="quantity_fn(this.value)" name="quantity[]" id="quantity" value="1">
        </div>';

        echo '<div class="col-md-1">                
        <input type="text" name="total[]" id="total">
        </div>';
        
        echo '<div class="col-md-1">
        <input type="text" name="comment[]" id="comment" size="15" value="">
        </div>';        
        
        echo '</div>';
}

function store_student_id()
    {
        $Class_id = $this->input->get('q', TRUE);
        $feeItem = $this->common->getWhere('fee_item', 'class_id', $Class_id);
        //echo $this->db->last_query(); //exit;
        $query = $this->common->GetAll('student_info', 'class_id', $Class_id,'roll_number');
        $items = $this->common->get_item_sale_yes();

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
                    <label class="control-label">Payment Date <span class="requiredStar"> * </span></label>
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

            echo '<div class="row"> 
            <div class="col-md-2 col-md-offset-2"><label >Item Name<span class="requiredStar"> * </span></label></div>
            <div class="col-md-1"><label class=""><span > Unit </span></label></div>
            <div class="col-md-1"><label class=" "><span >Quantity</span></label></div>
            <div class="col-md-1"><label class=" "><span>Total</span></label></div>
            <div class="col-md-2"><label class=""><span >Comment</span></label></div>
        </div>';

        echo '<div id="fieldList"><div class="form-group">';

        echo  '<div class="col-md-2 col-md-offset-2">
        <select name="item[]" id="item" onchange="payItem(this.value)" class="">
            <option value="">Select one</option>';
            foreach ($items as $item) {
                echo '<option value="'.$item['id']."-".$item['item_retail']."-".$item['item_name'].'">'.$item['item_name'].'</option>';
            }
          echo '</select>
        </div>';
        echo '<div class="col-md-1">            
              <input type="text" name="amount[]" id="amount" value="" />
          </div>';

        echo '<div class="col-md-1">                
          <input type="text" onchange="quantity_fn(this.value)" name="quantity[]" id="quantity" value="1">
        </div>';

        echo '<div class="col-md-1">                
        <input type="text" name="total[]" id="total"  readonly>
        </div>';
        
        echo '<div class="col-md-1">
        <input type="text" name="comment[]" id="comment" size="15" value="">
        </div>';        
        
        echo '</div>';
}

    public function item_sale_yes() {
        $this->db->where('item_is_sale', 'Yes');
        $query = $this->db->get('inventory_item')->result_array();

        $item = json_encode(array('feeItem' =>$query));
// echo '<pre>';
        echo $item;
    }

public function studentInfoById() 
{
    $scholarship_amt=0;
    $studentId = $this->input->get('q', TRUE);
    $query = $this->common->stuInfoId($studentId);
    $transport = $this->common->getTransport($studentId);
    $scholarship_amt = $this->common->stuScholarship($studentId);
    $last_pay_date = $this->common->stuLastpay_date($studentId);

    if (empty($query)) {
        echo '<div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
            <div class="alert alert-danger">
                <strong>Info:</strong> This student ID <strong>' . $studentId . '</strong> is not matching in our student\'s list.
            </div></div></div>';
        } else {
            echo 'Image <br><div class="col-md-4 stuInfoIdBox" style="margin-bottom: 0px;">   
            <img src="assets/uploads/' . $query->student_photo . '" class="img-responsive" alt=""><br>
            </div>';
            echo '<div class="col-md-12" style="color:red"> Last Pay: '.$last_pay_date.'</div>';

            echo '<div class="col-md-12" style="color:red"> Scholarship: '.$scholarship_amt.'</div>
            <input type="hidden" name="hide_scholarship" id="hide_scholarship" value="'.$scholarship_amt.'">';
            
            echo '<div class="col-md-12" style="color:red"> Transport: '.$transport['trout'].'-'.$transport['tamount'].'</div>
            <input type="hidden" name="hide_transport" id="hide_transport" value="'.$transport['tamount'].'">';
    }
}


     //This function will load single students payment history
public function studentPaymentHistory() {
    $studentId = $this->input->get('stuid', TRUE);
    $data['stuPaymentData'] = $this->accountmodel->get_student_payment_history($studentId);
    $this->load->view('temp/header');
    $this->load->view('studentPaymentHistory', $data);
    $this->load->view('temp/footer');
}

    //Show invioce or students tranjection slips details
public function view_invoice() {
    $slipId = $this->input->get('sid', TRUE);
    $data['invoice'] = $this->accountmodel->invoice($slipId);
    $data['schoolName'] = $this->common->schoolName();
    $data['currency'] = $this->common->currencyClass();
    $this->load->view('temp/header');
    $this->load->view('invoice', $data);
    $this->load->view('temp/footer');
}
public function delete()
{
    $slipId = $this->input->get('sid', TRUE);
    $this->db->query("DELETE FROM student_fee WHERE Id='$slipId'");
    $data['fees'] = $this->accountmodel->StudentFees();
    $data['s_class'] = $this->common->getAllData('class');
    $data['fee_item'] = $this->common->getAllData('fee_item');

    $data['classId']    = '';
    $data['studentId']  = '';
    $data['item']  = '';
    $data['from']  = '';
    $data['to']    = '';

    $this->load->view('temp/header');
    $this->load->view('view_payment', $data);
    $this->load->view('temp/footer');
}

    //This function will pay students fees
public function fee_pay() {
    if ($this->input->post('submit', TRUE)) {
            $sid = $this->input->get('sid'); //exit; 
            //$sid = 1;
            $total = $this->input->post('total', TRUE);
            $totalPlusFine = $this->input->post('total', TRUE) + $this->input->post('fine', TRUE);
            $fine = $this->input->post('fine', TRUE);
            $paid = $this->input->post('paid', TRUE) + $this->input->post('current_payment', TRUE);
            if ($paid > $totalPlusFine || $paid == $totalPlusFine) {
                $due = 0;
                $balance = $paid - $totalPlusFine;
                $status = 'Paid';
                //echo 'a';
            } elseif ($paid < $totalPlusFine) {
                $balance = 0;
                $due = $totalPlusFine - $paid;
                $status = 'Not Clear';
                //echo 'b';
            }
            $slip_data = array(
                'dues' => $this->db->escape_like_str($due),
                'total' => $this->db->escape_like_str($total),
                'paid' => $this->db->escape_like_str($paid),
                'fine' => $this->db->escape_like_str($fine),
                'balance' => $this->db->escape_like_str($balance),
                'status' => $this->db->escape_like_str($status),
                'mathod' => $this->db->escape_like_str($this->input->post('method', TRUE)),
                );
            //echo $sid; exit; 
            $this->db->where('id', $sid);
            if ($this->db->update('slip', $slip_data)) {


                $paymentInfo = array(
                    'student_id' => $this->input->post('student_id', TRUE),
                    'paid_amount' => $this->input->post('current_payment', TRUE)
                    );
                $this->db->insert('student_payment_history', $paymentInfo);


                $data['message'] = '<div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>WOW!</strong> Your transaction was successfully processed.
            </div>';
            $data['slips'] = $this->accountmodel->stud_payment();
            $this->load->view('temp/header');
            $this->load->view('allSlips', $data);
            $this->load->view('temp/footer');
        }
    } else {
        $sid = $this->input->get('sid');
            //$sid = 1;
        $data['paymentData'] = $this->accountmodel->get_payment_info($sid);
            // echo '<pre>';
            // print_r($data['paymentData']); exit; 
        $data['slip_id'] = $sid;
        $this->load->view('temp/header');
        $this->load->view('fee_pay', $data);
        $this->load->view('temp/footer');
    }
}

    //This function will edit student payment information
public function edit_fee_pay() {
    if ($this->input->post('submit', TRUE)) {
        $sid = $this->input->get('sid');
        $amount = $this->input->post('amount', TRUE);
        $totalPlusFine = $this->input->post('amount', TRUE) + $this->input->post('fine', TRUE);
        $fine = $this->input->post('fine', TRUE);
        $paid = $this->input->post('paid', TRUE) + $this->input->post('current_payment', TRUE);
        if ($paid > $totalPlusFine || $paid == $totalPlusFine) {
            $due = 0;
                //$balance = $paid - $totalPlusFine;
            $status = 'Paid';
                //echo 'a';
        } elseif ($paid < $totalPlusFine) {
                //$balance = 0;
            $due = $totalPlusFine - $paid;
            $status = 'Pending';
                //echo 'b';
        }
        $slip_data = array(
            'due' => $this->db->escape_like_str($due),
            'total' => $this->db->escape_like_str($totalPlusFine),
            'payment' => $this->db->escape_like_str($paid),
            'fine' => $this->db->escape_like_str($fine),
            'amount' => $this->db->escape_like_str($amount),
            'status' => $this->db->escape_like_str($status)
                //'mathod' => $this->db->escape_like_str($this->input->post('method', TRUE)),
            );
        $this->db->where('id', $sid);
        if ($this->db->update('student_fee', $slip_data)) {

            $paymentInfo = array(
                'student_id' => $this->input->post('student_id', TRUE),
                'paid_amount' => $this->input->post('current_payment', TRUE)
                );
            $this->db->insert('student_payment_history', $paymentInfo);


            $data['message'] = '<div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>WOW!</strong> Your transaction was successfully processed.
        </div>';
        $data['slips'] = $this->accountmodel->stud_payment();


        $data['fees'] = $this->accountmodel->StudentFees();
        $data['s_class'] = $this->common->getAllData('class');
        $data['fee_item'] = $this->common->getAllData('fee_item');

        $data['classId']    = '';
        $data['studentId']  = '';
        $data['item']  = '';
        $data['from']  = '';
        $data['to']    = '';

        $this->load->view('temp/header');
        $this->load->view('view_payment', $data);
        $this->load->view('temp/footer');
    }
} else {
    $sid = $this->input->get('sid');
    $data['paid_amount'] = $this->accountmodel->paid_amount($sid);
    $data['paymentData'] = $this->accountmodel->get_payment_info($sid);
    $data['slip_id'] = $sid;
    $this->load->view('temp/header');
    $this->load->view('edit_fee_pay', $data);
    $this->load->view('temp/footer');
}
}

    //This function will give the student information from studentID
    /*public function studentInfoById() {
        $studentId = $this->input->get('q', TRUE);
        $query = $this->common->stuInfoId($studentId);
        if (empty($query)) {
            echo '<div class="form-group">
                    <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                        <div class="alert alert-danger">
                            <strong>' . lang('tea_info') . ':</strong> ' . lang('teac_1') . ' <strong>' . $studentId . '</strong>' . lang('teac_2') . '
                    </div></div></div>';
        } else {
            echo '<div class="row"><div class="col-md-offset-2 col-md-7 stuInfoIdBox">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . lang('teac_3') . ' <span class="requiredStar">  </span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="studentName" value="' . $query->student_nam . '" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">' . lang('teac_4') . ' <span class="requiredStar">  </span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="class" value="' . $this->common->class_title($query->class_id) . '" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <img src="assets/uploads/' . $query->student_photo . '" class="img-responsive" alt=""><br>
                    </div>
                </div></div>';
        }
    }*/

    //This function will work to pay salary to employes
    public function paySalary() {
        if ($this->input->post('submit', TRUE)) {
            $pre_balence = $this->accountmodel->pre_balence();
            $total_amount = $this->input->post('totalSalary', TRUE);
            if ($pre_balence >= $total_amount) {
                $balence = $pre_balence - $total_amount;
                $employId = $this->input->post('employId', TRUE);
                if ($this->input->post('month', TRUE) == 1) {
                    $month = 'January';
                } elseif ($this->input->post('month', TRUE) == 2) {
                    $month = 'February';
                } elseif ($this->input->post('month', TRUE) == 3) {
                    $month = 'March';
                } elseif ($this->input->post('month', TRUE) == 4) {
                    $month = 'April';
                } elseif ($this->input->post('month', TRUE) == 5) {
                    $month = 'May';
                } elseif ($this->input->post('month', TRUE) == 6) {
                    $month = 'Jun';
                } elseif ($this->input->post('month', TRUE) == 7) {
                    $month = 'July';
                } elseif ($this->input->post('month', TRUE) == 8) {
                    $month = 'August';
                } elseif ($this->input->post('month', TRUE) == 9) {
                    $month = 'Septembore';
                } elseif ($this->input->post('month', TRUE) == 10) {
                    $month = 'October';
                } elseif ($this->input->post('month', TRUE) == 11) {
                    $month = 'November';
                } elseif ($this->input->post('month', TRUE) == 12) {
                    $month = 'December';
                }
                $salary = array(
                    'year' => $this->db->escape_like_str(date('Y')),
                    'date' => $this->db->escape_like_str(strtotime(date('d-m-Y'))),
                    'month' => $this->db->escape_like_str($month),
                    'total_amount' => $this->db->escape_like_str($total_amount),
                    'method' => $this->db->escape_like_str($this->input->post('method', TRUE)),
                    'user_id' => $this->db->escape_like_str($employId),
                    'employ_title' => $this->db->escape_like_str($this->input->post('employ_title', TRUE))
                    );
                if ($this->db->insert('salary', $salary)) {
                    $entry_info = $this->accountmodel->tran_check(2);
                    if ($entry_info == 'no_entry') {
                        $inco_data = array(
                            'date' => $this->db->escape_like_str(strtotime(date('d-m-Y'))),
                            'acco_id' => $this->db->escape_like_str(2),
                            'category' => $this->db->escape_like_str('Expense'),
                            'amount' => $this->db->escape_like_str($total_amount),
                            'balance' => $this->db->escape_like_str($balence)
                            );
                        $this->db->insert('transection', $inco_data);
                    } else {
                        $inco_data = array(
                            'date' => $this->db->escape_like_str(strtotime(date('d-m-Y'))),
                            'acco_id' => $this->db->escape_like_str(2),
                            'category' => $this->db->escape_like_str('Expense'),
                            'amount' => $this->db->escape_like_str($total_amount + $entry_info[0]['amount']),
                            'balance' => $this->db->escape_like_str($balence)
                            );
                        $row_id = $entry_info[0]['id'];
                        $this->db->where('id', $row_id);
                        $this->db->update('transection', $inco_data);
                    }
                }
                $satSalaryInfo = array(
                    'month' => $this->db->escape_like_str($this->input->post('month', TRUE)),
                    );
                $this->db->where('employ_user_id', $employId);
                if ($this->db->update('set_salary', $satSalaryInfo)) {
                    redirect('account/paySalary', 'refresh');
                }
            } else {
                $data['message'] = '<div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close" type="button"></button>
                <h4 class="alert-heading">' . lang('error') . '</h4> ' . lang('teac_5') . '
            </div>';
            $data['salary_list'] = $this->accountmodel->employee_salary();
            $this->load->view('temp/header');
            $this->load->view('paySalary', $data);
            $this->load->view('temp/footer');
        }
    } else {
        $data['salary_list'] = $this->accountmodel->employee_salary();
        $this->load->view('temp/header');
        $this->load->view('paySalary', $data);
        $this->load->view('temp/footer');
    }
}

    //This function will show the employ who will get Government salary
public function ajaxEmployInfo() {
    $month = $this->input->get('month');
    $query = $this->accountmodel->salaryEmployList($month);
    echo '<div class="form-group">
    <label class="col-md-3 control-label">' . lang('teac_6') . ' <span class="requiredStar"> * </span></label>
    <div class="col-md-9">
        <select onchange="salaryAmount(this.value)" class="form-control" name="employId" data-validation="required" data-validation-error-msg="' . lang('teac_11') . '">
            <option value="">' . lang('select') . '</option>';
            foreach ($query as $row) {
                echo '<option value="' . $row['employ_user_id'] . '">' . $row['employe_title'] . '</option>';
            }
            echo '</select>
        </div>
    </div>
    <div id="ajaxResult_2"></div>';
}

    //This function will return one employe sallary amount
public function ajaxSalaryAmount() {
    $uId = $this->input->get('uId');
    $query = $this->accountmodel->ajaxSalaryAmount($uId);
    echo '<div class="form-group">
    <label class="col-md-3 control-label"> ' . lang('teac_7') . ' <span class="requiredStar">  </span></label>
    <div class="col-md-9">
        <input type="text" readonly="" placeholder="Readonly" class="form-control" name="totalSalary" value="' . $query . '">
    </div>
</div><input type="hidden" name="employ_title" value="' . $this->accountmodel->semployTitle($uId) . '">';
}

    //this function will return employ title via user id
public function SchEmploTItle() {
    $uId = $this->input->get('uId');
    echo '<input type="hidden" name="employ_title" value="' . $this->accountmodel->semployTitle($uId) . '">';
}

    //This function will make transection
public function transection() {
    $date = strtotime(date('d-m-Y'));
    if ($this->input->post('expense', TRUE)) {
        $account_id = $this->input->post('account_id', TRUE);
        $amount = $this->input->post('amount', TRUE);
        $pre_balence = $this->accountmodel->pre_balence();
        if ($pre_balence >= $amount) {
            $balence = $pre_balence - $amount;
            $entry_info = $this->accountmodel->tran_check($account_id);
            if ($entry_info == 'no_entry') {
                $inco_data = array(
                    'date' => $this->db->escape_like_str($date),
                    'acco_id' => $this->db->escape_like_str($account_id),
                    'category' => $this->db->escape_like_str('Expense'),
                    'amount' => $this->db->escape_like_str($amount),
                    'balance' => $this->db->escape_like_str($balence)
                    );
                if ($this->db->insert('transection', $inco_data)) {
                    $data['message'] = '<div class="alert alert-block alert-success fade in">
                    <button data-dismiss="alert" class="close" type="button"></button>
                    <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_8') . ' 
                </div>';
                $data['income'] = $this->accountmodel->income();
                $data['expanse'] = $this->accountmodel->expanse();
                $data['inco_title'] = $this->accountmodel->inco_title();
                $data['expa_title'] = $this->accountmodel->expa_title();
                $this->load->view('temp/header');
                $this->load->view('transection', $data);
                $this->load->view('temp/footer');
            }
        } else {
            $inco_data = array(
                'date' => $this->db->escape_like_str($date),
                'acco_id' => $this->db->escape_like_str($account_id),
                'category' => $this->db->escape_like_str('Expense'),
                'amount' => $this->db->escape_like_str($amount + $entry_info[0]['amount']),
                'balance' => $this->db->escape_like_str($balence)
                );
            $row_id = $entry_info[0]['id'];
            $this->db->where('id', $row_id);
            if ($this->db->update('transection', $inco_data)) {
                $data['message'] = '<div class="alert alert-block alert-success fade in">
                <button data-dismiss="alert" class="close" type="button"></button>
                <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_8') . '
            </div>';
            $data['income'] = $this->accountmodel->income();
            $data['expanse'] = $this->accountmodel->expanse();
            $data['inco_title'] = $this->accountmodel->inco_title();
            $data['expa_title'] = $this->accountmodel->expa_title();
            $this->load->view('temp/header');
            $this->load->view('transection', $data);
            $this->load->view('temp/footer');
        }
    }
} else {
    $data['message'] = '<div class="alert alert-block alert-danger fade in">
    <button data-dismiss="alert" class="close" type="button"></button>
    <h4 class="alert-heading">' . lang('error') . '</h4> ' . lang('teac_9') . '
</div>';
$data['income'] = $this->accountmodel->income();
$data['expanse'] = $this->accountmodel->expanse();
$data['inco_title'] = $this->accountmodel->inco_title();
$data['expa_title'] = $this->accountmodel->expa_title();
$this->load->view('temp/header');
$this->load->view('transection', $data);
$this->load->view('temp/footer');
}
} elseif ($this->input->post('income', TRUE)) {
    $account_id = $this->input->post('account_id', TRUE);
    $amount = $this->input->post('amount', TRUE);
    $pre_balence = $this->accountmodel->pre_balence();
    $balence = $pre_balence + $amount;
    $entry_info = $this->accountmodel->tran_check($account_id);
    if ($entry_info == 'no_entry') {
        $inco_data = array(
            'date' => $this->db->escape_like_str($date),
            'acco_id' => $this->db->escape_like_str($account_id),
            'category' => $this->db->escape_like_str('Income'),
            'amount' => $this->db->escape_like_str($amount),
            'balance' => $this->db->escape_like_str($balence)
            );
        if ($this->db->insert('transection', $inco_data)) {
            $data['message_2'] = '<div class="alert alert-block alert-success fade in">
            <button data-dismiss="alert" class="close" type="button"></button>
            <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_10') . '
        </div>';
        $data['income'] = $this->accountmodel->income();
        $data['expanse'] = $this->accountmodel->expanse();
        $data['inco_title'] = $this->accountmodel->inco_title();
        $data['expa_title'] = $this->accountmodel->expa_title();
        $this->load->view('temp/header');
        $this->load->view('transection', $data);
        $this->load->view('temp/footer');
    }
} else {
    $inco_data = array(
        'date' => $this->db->escape_like_str($date),
        'acco_id' => $this->db->escape_like_str($account_id),
        'category' => $this->db->escape_like_str('Income'),
        'amount' => $this->db->escape_like_str($amount + $entry_info[0]['amount']),
        'balance' => $this->db->escape_like_str($balence)
        );
    $row_id = $entry_info[0]['id'];
    $this->db->where('id', $row_id);
    if ($this->db->update('transection', $inco_data)) {
        $data['message_2'] = '<div class="alert alert-block alert-success fade in">
        <button data-dismiss="alert" class="close" type="button"></button>
        <h4 class="alert-heading">' . lang('success') . ' </h4> ' . lang('teac_10') . '
    </div>';
    $data['income'] = $this->accountmodel->income();
    $data['expanse'] = $this->accountmodel->expanse();
    $data['inco_title'] = $this->accountmodel->inco_title();
    $data['expa_title'] = $this->accountmodel->expa_title();
    $this->load->view('temp/header');
    $this->load->view('transection', $data);
    $this->load->view('temp/footer');
}
}
} else {
    $data['income'] = $this->accountmodel->income();
    $data['expanse'] = $this->accountmodel->expanse();
    $data['inco_title'] = $this->accountmodel->inco_title();
    $data['expa_title'] = $this->accountmodel->expa_title();
    $this->load->view('temp/header');
    $this->load->view('transection', $data);
    $this->load->view('temp/footer');
}
}

    //This function will show expanse list by date range 
public function exp_list_da_ra() {
    $rngstrt = strtotime($this->input->post('rngstrt', TRUE));
    $rngfin = strtotime($this->input->post('rngfin', TRUE));
    $query = $this->db->query("SELECT * FROM transection WHERE date >='$rngstrt' AND date <= '$rngfin' AND category='Expense'");
    $i = 1;
    foreach ($query->result_array() as $row) {
        echo '<tr>
        <td>
            ' . $i . '
        </td>
        <td>
            ' . date("d-m-Y", $row['date']) . '
        </td>
        <td>
            ' . $this->accountmodel->acc_tit_id($row['acco_id']) . '
        </td>
        <td>
            ' . $row['amount'] . '
        </td>
        <td>
            ' . $row['balance'] . '
        </td>
    </tr>';
    $i++;
}
}

    //This function will show expanse list by date range 
public function inc_list_da_ra() {
    $rngstrt = strtotime($this->input->post('rngstrt', TRUE));
    $rngfin = strtotime($this->input->post('rngfin', TRUE));
    $query = $this->db->query("SELECT * FROM transection WHERE date >='$rngstrt' AND date <= '$rngfin' AND category='Income'");
    $i = 1;
    foreach ($query->result_array() as $row) {
        echo '<tr>
        <td>
            ' . $i . '
        </td>
        <td>
            ' . date("d-m-Y", $row['date']) . '
        </td>
        <td>
            ' . $this->accountmodel->acc_tit_id($row['acco_id']) . '
        </td>
        <td>
            ' . $row['amount'] . '
        </td>
        <td>
            ' . $row['balance'] . '
        </td>
    </tr>';
    $i++;
}
}
    // Date formate
function GetDateInGivenFormat($fromFormat,$toFormat,$inputDate)
{

    // $fromFormat = 'm/j/Y';
    // $toFormat = 'Y-m-d';
    $format = $fromFormat;
    $dateTimeObj = DateTime::createFromFormat ($format , $inputDate);

        if(!$dateTimeObj) //malformed date
        return null;

        $outputDate = $dateTimeObj->format($toFormat);

        return $outputDate;
    }

    // get fee money_receipt
    public function money_receipt(){
        $this->form_validation->set_rules('class_id', 'Class name', 'required');
        $this->form_validation->set_rules('studentId', 'select student', 'required');
        $this->form_validation->set_rules('date', 'payment date', 'required');
        $this->form_validation->set_rules('sum', 'total amount', 'required');
        // $this->form_validation->set_rules('received', 'payment received', 'required');

        if($this->form_validation->run() == TRUE){
            // print_r($this->session->all_userdata());
            // print_r($this->input->post()); exit;

            $form_data = array(
                'student_id' => $this->input->post('studentId'),
                'class_id' => $this->input->post('class_id'),
                'pay_date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'pay_total' => $this->input->post('sum'),
                // 'pay_received' => $this->input->post('received'),
                'user_id' => $this->session->userdata('user_id')
                );
            if ($this->input->post('received')=='') {
                $form_data['pay_received'] = $this->input->post('sum');
            }
            else{
                $form_data['pay_received'] = $this->input->post('received');
            }

            // print_r($form_data); exit;
            // print_r($form_data); exit;
            // $itemId = $this->input->post('item');

            if($this->db->insert('student_payment', $form_data)){
                $lastID = $this->db->insert_id();
                // loop itme insert
                for ($i=0; $i<sizeof($_POST['item']); $i++) {
                    $c_year=date('Y');
                    $f_month=$_POST['from_date'][$i];
                    $t_month=$_POST['to_date'][$i];
                    $c_date='01';

                    $f_date=$c_year.'-'.$f_month.'-01';
                    $t_date=$c_year.'-'.$t_month.'-01';

                    $fee_id = explode('-', $_POST['item'][$i]);
                    // $fromDate = $_POST['from_date'][$i] != ''? date('Y-m-d', strtotime($_POST['from_date'][$i])) : NULL;
                    $fromDate = $f_month != ''? date('Y-m-d', strtotime($f_date)) : NULL;
                    // $toDate = $_POST['to_date'][$i] != ''? date('Y-m-d', strtotime($_POST['to_date'][$i])) : NULL;
                    $toDate = $t_month != ''? date('Y-m-d', strtotime($t_date)) : NULL;
                    
                    // echo $fromDate.'x'.$toDate;exit;
                    $loop_data = array(
                        'invoice_id' => $lastID,
                        'fee_type_id' => $fee_id[0],
                        'root_fee_type_id' => $this->common->fee_type_root_id($fee_id[0]),
                        'unit_price' => $_POST['total'][$i]/$_POST['quantity'][$i],
                        'quantity' => $_POST['quantity'][$i],
                        'from_date' => $fromDate,
                        'to_date' => $toDate,
                        'comment' => $_POST['comment'][$i],
                        'fee_title_desc' => $_POST['desc'][$i],
                        'item_stu_id' => $this->input->post('studentId'),
                        'item_date' => date('Y-m-d', strtotime($this->input->post('date'))),
                        'item_class_id' => $this->input->post('class_id'),
                        );
                    $this->db->insert('student_fee_item', $loop_data);
                }
                redirect(base_url('index.php/account/invoice_details/'.$lastID));
                $this->session->set_flashdata('message', 'Save successfully.');
                // redirect("committee/national");
            }
        }
        
        $data['slips'] = $this->accountmodel->stud_payment();
        $data['s_class'] = $this->common->getAllData('class');
        $data['fee_item'] = $this->common->getAllData('fee_item');
        // echo "<pre>";
        // print_r($data['fee_item']);
        $this->load->view('temp/header');
        $this->load->view('money_receipt', $data);
        $this->load->view('temp/footer');        
    }

    public function StorePayment(){
        $this->form_validation->set_rules('class_id', 'Class name', 'required');
        $this->form_validation->set_rules('studentId', 'select student', 'required');
        $this->form_validation->set_rules('date', 'payment date', 'required');
        $this->form_validation->set_rules('sum', 'total amount', 'required');
        $this->form_validation->set_rules('received', 'payment received', 'required');

        if($this->form_validation->run() == TRUE){
            // print_r($this->session->all_userdata());
            // print_r($this->input->post()); exit;

            $form_data = array(
                'student_id' => $this->input->post('studentId'),
                'class_id' => $this->input->post('class_id'),
                'pay_date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'pay_total' => $this->input->post('sum'),
                'pay_received' => $this->input->post('received'),
                'user_id' => $this->session->userdata('user_id')
                );

            // print_r($form_data); exit;

            // print_r($this->input->post()); exit;
            // $itemId = $this->input->post('item');

            if($this->db->insert('student_store_invoice', $form_data)){
                $lastID = $this->db->insert_id();
                
                // loop itme insert
                for ($i=0; $i<sizeof($_POST['item']); $i++) { 
                    $fee_id = explode('-', $_POST['item'][$i]);
                    //$fromDate = $_POST['from_date'][$i] != ''? date('Y-m-d', strtotime($_POST['from_date'][$i])) : NULL;
                    //$toDate = $_POST['to_date'][$i] != ''? date('Y-m-d', strtotime($_POST['to_date'][$i])) : NULL;
                    
                    $loop_data = array(
                        'invoice_id' => $lastID,
                        'item_id' => $fee_id[0],
                        'unit_price' => $_POST['amount'][$i],
                        'quantity' => $_POST['quantity'][$i],                      
                        'comment' => $_POST['comment'][$i],
                        'item_stu_id' => $this->input->post('studentId'),
                        'item_date' => date('Y-m-d', strtotime($this->input->post('date'))),
                        'item_class_id' => $this->input->post('class_id'),
                        );
                    $this->db->insert('stu_store_invoice_details', $loop_data);
                }
                //redirect(base_url('index.php/account/invoice_details/'.$lastID));
                $this->session->set_flashdata('message', 'Save successfully.');
                // redirect("committee/national");
            }

        }
        
        $data['slips'] = $this->accountmodel->stud_payment();
        $data['s_class'] = $this->common->getAllData('class');
        // $data['fee_item'] = $this->common->getAllData('fee_item');
        $this->load->view('temp/header');
        $this->load->view('store_payment', $data);
        $this->load->view('temp/footer');        
    }

    /////// Old Money Receipt 
    // public function money_receipt()
    // {
    //     if (isset($_POST['submit'])) {
    //         $user = $this->ion_auth->user()->row();
    //         $id = $user->id;
    //         $stdId = $this->input->post('studentId');
    //         $itemId = $this->input->post('item');
    //         $amount = $this->input->post('amount');
    //         $dateValue = $this->input->post('date');
    //         $payment = $this->input->post('payment');
    //         $fine = $this->input->post('fine');
    //         $total = $this->input->post('total');
    //         $due = $this->input->post('due');

    //         for ($i=0; $i <count($itemId); $i++) 
    //         {
    //             if ($dateValue[$i]=="") {
    //                 $toDay = new DateTime();
    //                 $date = $toDay->format('Y-m-d');
    //             }
    //             else {
    //                 $fromFormat = 'd-m-Y';
    //                 $toFormat = 'Y-m-d';
    //                 $date = $this->GetDateInGivenFormat($fromFormat,$toFormat,$dateValue[$i]);

    //             }
    //             if ($due[$i] == '0') {
    //                 $status = 'paid'; // Paid
    //             }else if ($due[$i] < $total[$i]) {
    //                 $status = 'Pending'; // Pending
    //             }else if ($due[$i] == $total[$i]) {
    //                 $status = 'Unpaid'; // Unpaid
    //             }
    //             $fees = explode('-', $itemId[$i]);

    //             $paymentArr = array( 
    //                             'class_id'      => $this->input->post('class_id'), 
    //                             'student_id'    => $stdId, 
    //                             'fee_id'        => $fees[0], 
    //                             'amount'        => $amount[$i], 
    //                             'payment'       => $payment[$i],
    //                             'fine'          => $fine[$i],
    //                             'total'         => $total[$i],
    //                             'due'           => $due[$i],
    //                             'created_at'    => $date,
    //                             'added_by'      => $id,
    //                             'status'        => $status

    //                         );
    //             $this->db->insert('student_fee', $paymentArr); 
    //         }

    //         $success = '<div class="alert alert-success"><strong>Success!</strong> Fee Successfully Added.</div>';
    //         $data['success'] = $success;

    //         $data['fees'] = $this->accountmodel->StudentFees();
    //         $data['s_class'] = $this->common->getAllData('class');
    //         $data['fee_item'] = $this->common->getAllData('fee_item');

    //         $data['classId']    = '';
    //         $data['studentId']  = '';
    //         $data['item']  = '';
    //         $data['from']  = '';
    //         $data['to']    = '';

    //         $this->load->view('temp/header');
    //         $this->load->view('view_payment', $data);
    //         $this->load->view('temp/footer');
    //     }
    //     else
    //     {
    //         $data['slips'] = $this->accountmodel->stud_payment();
    //         $data['s_class'] = $this->common->getAllData('class');
    //         $data['fee_item'] = $this->common->getAllData('fee_item');
    //         $this->load->view('temp/header');
    //         $this->load->view('money_receipt', $data);
    //         $this->load->view('temp/footer');
    //     }
    // }


    //This function will make students month end slip by auto calculation
    public function end_stu_calcu() {
        $class = $this->accountmodel->all_class();

        if(!empty($class)){

            foreach ($class as $row) {
                $class_id = $row['id'];
                $m_t_fee = $this->accountmodel->total_fee($class_id);
                if (!empty($m_t_fee)) {
                    foreach ($m_t_fee as $row1) {
                        $item_id[] = $row1['id'];
                        $money[] = $row1['amount'];
                    }
                    $id_text = implode(",", $item_id);
                    $amount = array_sum($money);
                    $all_student = $this->accountmodel->all_students($class_id);
                    foreach ($all_student as $row2) {
                        $student_id = $row2['student_id'];
                        $dues = $this->accountmodel->dues($student_id);
                        if ($dues != 0) {
                            $total = $amount + $dues;
                        } else {
                            $total = $amount;
                        }
                        $advance = $this->accountmodel->advance($student_id);
                        $status = 'Unpaid';
                        $paid = 0;
                        $balanec = 0;
                        if ($advance != 0) {
                            if ($total > $advance) {
                                $total -= $advance;
                            } elseif ($advance == $total) {
                                $balanec = 0;
                                $paid = $total;
                                $status = 'Paid';
                            } elseif ($total < $advance) {
                                $paid = $total;
                                $balanec = $advance - $total;
                                $status = 'Paid';
                            }
                        }
                        $data = array(
                            'year' => $this->db->escape_like_str(date('Y')),
                            'month' => $this->db->escape_like_str(date('F')),
                            'class_id' => $this->db->escape_like_str($class_id),
                            'student_id' => $this->db->escape_like_str($student_id),
                            'item_id' => $this->db->escape_like_str($id_text),
                            'amount' => $this->db->escape_like_str($amount),
                            'dues' => $this->db->escape_like_str($dues),
                            'advance' => $this->db->escape_like_str($advance),
                            'total' => $this->db->escape_like_str($total),
                            'paid' => $this->db->escape_like_str($paid),
                            'balance' => $this->db->escape_like_str($balanec),
                            'status' => $this->db->escape_like_str($status),
                            );
                    //print_r($data); exit;
                        $this->db->insert('slip', $data);
                    }
                    $item_id = array();
                    $money = array();
                    $class_com = array(
                        'month_fee' => $this->db->escape_like_str(date('F'))
                        );
                    $this->db->where('id', $class_id);
                    $this->db->update('class', $class_com);


                    $data['message'] = '<div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Success ! </strong> Student month end fee calculation successful. 
                </div>';

                $data['slips'] = $this->accountmodel->stud_payment();
                $this->load->view('temp/header');
                $this->load->view('allSlips', $data);
                $this->load->view('temp/footer');

            }
        }}else{

            redirect('home');
        }

    }




    /****************************** For account New Section by Saleah **************************************/


 //This function is use to add an account head
    public function add_account_head() {

        $this->form_validation->set_rules('category_id', 'Category Name', 'required|xss_clean');
        $this->form_validation->set_rules('accounts_head_name', 'Account Head Name', 'required|xss_clean');
        $this->form_validation->set_rules('note', 'Note', 'xss_clean');
        if ($this->form_validation->run() === false) {

            $data['category'] = $this->common->get_all_category();
                //print_r($data['category']); exit; 
            $this->load->view('temp/header');
            $this->load->view('add_account_head', $data);
            $this->load->view('temp/footer');

        }else{

            if ($this->input->post('submit', TRUE)) {

                $accountInfo = array(
                    'category_id' => $this->input->post('category_id', TRUE),
                    'accounts_head_name' => $this->input->post('accounts_head_name', TRUE),
                    'note' => $this->input->post('note', TRUE)
                    );

                if ($this->db->insert('accounts_head', $accountInfo)) {

                    $this->session->set_flashdata('message', 'Account Head Successfully Added'); 
                    redirect('account/account_head_list');

                }

            }
        }

    }

    //This function is use for Listing all account head.
    public function account_head_list()
    {
        $data['accounts_head'] = $this->accountmodel->get_all_account_head();
        $this->load->view('temp/header');
        $this->load->view('account_head_list', $data);
        $this->load->view('temp/footer');
    }

    //This function is use for delete an account head.
    public function account_head_delete() {
        $id = $this->input->get('id'); 
        if ($this->db->delete('accounts_head', array('id' => $id))) {
            $this->session->set_flashdata('message', 'Account Head Delete Successful'); 
            redirect('account/account_head_list');
        }
    }

    //This function will edit an account head
    public function edit_account_head() {
        $id = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {

            $editData = array(
                'category_id' =>  $this->input->post('category_id', TRUE),
                'accounts_head_name' =>  $this->input->post('accounts_head_name', TRUE),
                'note' =>  $this->input->post('note', TRUE)
                );

            $id = $this->input->post('id', TRUE);

            $this->db->where('id', $id);
            if ($this->db->update('accounts_head', $editData)) {
                $this->session->set_flashdata('message', 'Account Head Update Successful'); 
                redirect('account/account_head_list');
            }
        } else {
            $data['accHeadInfo'] = $this->common->getWhere('accounts_head', 'id', $id);
            $data['category'] = $this->common->get_all_category();

            $this->load->view('temp/header');
            $this->load->view('edit_account_head', $data);
            $this->load->view('temp/footer');
        }
    }




    /****************** Manage Master File ******************************/



    //This function is for adding account Category first

    public function add_account_category(){
        $this->load->view('temp/header');
        $this->load->view('add_account_category');
        $this->load->view('temp/footer');
    }

    //This function is use to add a category
    public function add_category() {
        $this->form_validation->set_rules('category_name', 'Category Name', 'required|xss_clean');
        if ($this->form_validation->run() === false) {
            $this->load->view('temp/header');
            $this->load->view('add_category');
            $this->load->view('temp/footer');
        }else{
            if ($this->input->post('submit', TRUE)) {
                $categoryInfo = array(
                    'category_name' => $this->input->post('category_name', TRUE)
                    );
                if ($this->db->insert('category', $categoryInfo)) {
                    $this->session->set_flashdata('message', 'Category Successfully Added'); 
                    redirect('account/category_list');

                }
            }
        }
    }


    //This function is use for Listing all category.
    public function category_list()
    {
        $data['category'] = $this->common->fatch_all_data('category');
        $this->load->view('temp/header');
        $this->load->view('category_list', $data);
        $this->load->view('temp/footer');
    }

    //This function is use for delete a category.
    public function categoryDelete() {
        $id = $this->input->get('di'); 
        if ($this->db->delete('category', array('id' => $id))) {
            $this->session->set_flashdata('message', 'Category Delete Successful'); 
            redirect('account/category_list');
        }
    }

    //This function will edit a Category
    public function editCategory() {
        $id = $this->input->get('id');
        if ($this->input->post('submit', TRUE)) {
            $category_name = $this->input->post('category_name', TRUE);
            $editData = array(
                'category_name' => $this->db->escape_like_str($category_name)
                );
            $id = $this->input->post('id', TRUE);
            $this->db->where('id', $id);
            if ($this->db->update('category', $editData)) {
                $this->session->set_flashdata('message', 'Category Update Successful'); 
                redirect('account/category_list');
            }
        } else {
            $data['catInfo'] = $this->common->getWhere('category', 'id', $id);
            $this->load->view('temp/header');
            $this->load->view('editCategory', $data);
            $this->load->view('temp/footer');
        }
    }



    public function account_category(){

        $this->load->view('temp/header');
        $this->load->view('add_account_head');
        $this->load->view('temp/footer');

    }

    //This function is for Loading Master file first
    public function master_file(){

        $data['category'] = $this->common->get_all_category();
        $data['accounts_sub_head'] = $this->accountmodel->get_all_account_sub_head();

        $this->session->unset_userdata('category_id');

        $this->load->view('temp/header');
        $this->load->view('master_file', $data);
        $this->load->view('temp/footer');

    }

    //This function is for redirecting to Master file after add and delete
    public function redirect_to_master_file(){

        $data['category'] = $this->common->get_all_category();
        $data['accounts_sub_head'] = $this->accountmodel->get_all_account_sub_head();
        $this->load->view('temp/header');
        $this->load->view('master_file', $data);
        $this->load->view('temp/footer');

    }

    public function get_category_data(){

        $category_id = $this->input->post('category_id');
        $data['accounts_head'] = $this->common->get_account_head_data($category_id);
        echo json_encode($data['accounts_head']); 
    }


    //This function is to get account head data for master file
    public function getAccHeadData($category_id){

        $this->session->set_userdata('category_id', $category_id);
        $data['accounts_head'] = $this->common->get_account_head_data($category_id);
        $this->load->view('accounts_head_data', $data); 

    }

    //This function is to add account sub head data from master file
    public function addAccountSubHead(){

        $this->form_validation->set_rules('accounts_head_id', 'Account Head Id', 'required|xss_clean');
        $this->form_validation->set_rules('sub_head_name', 'Account Sub Head Name', 'required|xss_clean');
        $this->form_validation->set_rules('note', 'Note', 'xss_clean');
        if ($this->form_validation->run() === false) {

            $data['accounts_head'] = $this->common->fatch_all_data('accounts_head');
            // echo '<pre>';
            // print_r($data['accounts_head']); exit; 
            $this->load->view('temp/header');
            $this->load->view('addAccountSubHead', $data);
            $this->load->view('temp/footer');

        }else{

            $accounts_head_id = $this->input->post('accounts_head_id');
            $data['accHeadInfo'] = $this->common->getWhere('accounts_head', 'id', $accounts_head_id);
                //print_r($data['accHeadInfo']);exit; 
            $category_id = $data['accHeadInfo'][0]['category_id']; 
            $data4['accounts_head_id'] = $this->input->post('accounts_head_id');
            $data4['sub_head_name'] = $this->input->post('sub_head_name');
            $data4['note'] = $this->input->post('note');
            $data4['category_id'] = $category_id;

            $this->db->insert('accounts_sub_head', $data4);

            $this->session->set_flashdata('message', 'Account Sub Head Successfully Added'); 
            redirect('account/account_sub_head_list');

        }
    }



    //This function is use for listing account sub head.
    public function account_sub_head_list(){

        $data['accounts_sub_head'] = $this->accountmodel->get_all_account_sub_head();
            // echo '<pre>';
            // print_r($data['accounts_sub_head']); exit; 
        $this->load->view('temp/header');
        $this->load->view('account_sub_head_list', $data);
        $this->load->view('temp/footer');

    }

    //This function is use for delete an account sub head.
    public function account_sub_head_delete(){

        $id = $this->input->get('id'); 
        if ($this->db->delete('accounts_sub_head', array('id' => $id))) {
            $this->session->set_flashdata('message', 'Account Sub Head Delete Successful'); 
            redirect('account/account_sub_head_list');
        }

    }



    //This function will edit an account head
    public function edit_account_sub_head() {

        $id = $this->input->get('id', TRUE);
        $this->form_validation->set_rules('accounts_head_id', 'Account Head Id', 'required|xss_clean');
        $this->form_validation->set_rules('sub_head_name', 'Account Sub Head Name', 'required|xss_clean');
        $this->form_validation->set_rules('note', 'Note', 'xss_clean');
        if ($this->form_validation->run() === false) {

            $data['accSubHeadInfo'] = $this->common->getWhere('accounts_sub_head', 'id', $id);
            $data['accounts_head'] = $this->common->fatch_all_data('accounts_head');

            $this->load->view('temp/header');
            $this->load->view('edit_account_sub_head', $data);
            $this->load->view('temp/footer');

        }else{


            $editData = array(
                'accounts_head_id' => $this->input->post('accounts_head_id', TRUE),
                'sub_head_name' => $this->input->post('sub_head_name', TRUE),
                'note' => $this->input->post('note', TRUE)
                );

            $id = $this->input->post('id', TRUE);

            $this->db->where('id', $id);
            if ($this->db->update('accounts_sub_head', $editData)) {
                $this->session->set_flashdata('message', 'Account Sub Head Update Successful'); 
                redirect('account/account_sub_head_list');
            }

        }
    }

    // This function is for adding transaction to database
    public function addTransaction(){
        $this->form_validation->set_rules('accounts_sub_head_id', 'Account Head Id', 'required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric|xss_clean');
        $this->form_validation->set_rules('invoice_number', 'Invoice Number', 'xss_clean');
        // $this->form_validation->set_rules('note', 'Note', 'required|xss_clean');
        if ($this->form_validation->run() === false) {
            $data['accounts_sub_head'] = $this->common->fatch_all_data('accounts_sub_head');
            $data['type'] = $this->common->getAllData('category');
            $this->load->view('temp/header');
            $this->load->view('addTransaction', $data);
            $this->load->view('temp/footer');
        }
        else{
            $accounts_sub_head_id = $this->input->post('accounts_sub_head_id');
            $head_id = $this->common->getWhere('accounts_sub_head', 'id', $accounts_sub_head_id);
            $accounts_head_id = $head_id[0]['accounts_head_id'];

            $data4['category_id'] = $this->input->post('category_id');
            $data4['accounts_head_id'] = $accounts_head_id;
            $data4['accounts_sub_head_id'] = $accounts_sub_head_id;

            $data4['amount'] = $this->input->post('amount');
            $data4['invoice_number'] = $this->input->post('invoice_number');
            $data4['note'] = $this->input->post('note');
            
            $data4['date'] = date('Y-m-d');

            $this->db->insert('transaction_list', $data4);

            $this->session->set_flashdata('message', 'Transaction Successfully Added'); 
            redirect('account/addTransaction');
        }
    }

    //This function is use for listing Transaction.
    public function transactionList(){

        $data['transaction_list'] = $this->accountmodel->getTransactionList();
        $data['category'] = $this->common->fatch_all_data('category');
        $data['accounts_head'] = $this->common->fatch_all_data('accounts_head');
        $data['accounts_sub_head'] = $this->common->fatch_all_data('accounts_sub_head');

            // echo '<pre>';
            // print_r($data['accounts_sub_head']); exit; 
        $this->load->view('temp/header');
        $this->load->view('transactionList', $data);
        $this->load->view('temp/footer');

    }



   // This function is to get  Account Type transaction list form database 
    public function getAccTypeTransaction(){

        $category_id = $this->input->post('category_id');
        $time_duration = $this->input->post('time_duration');
        $date0ne = $this->input->post('date0ne');
        $datetwo = $this->input->post('datetwo');

        // $category_id = 19;
        // $time_duration = 2;
        // $date0ne = '11/08/2016';
        // $datetwo = '11/30/2016';

        $data['transaction_list'] = $this->accountmodel->getTransactionListByID($category_id, $time_duration, $date0ne, $datetwo );
        $data['total_row'] = count($data['transaction_list']);
        $data['total_amount'] = $this->accountmodel->getTotalAmount($category_id, $time_duration, $date0ne, $datetwo );

        // echo '<pre>';
        // print_r($data['transaction_list']); exit; 
        $this->load->view('transaction_list_part', $data); 


    }

   // This function is to get  Account sub head data for select box

    public function getAccountSubHeadData(){

        $accounts_head_id = $this->input->post('accounts_head_id');
        $data['accSubHeadInfo'] = $this->common->getWhere('accounts_sub_head', 'accounts_head_id', $accounts_head_id);

        foreach ($data['accSubHeadInfo'] as $key => $value) { 
         echo "<option value="; echo $value['id']; echo ">"; echo $value['sub_head_name']; echo "</option>"; 
     }

     exit; 
 }




 // This function is to get  Account Head Type transaction list form database 

 public function getAccHeadTypeTransaction(){

    $accounts_head_id = $this->input->post('accounts_head_id');
    $accounts_sub_head_id = $this->input->post('accounts_sub_head_id');
    $date0ne = $this->input->post('date0ne');
    $datetwo = $this->input->post('datetwo');
    $time_duration = $this->input->post('time_duration');

        // $category_id = 19;
        // $time_duration = 2;
        // $date0ne = '11/08/2016';
        // $datetwo = '11/30/2016';

    $data['transaction_list'] = $this->accountmodel->getTransactionListForAccType($accounts_head_id, $time_duration, $accounts_sub_head_id, $date0ne, $datetwo );
    $data['total_row'] = count($data['transaction_list']);
    $data['total_amount'] = $this->accountmodel->getTotalAmountForAccType($accounts_head_id, $time_duration, $accounts_sub_head_id, $date0ne, $datetwo );

        // echo '<pre>';
        // print_r($data['transaction_list']); exit; 
    $this->load->view('transaction_list_part', $data); 
}
    function accout_list(){
        $data_id = $this->input->get('q', TRUE);
        $accounts_sub_head = $this->common->getWhere('accounts_sub_head', 'category_id', $data_id);
            echo '<option value="">--Select One --</option>';
        foreach ($accounts_sub_head as $key => $value) {
            echo '<option value="'. $value['id'].'">'. $value['sub_head_name'].'</option>';
        }
    }
}
