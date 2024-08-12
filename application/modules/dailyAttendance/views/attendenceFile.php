<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('att_scfa'); ?> <small></small>
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
                        <?php echo lang('header_attendance'); ?>
                    </li>
                    <li>
                    Attendance File
                    </li>
                    <li id="result" class="pull-right topClock"></li>

                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content">
                    <div id="tab_0" class="tab-pane active">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php echo lang('att_scasfa'); ?>
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;">
                                    </a>
                                    <a class="reload" href="javascript:;">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <?php
                                $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data');
                                echo form_open_multipart('dailyAttendance/attendance_file_upload', $form_attributs);
                                ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="upload_file"> Attendance File</label>
                                            <input type="file" name="upload_file">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="userfile"> Attendance date</label>
                                            <input type="date" name="upload_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-actions bottom fluid ">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn green" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang('att_submit'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>                  
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END CONTENT -->

