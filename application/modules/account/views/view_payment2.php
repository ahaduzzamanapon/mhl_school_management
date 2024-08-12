<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/><!-- 
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
<!-- END PAGE LEVEL STYLES -->

<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('header_stu_payme'); ?><small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_account'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_stu_payme'); ?>
                    </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <div class="portlet-body form">
            <?php
                if (!empty($success)) {
                      echo $success;
                }
                $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                echo form_open_multipart('account/ViewPayment', $form_attributs);
            ?>
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-6 control-label"><?php echo lang('admi_Class'); ?> <span class="requiredStar">  </span></label>
                    <div class="col-md-6">
                        <select name="class_id" id="class" class="form-control" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Class_error_msg'); ?>">
                            <option value=""><?php echo lang('admi_select_class'); ?></option>
                            <?php foreach ($s_class as $row) {
                                if ($classId==$row['id']) {
                                    $selected = 'selected="selected"';
                                }else{$selected = '';}
                             echo <<<EOM
                            <option value={$row['id']} {$selected} >{$row['class_title']}</option>
EOM;
                        } ?>
                        </select>
                    </div>
                </div>

                <div id="stdId"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label">Student Id <span class="requiredStar"> * </span></label>
                    <div class="col-md-6" id="studentId">
                    <input type="text" name="studentId" id="studentId" value="<?php echo $studentId;?>">
                    </div>
                </div> 

            </div>
             <div class="form-body">
                <div class="form-group">
                    <label class="col-md-6 control-label"><?php echo lang('fee_item'); ?> <span class="requiredStar">  </span></label>
                    <div class="col-md-6">
                        <select name="item" id="item" class="form-control" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Class_error_msg'); ?>">
                            <option value="">Select One</option>
                            <?php foreach ($fee_item as $row) { 
                                if ($item==$row['id']) 
                                    $selected = 'selected="selected"';
                                else
                                    $selected = '';
                                echo <<<EOM
                                <option value={$row['id']} {$selected}>{$row['title']}</option>
EOM;
                                
                            } ?>
                        </select>
                    </div>
                </div>
            </div>

             <!--<div class="form-group">
                <label class="control-label col-md-6"> Date <span class="requiredStar"> * </span></label>
                <div class="col-md-6">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" name="startDate" class="form-control" readonly value="<?php echo $startDate;?>">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" name="endDate" class="form-control" value="<?php echo $endDate;?>">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-md-6 control-label"> Date Duration <span class="requiredStar">  </span></label>
                <div class="col-md-6">
                    <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
                        <input type="text" class="form-control" name="startDate" value="<?php echo $from; ?>">
                        <span class="input-group-addon">
                            <?php echo lang('acc_to'); ?> </span>
                        <input type="text" class="form-control" name="endDate" value="<?php echo $to; ?>">
                    </div><br>
                </div>
            </div>

            <div class="form-actions fluid">
                <div class="col-md-offset-3 col-md-6">
                    <button id="submit" type="submit" class="btn green" name="search" value="Submit">Submit</button>
                    <button type="reset" class="btn default"> <?php echo lang('refresh'); ?> </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                }
                $sum = 0; 
                foreach ($fees as $row) { 
                    $sum = $sum + $row['payment'];
                }
                echo 'Total Paid: '.$sum;
                ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php echo lang('acc_stsl'); ?>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table id="sample_1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>
                                        S.N.
                                    </th>
                                    <th>
                                        Class
                                    </th>
                                    <th>
                                        Student
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Reason
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        Fine
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                    <th>
                                        Paid
                                    </th>
                                    <th>
                                        Due
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 foreach ($fees as $row) { 
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $this->common->class_title($row['class_id']); ?>
                                        </td>
                                        <td>
                                            <a href="index.php/account/studentPaymentHistory?stuid=<?php echo $row['student_id']; ?>"> <?php echo $row['student_id']; ?> </a>
                                        </td>
                                        <td>
                                            <?php echo $this->common->student_title($row['student_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo $this->common->PayReason($row['fee_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo $row['amount']; ?>
                                        </td>
                                        <td>
                                           <?php echo $row['fine']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['total']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['payment']; ?>
                                        </td>                                       
                                        <td style="color:red; font-size: 16px; font-weight: bold;">
                                            <?php echo $row['due']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['created_at']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['status']; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <!-- <?php if($row['status']=='Unpaid'||$row['status']=='Not Clear'){ ?>
                                                            <li class="ac_in_sty">
                                                                <a href="index.php/account/fee_pay?sid=<?php echo $row['id']; ?>"> Take Payment </a>
                                                            </li>
                                                        <?php }?> --><!-- 
                                                        <li class="ac_in_sty">
                                                            <a href="index.php/account/view_invoice?sid="> View Invoice </a>
                                                        </li> -->
                                                        <li class="ac_in_sty">
                                                            <a href="index.php/account/edit_fee_pay?sid=<?php echo $row['id']; ?>"> Edit </a>
                                                        </li>
                                                        <li class="ac_in_sty">
                                                            <a href="index.php/account/delete?sid=<?php echo $row['id']; ?>"> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<!-- <script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script> -->
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>


<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>

    <script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script src="assets/admin/pages/scripts/components-pickers.js"></script>


<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script>
    
    jQuery(document).ready(function () {

        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
        ComponentsPickers.init();
    });

</script>

<script>
    function classInfo(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("stdId").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("stdId").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/account/student?q=" + str, true);
        xmlhttp.send();
    }
   /* function classInfo(str) {
        //var classId = $("#class").val();
        return $.ajax({
                    url: "index.php/account/student",
                    data: { classId: str },
                    dataType: "json",
                    success:function(response_data_json) {
                        var studentInfo = JSON.stringify(response_data_json);
                        var studentInfo = jQuery.parseJSON(studentInfo);
                        console.log(studentInfo);
            }
         });
    }*/

    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>