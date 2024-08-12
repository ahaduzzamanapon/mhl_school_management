<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Setup Scholarship
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> Setting </li>
                    <li> Setup Scholarship </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!--END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> Assign Scholarship
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                            $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                            echo form_open_multipart('configuration/setScholarship', $form_attributs);
                            
                            if (!empty($message)) {
                                  echo $message;
                            }
                        ?>
                        <div class="form-body">
                            <div class="formField" style="display: block;">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('admi_Class'); ?> <span class="requiredStar"> * </span></label>

                                    <div class="col-md-6">
                                        <select name="class_id" id="class" onchange="classInfo(this.value)" class="form-control" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Class_error_msg'); ?>">
                                            <option value=""><?php echo lang('admi_select_class'); ?></option>
                                            <?php foreach ($s_class as $row) { ?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['class_title']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="txtHint"></div>
                          </div>

                          <div style="clear:both;"></div>
                        </div>

                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button id="submit" type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                 <!-- <button type="button" class="btn yellow" data-toggle="modal" data-target="#myModal">Preview</button> -->
                                <!-- <input id="print" class="btn blue" type="button" onclick="printDiv('myModal')" value="Print" /> -->
                                <!-- <button id="refresh" type="reset" class="btn default"> <?php echo lang('refresh'); ?> </button> -->
                            </div>
                        
                        <?php echo form_close(); ?>
                    </div>

                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<!-- BEGIN PAGE LEVEL script -->
<script >
    function sch_cal(val){
        // alert(val);
        if (val=='Half Free') {
            var amt=($('#sho_amount').val())/2;
            $('#final_amount').html('<input style="border: solid red 1px; text-align:center;" type="number" value="'+amt+'" name="custome_amt" readonly>');
        }else if (val=='Full Free') {
            var amt=$('#sho_amount').val();
            $('#final_amount').html('<input style="border: solid red 1px; text-align:center;" type="number" value="'+amt+'" name="custome_amt" readonly>');
        }else if (val=='Fixed Amount') {
            var amt=$('#sho_amount').val();
            $('#final_amount').html('<input style="border: solid red 1px; text-align:center;" type="number" value="" name="custome_amt" placeholder="Enter the amount">');
        }
        else{
            alert('Select Scholarship Type!');
        }
    }
</script>
<script>
/*
    function studentInfo(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("ajaxResult").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/transport/studentInfoById?q=" + str, true);
        xmlhttp.send();
    }
    */

    function classInfo(str) {
        $("#arButton").show();
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("txtHint").innerHTML = "";
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
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/configuration/student_id?q=" + str, true);
        xmlhttp.send();
    }

    jQuery(document).ready(function () {
    //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });

    $("#stdId").bind("change keyup", function(event){
        studentInfo(this.value);
    });
</script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END PAGE LEVEL script -->
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>

<script> $.validate();</script>

<script>
    

    function studentInfo(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("ajaxResult").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/transport/studentInfoById?q=" + str, true);
        xmlhttp.send();
    }
</script>


<script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>