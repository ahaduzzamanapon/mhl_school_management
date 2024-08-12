<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('con_set_fee'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('con_configu'); ?>
                    </li>
                    <li>
                        <?php echo lang('con_set_st_fee'); ?>
                    </li>
                    <li>
                        Edit
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
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"> Edit Fee Type Information </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open('configuration/fee_type_edit', $form_attributs);
                        ?>
                        <div class="form-body">
                            <?php
                            if (!empty($successMessage)) {
                                echo $successMessage;
                            }
                            
                            //print_r($info); //exit;
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Fee Type Title </label>
                                    <div class="col-md-8">
                                        <input type="text" name="fee_title" placeholder="" value="<?=set_value('fee_title', $info[0]['fee_title'])?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>                            
                            <div class="clearfix"></div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Payment Type </label>
                                    <div class="col-md-8">
                                        <?php echo form_dropdown('pay_type',$payment_type, $info[0]['pay_type']); ?>
                                    </div>
                                </div>
                            </div> 
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"> Status </label>
                                    <div class="col-md-8">
                                        <input type="radio" name="status" id="" class="group_control" value="1" <?=set_value('is_current', $info[0]['status'])==1?'checked':'';?>> Enable &nbsp;&nbsp;
                                        <input type="radio" name="status" id="" class="group_control" value="0" <?=set_value('is_current', $info[0]['status'])==0?'checked':'';?>> Disable
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <input type="hidden" name="hide_id" value="<?=$info[0]['id']?>">
                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                <button class="btn default" onclick="javascript:history.back()" type="button">Go Back</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<script>
    jQuery(document).ready(function() {
//here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
