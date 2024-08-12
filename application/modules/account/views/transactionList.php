
<?php $user = $this->ion_auth->user()->row();
$userId = $user->id; ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo 'Transaction List'; ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                        
                    </li>
                    <li>
                        <?php echo 'Transaction List'; ?>
                        
                    </li>

                    <li id="result" class="pull-right topClock"></li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->    


         <?php if($this->session->flashdata('message')) { ?>
            <div class="alert alert-success" id="mydiv">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <span><?php if($this->session->flashdata('message')) {
            echo '<div class="message"> ';
            echo ''.$this->session->flashdata('message').'';
            //$this->session->keep_flashdata('message');
            echo'</div>';
            } ?></span> 
            </div> 
            <?php } ?>

            <?php if($this->session->flashdata('danger')) { ?>
            <div class="alert alert-danger" id="mydivdanger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <span><?php if($this->session->flashdata('danger')) {
            echo '<div class="danger"> ';
            echo ''.$this->session->flashdata('danger').'';
            //$this->session->keep_flashdata('message');
            echo'</div>';
            }?></span> 
            </div>    
            <?php } ?>

            <script>
            setTimeout(function() {
            $('#mydivdanger').fadeOut('fast');
            }, 4000); // <-- time in milliseconds
            </script>


        <!-- BEGIN PAGE CONTENT-->        
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
               


                    <div class="portlet-body form">
                        <div class="col-md-6">
                            <div class="portlet box purple margin-bottom-15">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Based on Account Type
                                    </div>
                                    <div class="tools">
                                        <a class="collapse" href="javascript:;">
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <?php
                                    //$form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                                    //echo form_open('account/account_type_transection', $form_attributs);
                                    ?>
                                    <div class="form-body">
                                        <?php
                                        if (!empty($message)) {
                                            echo '<br>' . $message;
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Account Type <span class="requiredStar"> * </span></label>
                                            <div class="col-md-9">
                                                <select required class="form-control" id="category_id" name="category_id" data-validation="required" data-validation-error-msg="<?php echo lang('acc_psaaf'); ?>">
                                                    <?php foreach ($category as $row) { ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                                    <?php } ?>
                                                </select><br>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Time Duration<span class="requiredStar">  </span></label>
                                            <div class="col-md-9">

                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInput()" name="time_duration"  value="1"> Today    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInput()" name="time_duration"  value="2"> Yesterday    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInput()" name="time_duration"  value="3"> This Month    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInput()" name="time_duration"  value="4"> Last Month    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInput()" name="time_duration"  value="5"> This Year    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInput()" name="time_duration"  value="6"> Last Year    <br>
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Date Duration <span class="requiredStar">  </span></label>
                                            <div class="col-md-9">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                                    <input id="date0ne" type="text" onkeyup="clearRadio()" class="form-control" name="from">
                                                    <span class="input-group-addon">
                                                        <?php echo lang('acc_to'); ?> </span>
                                                    <input id="datetwo" type="text" onkeyup="clearRadio()" class="form-control" name="to">
                                                </div><br>
                                            </div>
                                        </div>
                                        <div class="form-actions bottom fluid ">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn green" id="submit1" name="expense" type="text" value="Submit"><?php echo lang(''); ?>Submit</button>
                                                <button class="btn red" type="reset"><?php echo lang('refresh'); ?></button>
                                            </div>
                                        </div>
                                        <?php //echo form_close(); ?>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet box blue  margin-bottom-15">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Based on account head and sub head
                                    </div>
                                    <div class="tools">
                                        <a class="collapse" href="javascript:;">
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <?php
                                    //$form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                                    //echo form_open('account/transection', $form_attributs);
                                    ?>
                                    <div class="form-body">
                                        <?php
                                        if (!empty($message)) {
                                            echo '<br>' . $message;
                                        }
                                        ?>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Account Head <span class="requiredStar"> * </span></label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="accounts_head_id" name="accounts_head_id" data-validation="required" data-validation-error-msg="<?php echo lang('acc_psaaf'); ?>">
                                                    <option value=""><?php echo lang('select'); ?></option>
                                                    <?php foreach ($accounts_head as $row) { ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['accounts_head_name']; ?></option>
                                                    <?php } ?>
                                                </select><br>
                                            </div> 
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Account Sub Head <span class="requiredStar"> * </span></label>
                                            <div class="col-md-9">
                                                <select class="accounts_sub_head_id form-control" id="accounts_sub_head_id" name="accounts_sub_head_id" data-validation="required" data-validation-error-msg="<?php echo lang('acc_psaaf'); ?>">

                                                </select><br>
                                            </div> 
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Time Duration<span class="requiredStar">  </span></label>
                                            <div class="col-md-9">

                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInputData()" name="time_duration" id="Today" value="1"> Today    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInputData()" name="time_duration" id="Yesterday" value="2"> Yesterday    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInputData()" name="time_duration" id="ThisMonth" value="3"> This Month    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInputData()" name="time_duration" id="LastMonth" value="4"> Last Month    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInputData()" name="time_duration" id="ThisYear" value="5"> This Year    <br>
                                                </label>                                                
                                                <label class="radio">
                                                <input type="radio" onclick="takeRadioInputData()" name="time_duration" id="LastYear" value="6"> Last Year    <br>
                                                </label>

                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Date Duration <span class="requiredStar">  </span></label>
                                            <div class="col-md-9">
                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                                    <input id="date0ne1" type="text" class="form-control" name="from">
                                                    <span class="input-group-addon">
                                                        <?php echo lang('acc_to'); ?> </span>
                                                    <input id="datetwo1" type="text" class="form-control" name="to">
                                                </div><br>
                                            </div>
                                        </div>


                                        <div class="form-actions bottom fluid ">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn green" id="submit2" name="expense" type="text" value="Submit"><?php echo lang(''); ?>Submit</button>
                                                <button class="btn red" type="reset"><?php echo lang('refresh'); ?></button>
                                            </div>
                                        </div>
                                        <?php //echo form_close(); ?>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <br><br>

                    <?php //echo $today = date('Y-m-d H:i:s.'); ?>

                    <!-- <div id="printArea"> -->
                        <div id="transaction_list_part"></div>    
                    <!-- </div> -->                    

           
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
            //jQuery("#result").load("index.php/home/iceTime");
        }, 1000));


        $( "#submit1" ).click(function() {
          var category_id = $('#category_id').val();
          var date0ne = $('#date0ne').val();
          var datetwo = $('#datetwo').val();
          var time_duration = $('input[name=time_duration]:checked').val();

          //alert(time_duration);



          if(time_duration == '' && (date0ne== '' || datetwo == '')){ 
            alert('Please Select a Time Duration or Date First');
          }else{
            $("#transaction_list_part").load("<?php echo base_url(); ?>index.php/account/getAccTypeTransaction/", {category_id:category_id, time_duration:time_duration, date0ne:date0ne, datetwo:datetwo}); 
          }

          //var category_id = $('#').val();
        });


        $( "#submit2" ).click(function() {

          var accounts_head_id = $('#accounts_head_id').val();
          var accounts_sub_head_id = $('#accounts_sub_head_id').val();
          var date0ne = $('#date0ne1').val();
          var datetwo = $('#datetwo1').val();
          var time_duration = $('input[name=time_duration]:checked').val();


          //var time_duration = $('input[name=time_duration]:checked').val();

        if(time_duration == '' && (date0ne== '' || datetwo == '')){ 
            alert('Please Select a Time Duration or Date First');
          }else{
            $("#transaction_list_part").load("<?php echo base_url(); ?>index.php/account/getAccHeadTypeTransaction/", {accounts_head_id:accounts_head_id, time_duration:time_duration, accounts_sub_head_id:accounts_sub_head_id, date0ne:date0ne, datetwo:datetwo}); 
          }

          //var category_id = $('#').val();
        });



       $( "#accounts_head_id" ).change(function() {

           var accounts_head_id = $('#accounts_head_id').val();

           $('select.accounts_sub_head_id').html('<option>-Select-</option>');


                $.ajax({
                      url: "<?php echo base_url(); ?>" + "index.php/account/getAccountSubHeadData",
                      type: "POST",
                      data: {accounts_head_id: accounts_head_id},
                      async: false,
                      success: function (data) {

                        $('select.accounts_sub_head_id').append(data);

                      },
                      error: function(xhr, status, error) {
                        alert('error');
                      }
                });




        });



    });


    function takeRadioInput(){
        $('#date0ne').val('');
        $('#datetwo').val('');
    }

    function clearRadio(){
        alert('kkk');
        $('#Today').attr('checked', false);
        $('#Yesterday').attr('checked', false);
        $('#ThisMonth').attr('checked', false);
        $('#LastMonth').attr('checked', false);
        $('#ThisYear').attr('checked', false);
        $('#LastYear').attr('checked', false);
    }


    function takeRadioInputData(){
        $('#date0ne1').val('');
        $('#datetwo1').val('');
    }




</script>


<!-- BEGIN PAGE LEVEL STYLES -->



<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN CONTENT -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/admin/pages/scripts/components-pickers.js"></script>

   
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="assets/admin/pages/scripts/table-advanced.js"></script>
    <script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
    <script> $.validate();</script>
    <script>
        
        jQuery(document).ready(function () {

            //here is auto reload after 1 second for time and date in the top
            jQuery(setInterval(function () {
                jQuery("#result").load("index.php/home/iceTime");
            }, 1000));
            ComponentsPickers.init();
        });

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


