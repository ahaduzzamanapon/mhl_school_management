<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('par_mpp'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_stu_paren'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_parent_info'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_give_pare_acc'); ?>
                    </li>
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
                            <i class="fa fa-bars"></i> <?php echo lang('par_gppi'); ?>
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
                        if (!empty($success)) {
                              echo $success;
                        }
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open_multipart('users/addParents', $form_attributs);
                        ?>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo lang('admi_Class'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <select name="class_id" onchange="classInfo(this.value)"  id="class" class="form-control" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Class_error_msg'); ?>">
                                        <option value=""><?php echo lang('admi_select_class'); ?></option>
                                        <?php foreach ($s_class as $row) { ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['class_title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div id="txtHint">

                            </div>
                            
                            <div id="ajaxResult">
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('par_gafn'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="" name="first_name" data-validation="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('par_galn'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="" name="last_name" data-validation="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('par_rela'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="" name="guardianRelation" data-validation="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('par_email'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" onkeyup="checkEmail(this.value)" placeholder="<?php echo lang('par_email_plase'); ?>" name="email" data-validation="required email">
                                    <div id="checkEmail" class="col-md-12"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('par_pass'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" placeholder="<?php echo lang('par_pw8t20c'); ?>" name="password"  data-validation="required">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('par_con_pass'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-6">
                                    <input type="password" id="password_confirm" class="form-control" placeholder="<?php echo lang('par_pgtsp'); ?>" name="password_confirm" data-validation="required">
                                    <div style="display: none;" class="alert alert-warning password-alert">
                                      <strong>Warning!</strong> Sorrry! Password have to be matched!
                                    </div>

                                </div>
                                

                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> <?php echo lang('par_pho_num'); ?> <span class="requiredStar"> * </span></label>

                                <div class="col-md-1">
                                    <input readonly="true" type="text" class="form-control" value="88" name="phoneCode" placeholder="<?php echo lang('par_pcod'); ?>"  data-validation="required" data-validation-error-msg="" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" onkeypress='validate_mobile(event)' name="phone" placeholder=""  data-validation="required" data-validation-error-msg="">
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3"> <?php echo lang('par_gur_pho'); ?> <span class="requiredStar"> * </span></label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail uploadImagePreview">
                                        </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> <?php echo lang('par_sel_img'); ?> </span>
                                                <span class="fileinput-exists"><?php echo lang('par_change'); ?> </span>
                                                <input type="file" name="userfile" data-validation="required">
                                            </span>
                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> <?php echo lang('par_remove'); ?> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button id="submit" type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                <button type="reset" class="btn default"> <?php echo lang('refresh'); ?> </button>
                            </div>
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
        xmlhttp.open("GET", "index.php/users/studentInfoById?q=" + str, true);
        xmlhttp.send();
    }

    function classInfo(str) {
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
        xmlhttp.open("GET", "index.php/users/student_id?q=" + str, true);
        xmlhttp.send();
    }

    function checkEmail(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("checkEmail").innerHTML = "";
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
                document.getElementById("checkEmail").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/commonController/checkEmail?val=" + str, true);
        xmlhttp.send();
    }
    jQuery(document).ready(function () {
    //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });


        function validate_mobile(evt) {

          var theEvent = evt || window.event;
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode( key );
          var regex = /[0-9]|\./;
          if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
          }
        }

    $("#studentId").bind("change keyup", function(event){
        studentInfo(this.value);
    });

    $("#password_confirm").change(function(){
        var pass = $('#password').val();
        var c_pass = $('#password_confirm').val();
        if (pass!=c_pass) {
            $(".password-alert").show();
            $("#submit").prop("disabled",true);
        }
        else{
            $(".password-alert").hide();
            $("#submit").prop("disabled",false);
        }
    });

    $("#password").change(function(){
        var c_pass = $('#password_confirm').val();
        if (c_pass!='') {
            var pass = $('#password').val();
       
            if (pass!=c_pass) {
                $(".password-alert").show();
                $("#submit").prop("disabled",true);
            }
            else{
                $(".password-alert").hide();
                $("#submit").prop("disabled",false);
            }
        }
        
    });


</script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END PAGE LEVEL script -->
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script> $.validate();</script>

