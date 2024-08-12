<?php
	$servername = "localhost";
	$username = "root";
	$password = "msh@123";

	date_default_timezone_set("Asia/Dhaka");

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "school_db_2");

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$today = date('Y-m-d');

	$weekday_today = date('l');

	$timedate_today = date('Y-m-d H:i:s');

	//fetch todays status to check weekday or not
	$weekday_query = "SELECT status FROM config_week_day WHERE day_name = '$weekday_today'";
	if(!$result_weekday = mysqli_query($conn, $weekday_query))
		echo mysqli_error($conn);

	$row_weekday = $result_weekday->fetch_assoc();
	if($row_weekday['status'] != 'Open')
	{
		echo "Today is $weekday_today! A Weekday!! Hurrayyyy!!!";
		die; 
	}

	//fetch students who are absent today
	$query = "SELECT A.*, B.user_id AS parent_id FROM student_info AS A 
					INNER JOIN parents_info AS B ON A.student_id = B.student_id 
					WHERE A.student_id NOT IN (SELECT student_id FROM daily_attendance AS C 
													WHERE C.date = '$today') LIMIT  2";


	mysqli_autocommit($conn, FALSE);

	$result = mysqli_query($conn, $query);
	
	$flag = TRUE;
	while($row = $result->fetch_assoc())
	{	
		$msg_query = "INSERT INTO massage (sender_id, receiver_id, message, subject, is_message_sent, created_at) VALUES('1'," . $row['parent_id'] . ", 'Your child is absent Today ($today)', 'Student Absent', '0', '$timedate_today')";

		if(mysqli_query($conn, $msg_query))
			continue;
		else
		{
			echo 'Failed! ' . mysqli_error($conn);
			$flag = FALSE;
			break;
		}
	}

	if($flag)
	{
		echo 'Success Once Again';
		mysqli_commit($conn);
	}
	else
	{
		mysqli_rollback($conn);
	}

?>