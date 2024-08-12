<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common extends CI_Model {

    function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->dbforge();
    }
	
	public function check_roll()
	{
		$class = $this->input->post('class_id');
		$sec   = $this->input->post('sec_id');
		$roll  = $this->input->post('roll');
		
		//return $class;
		
		$this->db->select('student_id');
		$this->db->from('class_students');
		$this->db->where('roll_number',$roll);
		if($sec != '' or $sec != 0)
		$this->db->where('section',$sec);
		$this->db->where('class_id',$class);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() > 0)
		{
			echo "FALSE";
		}
		else 
		{
			echo "TRUE";
		}
	}
	
    //This function will return logo link
    public function logoTitle(){
        $data = array();
        $query =  $this->db->query("SELECT logo,school_name FROM configuration");
        foreach($query->result_array() as $row){
            $data[] = $row;
        }
        return $data;
    }
    
    //This function return the last inserted user id.
    function usersId() {
        $query = $this->db->query('SELECT id FROM users ORDER BY id DESC LIMIT 1');
        foreach ($query->result_array() as $row){
            $data = $row['id'];
        }
        return $data;
    }
   
    //This function select user access ability.
    public function user_access($role, $userId) {
        $data = array();
        //echo $role.'<br>';
        //if($role==''){echo $userId;exit;}
        $query = $this->db->query("SELECT $role FROM role_based_access WHERE user_id=$userId ")->row();

        foreach ($query as $row) {
            $data = $row;
        }
        if ($data == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //This function show the class title for class selecting class
    public function selectClass(){
        $data = array();
        $query = $this->db->query('SELECT id,class_title FROM class');
        foreach ($query->result_array() as $row){
            $data[] = $row;
        }
        return $data;
    } 
    
    //Total students will returan this function
    public function totalStudent() {
        $data = array();
        $query = $this->db->get('student_info');
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return count($data);
    }
    
    //This function will cheack data table empty or not
    public function emptyCheack($a){
        $query = $this->db->query("SELECT * FROM $a")->row();
        if(empty($query)){
            return TRUE;
        }  else {
            return FALSE;
        }
    }

    //Total teachers will returan this function
    public function totalTeacher() {
        $data = array();
        $query = $this->db->get('teachers_info');
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return count($data);
    }

    //Total parents will returan this function
    public function totalParents() {
        $data = array();
        $query = $this->db->get('parents_info');
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return count($data);
    }

    //Today total Attend student will returan this function
    public function totalAttendStudent() {
        $date = date("Y-m-d");
        // $date = strtotime($day);
        $data = array();
        $query = $this->db->get_where('daily_attendance', array('date' => $date, 'present_or_absent' => 'P'));
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return count($data);
    }

    //This function will return time and date as a string
    public function iceTime() {
        $data = array();
        $query = $this->db->query('SELECT time_zone FROM configuration');
        foreach ($query->result_array() as $row) {
            $data = $row['time_zone'];
        }
        $datestring = "Date : <i class=\"fa fa-clock-o\"></i> %h:%i %a  <i class=\"fa fa-calendar\"></i>  %d %M, %Y ";
        $now = now();
        $timezone = $data;
        $time = gmt_to_local($now, $timezone);
        echo mdate($datestring, $time);
    }

    //This function will return only class title by class id from class table.
    public function class_title($class_id)
    {
        $data = array();
        $query = $this->db->query("SELECT class_title FROM class WHERE id=$class_id")->row();
		//echo $this->db->last_query();
        if ($query) {
            return $query->class_title;
        }
        return false;
    }
    //zuel
    public function sub_title($sub_id)
    {
        $data = array();
        $query = $this->db->query("SELECT exam_subject FROM exam_routine WHERE id=$sub_id")->row();
        if ($query) {
            return $query->exam_subject;
        }
        return false;
    }

    public function fee_type_title($id)
    {
        $data = array();
        $query = $this->db->query("SELECT fee_title, pay_type FROM fee_type WHERE id=$id")->row();
        //echo $this->db->last_query();
        if ($query) {
            $type ="";
            if($query->pay_type !=''){
                $type = ' ('.$query->pay_type.')';
            }
            return $query->fee_title.$type;
        }
        return false;
    }

    
    //This function will show student title by student id
    public function student_title($student_id){
//        $data = array();
        $query = $this->db->query("SELECT student_nam FROM student_info WHERE student_id=$student_id")->row();
        if ($query) {
            return $query->student_nam;
        }
        return false;
    } 
    public function PayReason($fee_id){
//        $data = array();
        $query = $this->db->query("SELECT title FROM fee_item WHERE id='$fee_id'")->row();
        if ($query) {
            return $query->title;
        }
        return false;
    }
    
    //This function will return student ID by user ID
    public function student_id($user_id){
        if($this->ion_auth->in_group(3)){
            $query = $this->db->query("SELECT student_id FROM student_info WHERE user_id=$user_id")->row();
            return $query->student_id;
        }elseif ($this->ion_auth->in_group(5)) {
            $query = $this->db->query("SELECT student_id FROM parents_info WHERE user_id=$user_id")->row();
            return $query->student_id;
        }
    }
    
    //class's short information will give this function 
    public function classInfo(){
        $data = array();
        $query = $this->db->query("SELECT class_title,student_amount,attendance_percentices_daily,attend_percentise_yearly FROM class");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

    function studentInfoId() {
        $maxid = 0;
        $row = $this->db->query('SELECT MAX(id) AS `maxid` FROM `student_info`')->row();
        if ($row) {
            $maxid = $row->maxid;
        }return $maxid;
    }

    public function getAllData($a) {
        $data = array();
        $query = $this->db->get($a);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
// echo"<pre>";
// print_r($data);exit;
        return $data;
    }

//zuel
    // public function getAllDataWithScholarship(){
    //     $this->db->select();
    // }

    public function getWhere($a, $b, $c) {
        $data = array();
        $query = $this->db->get_where($a, array($b => $c));
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        // echo "<pre>";
        // print_r($data);exit;
        return $data;
    }
    //zuel-05-08-18
    public function getWhere_grade($a) {
        $query =$this->db->select('*')->where('number_form <=',$a)->where('number_to >=',$a)->get('exam_grade')->result_array();
        return $query;
    }

    public function GetAll($a, $b, $c, $d) {
        $data = array();
        $this->db->order_by($d,"asc");
        $query = $this->db->get_where($a, array($b => $c));
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }
    public function getWhere22($a, $b, $c, $d, $e) {
        $data = array();
        $query = $this->db->get_where($a, array($b => $c, $d => $e));
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

    //THis function is take class title and make unic Roll nomber that class.
    //And return that roll number.
    public function rollNumber($a) {
        $query2 = $this->db->get_where('class_students', array('class_id' => $a));
        $qq = array();
        foreach ($query2->result_array() as $aa) {
            $qq[] = $aa;
        }
        $a = $qq;
        //return $a;
        $b = array();
        foreach ($a as $row) {
            $b[] = $row['roll_number'];
        }$c = $b;
        //return max($c);
        if (empty($a)) {
            $d = 1;
            return $d;
        } else {
            $c;
            $e = max($c);
            $e++;
            return $e;
        }
    }
	
	public function roll_Number_new()
	{
		$this->db->select('id');
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$Query = $this->db->get('student_info');
		
		if($Query->num_rows() > 0)
		{
			$roll = $Query->row()->id + 1;
			
			return $roll;
		}
		else
			{
				$roll = 0;
				$roll = $roll + 1;
				
				return $roll;
			}
	}
	//This function will check student_id in a class
	public function check_student_id($finalStudentId)
	{
		$this->db->select('id');
		$this->db->where('student_id',$finalStudentId);
		$student_id = $this->db->get('student_info');
		
		if($student_id->num_rows() > 0)
		{
			return TRUE;
		}
		else
			{
				return FALSE;
			}
	}
    //This function will return total student amount in a class
    public function classStudentAmount($id) {
        $data = array();
        $query = $this->db->get_where('class', array('id' => $id));
        foreach ($query->result_array() as $row) {
            $data = $row;
        }
        $b = $data['student_amount'];
        $c = $b + 1;
        return $c;
    }

    //This function is using for the get all and Teacher's notice by SQL where query.
    public function getTeacherNotice() {
        $data = array();
        $query = $this->db->query("SELECT * FROM notice_board WHERE receiver='teacher' OR receiver='all'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

    //This function is using for the get all and student's notice by SQL where query.
    public function getStudentNotice() {
        $data = array();
        $query = $this->db->query("SELECT * FROM notice_board WHERE receiver='student' OR receiver='all'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

    //This function is using for the get all Employe's and Accountends's notice by SQL where query.
    public function getEANotice() {
        $data = array();
        $query = $this->db->query("SELECT * FROM notice_board WHERE receiver='all'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

    //This function return school name
    public function schoolName() {
        $data = array();
        $query = $this->db->get('configuration');
        foreach ($query->result_array() as $row) {
            $data = $row['school_name'];
        }return $data;
    }

    //This function return currency class name
    public function currencyClass() {
        $data = array();
        $query = $this->db->get('configuration');
        foreach ($query->result_array() as $row) {
            $data = $row['currenct'];
        }return $data;
    }
    
    //This function will returan students information by id student_id
    public function stuInfoId($a)
    {
        $query = $this->db->query("SELECT user_id,class_id,student_nam,student_photo FROM student_info WHERE student_id = $a")->row();
        return $query;
    }

    public function stuScholarship($a)
    {
        $query = $this->db->query("SELECT amount FROM stu_scholarship WHERE student_id = $a")->row('amount');
        if ($query) { return $query;}
        return 0;
    }

    public function stuLastpay_date($stu_id)
    {
        $query = $this->db->select('to_date')->where('item_stu_id',$stu_id)->where('root_fee_type_id','1')->order_by('to_date','DESC')->limit(1)->get('student_fee_item');
        if ($query->num_rows()>0) {
            if ($query->row()->to_date==NULL) {
                return '---';
            }
            else{ return date('F',strtotime($query->row()->to_date)); }
        }
        return '---';
    }

    public function getTransport($trans) {
        $data = array();
        $this->db->select('t.rout_title, t.vicles_amount');
        $this->db->from('transport_assign ta');
        $this->db->join('transport t','ta.route_id=t.id','LEFT');
        $this->db->where('ta.student_id',$trans);
        $query= $this->db->get()->row();
        // print_r($query);exit;
        if ($query) {
            $data['trout']=$query->rout_title;
            $data['tamount']=$query->vicles_amount;
        }else{
            $data['trout']='';
            $data['tamount']=0;
        }
        return $data;
    }
    //This function will returan country code
    public function countryPhoneCode(){
        $query = $this->db->query("SELECT countryPhonCode FROM configuration")->row();
        return $query;
    }
    
    //This function will return teacher's list
    public function teacherAttendance(){
        $data = array();
        $year = date('Y');
        $date = strtotime(date("d-m-Y"));
        $query = $this->db->query("SELECT employ_title,present_or_absent,attend_time FROM teacher_attendance WHERE date=$date AND year = $year");
        foreach ($query->result_array() as $row){
            $data[] = $row;
        }
        return $data;
    }
    
    //This function will return class exam term
    public function examTerm($a){
        $preExamTerm = array();
        $query = $this->db->query("SELECT exam_term FROM set_fees WHERE class_id = '$a'");
        foreach ($query->result_array() as $row){
            $preExamTerm = $row['exam_term'];
        }
        if($preExamTerm == 0){
            $nextExamTerm = $preExamTerm + 1;
            return $nextExamTerm;
        }  elseif ($preExamTerm == 1) {
            $nextExamTerm = $preExamTerm + 1;
            return $nextExamTerm;
        }  elseif ($preExamTerm == 2) {
            $nextExamTerm = $preExamTerm + 1;
            return $nextExamTerm;
        }  else {
            $nextExamTerm = 1;
            return $nextExamTerm;         
        }
    }
    
    //This function will return fee amount from configaration by class
    public function feeAmount($col,$classTitle){
        $data = array();
        $query = $this->db->query("SELECT $col FROM set_fees WHERE class_title = '$classTitle'");
//      return $query->$col;
        foreach ($query->result_array() as $row){
            $data = (int) $row[$col];
        }
        $value = $data;
        return $value;
    }
    
    //This function will return only have any entry by this current date
    public function cashBookyes($table){
        $data = array();
        $date = strtotime(date('d-m-Y'));
        $query =  $this->db->query("SELECT id FROM $table WHERE date=$date ORDER BY id DESC LIMIT 1");
        foreach ($query->result_array() as $row){
            $data = $row['id'];
        }
        if(!empty($data)){
            return $data;
//            return TRUE;
        }  else {
            return FALSE;
        }
    }
    
    //This function will return cash book item previous value
    public function cashBookItem($si,$table){
        $data = array();
        $date = strtotime(date('d-m-Y'));
        $query =  $this->db->query("SELECT $si FROM $table WHERE date=$date ORDER BY id DESC LIMIT 1");
        foreach ($query->result_array() as $row){
            $data = $row["$si"];
        }
        return $data;
    }
    
    //This function will return only class list from "class" table.
    public function classList(){
        $data = array();
        $query = $this->db->query("SELECT class_title FROM class");
        foreach ($query->result_array() as $row){
            $data[] = $row['class_title'];
        }return $data;
    }
    
    //This function will return final exam by it's class name 
    public function finalExam($classTitle){
        $data =array();
//        $query  = $this->db->query("SELECT id FROM add_exam WHERE class_title='$classTitle' AND final='Final' AND publish='Publish'");
        $query  = $this->db->query("SELECT id FROM add_exam WHERE class_title='$classTitle' AND final='Final'");
        foreach ($query->result_array() as $row){
            $data[] = $row['id'];
        }
        return $data;
    }
    
    //This function will return class potional subjects
    public function class_os($class_title)
    {
        $data = array();
        $query = $this->db->query("SELECT id,subject_title FROM class_subject WHERE class_title='$class_title' AND optional = 1");
        foreach ($query->result_array() as $row)
        {
            $data[] = $row;
        }
        return $data;
    }
    //This function will show user group name
    public function group_name($gid){
        $data = array();
        $query = $this->db->query("SELECT name FROM groups WHERE id=$gid");
        foreach ($query->result_array() as $row){
            $group_name = $row['name'];
        }
        return $group_name;
    }



/**************************** Account New Section by Saleah ***************************/

    // common fatch query for normal fatch from one table all data
    public function fatch_all_data($table_name){
        $sql = "SELECT * FROM $table_name";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
    } 

    public function get_account_head_data($category_id){
        $sql = "SELECT * FROM accounts_head WHERE category_id =' $category_id' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
    }

    //This function show the class title for class selecting class
    public function get_all_category(){
        $data = array();
        $query = $this->db->query('SELECT * FROM category');
        foreach ($query->result_array() as $row){
            $data[] = $row;
        }
        return $data;
    }  

    public function numberConvertionBtE($number)
    {
        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $en_number = str_replace($search_array, $replace_array, $number);

        return $en_number;
    }
    public function numberConvertionEtB($number)
    {
        $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $bn_number = str_replace($search_array, $replace_array, $number);

        return $bn_number;
    }


    function fee_type_root_id($fee_item) {
        $query = $this->db->query('SELECT fee_type_id FROM fee_item WHERE id='.$fee_item);
        foreach ($query->result_array() as $row){
            $data = $row['fee_type_id'];
        }
        return $data;
    }


    public function get_items(){
      $data[''] = '-- Select Item --';
      $this->db->select('id, item_name');
      $this->db->from('inventory_item');
      // $this->db->where('is_current',1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['item_name'];
      }        
      return $data;
   }

   public function get_item_sale_yes() {
        $data = array();
        $this->db->where('item_is_sale', 'Yes');
        $query = $this->db->get('inventory_item');

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }return $data;
    }

    public function transport_assign_list() {
        $this->db->select('t.*, tr.rout_title, s.student_nam, c.class_title, u.first_name, u.last_name');
        $this->db->from('transport_assign t');
        $this->db->join('transport tr', 'tr.id=t.route_id');
        $this->db->join('student_info s', 's.student_id=t.student_id');
        $this->db->join('class c', 'c.id=t.class_id');
        $this->db->join('users u', 'u.id=t.user_id');

        // if($this->input->get('class') != NULL){
        //     $this->db->where('t.class_id', $this->input->get('class'));     
        // }

        $query = $this->db->get()->result();

        return $query;
    }
//zuel 
    public function transportAll() {
        $this->db->select('t.*, tr.start_end');
        $this->db->from('transport t');
        $this->db->join('transport_route tr', 'tr.id=t.start_end');
        // $this->db->join('student_info s', 's.student_id=t.student_id');
        // $this->db->join('class c', 'c.id=t.class_id');
        // $this->db->join('users u', 'u.id=t.user_id');

        // if($this->input->get('class') != NULL){
        //     $this->db->where('t.class_id', $this->input->get('class'));     
        // }

        $query = $this->db->get()->result_array();
// print_r($query);exit;
        return $query;
    }

    public function listScholarship() {
        $this->db->select('ss.*, s.student_nam, c.class_title, u.first_name, u.last_name');
        $this->db->from('stu_scholarship ss');
        $this->db->join('class c', 'c.id=ss.class_id');
        $this->db->join('student_info s', 's.student_id=ss.student_id');
        $this->db->join('users u', 'u.id=s.user_id');

        // if($this->input->get('class') != NULL){
        //     $this->db->where('t.class_id', $this->input->get('class'));     
        // }

        $query = $this->db->get()->result();
        // echo"<per>";
        // print_r($query);exit;
        return $query;
    }



}
