<?php
$link = mysql_connect('173.212.223.213', 'admin_srps', 'MxOphgXCTs');
mysql_select_db('admin_sr_patuary_inst');


include 'SMSClient.php';
$client = new SMSClient('1587652994', '^Rl:_w=[', 'http://www.sms4bd.net');

$query_select = "SELECT * FROM massage WHERE is_message_sent = 0";
$result_select = mysql_query($query_select) or die(mysql_error());
$rows = array();

while($row = mysql_fetch_array($result_select)){
    $rows[] = $row;
    foreach($rows as $row){ 

        $receiver_id = $row['receiver_id'];
        $message_id = $row['id'];

        $receiverData = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '$receiver_id' LIMIT 0,1 "));

        if(!empty($receiverData)){
			$mobile_no = $receiverData["phone"];
        }else{
        	$receiverData = mysql_fetch_array(mysql_query("SELECT * FROM student_info WHERE student_id = '$receiver_id' LIMIT 0,1 "));
			$mobile_no = $receiverData["phone"];
        }

        $messageData = mysql_fetch_array(mysql_query("SELECT * FROM massage WHERE id = '$message_id' LIMIT 0,1 "));
        $id = $messageData["id"];
		$message = $messageData["message"];
		$subject = $messageData["subject"];
	  // echo '<br><br>'.$receiver_id;
      //  echo '<br>'.$phone;
      //  echo '<br>'.$subject;
      //  echo '<br>'.$message;
      //  echo '<hr>';  //exit;

 
        //$mobile_no = substr($mobile_no, -11); //exit; 

        $response = $client->SendSMS("softheaven", $mobile_no, $message, date('Y-m-d H:i:s'), SMSType::UCS2);
        $result = $response->StatusMessage;  

        if($result =='Accepted'){
            $messageData = mysql_query("UPDATE massage SET is_message_sent = 1 WHERE id = '$id' ");
        }else{

            $messageData = mysql_query("UPDATE massage SET is_message_sent = 1 WHERE id = '$id' ");
        }
    }
}

mysql_close($link);
echo time();
?>
<script language="javascript">setTimeout(function(){ location.replace('http://<?=$_SERVER['HTTP_HOST']?><?=$_SERVER['PHP_SELF']?>?<?=time()?>')}, 5000);</script>