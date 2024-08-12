<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <?php

        foreach ($rutineInfo as $row) {
            $ID = $row['id'];
           //echo $examID = $row['exam_id'];exit;
            //echo $row['exam_date'];exit;
        }
         $examID = $this->input->get('examId');
        ?>
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <!-- <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i>  <?php echo lang('exa_mr_1') . ' ' . $examTitle . lang('exa_mr_1'); ?>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div> -->
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open("examination/editCompletExamRoutin?rid=$ID", $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($successMessage)) {
                                echo $successMessage;
                            }
                            ?> 
                            <div class="alert alert-info">
                                <div class="form-group">
                                    <div id="div_scents">
                                        <div class="row">
                                            <div class="col-md-12">

                                            <input type="hidden" class="form-control" value="<?php echo $examID; ?>" name="examId">
                                                <input type="hidden" class="form-control" value="<?php echo $ID; ?>" name="routineId">
                                                <h3 class="arpl"><?php echo lang('exa_exam'); ?> 1</h3>
                                                <input type="hidden" class="form-control" name="examSunjectFild" value="run">
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control date-picker" id="mask_date2" placeholder="<?php echo lang('exa_ddmmyy'); ?>" value="<?php echo $row['exam_date']; ?>" name="examDate" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="day" data-validation="required" data-validation-error-msg="">
                                                        <option class="claasSelectBGColor"  value="<?php echo $row['exam_day']; ?>"><?php echo $row['exam_day']; ?></option>
                                                        <?php foreach ($weeklyDay as $row2) { ?>
                                                            <option class="<?php echo $row2['status']; ?>" value="<?php echo $row2['day_name']; ?>"><?php echo $row2['day_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="subject" data-validation="required" data-validation-error-msg="">
                                                       <!-- <option><?php echo lang('exa_ss'); ?></option>-->
                                                       <option class="claasSelectBGColor"  value="<?php echo $row['exam_subject']; ?>"><?php echo $row['exam_subject']; ?></option>
                                                        <?php foreach ($subject as $row1) { ?>
                                                            <option value="<?php echo $row1['subject_title']; ?>"><?php echo $row1['subject_title']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_sub_code'); ?>" name="subjectCode" value="<?php echo $row['subject_code']?>" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="Room No" name="romeNo" value="<?php echo $row['rome_number']?>" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_start_time'); ?>" name="starTima" value="<?php echo $row['start_time']?>" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <input type="text" class="form-control" placeholder="<?php echo lang('exa_end_time'); ?>" name="endTima" value="<?php echo $row['end_time']?>" data-validation="required" data-validation-error-msg="">
                                                </div>
                                                <div class="col-md-2 classGroupInput">
                                                    <select class="form-control" name="examShift">
                                                    <option class="claasSelectBGColor"  value="<?php echo $row['exam_shift']; ?>"><?php echo $row['exam_shift']; ?></option>
                                                        <option><?php echo lang('exa_morn_shi'); ?></option>
                                                        <option><?php echo lang('exa_even_shi'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="addRoutineSubject col-md-12">
                                    <a id="addGroup" class="floatRight btn green">
                                        <i class="fa fa-plus"></i> <?php echo lang('exa_nexar'); ?>
                                    </a>
                                </div><div class="clearfix"> </div> -->
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="submit"><?php echo "Update"; ?></button>
                                
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
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script> $.validate();</script>


<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   
    <script type="text/javascript">
     /*   jQuery(document).ready(function () {
            //here is auto reload after 1 second for time and date in the top

            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    format: "dd/mm/yyyy"
}).datepicker("setDate", new Date());
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            }
        });
        function datepicker_own(){
                 if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    format: "dd/mm/yyyy"
}).datepicker("setDate", new Date());
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            }
      } */
    </script>
