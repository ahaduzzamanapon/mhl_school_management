<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/><!-- 
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
<!-- END PAGE LEVEL STYLES -->

<?php $user = $this->ion_auth->user()->row(); $userId = $user->id;?>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title">
                    View Store Payment Invoice
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> <?php echo lang('header_account'); ?> </li>
                    <li> <?php echo lang('header_stu_payme'); ?> </li>
                    <li id="result" class="pull-right topClock"></li>
                </ul>
            </div>
        </div>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">            
            <div class="col-md-12">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                }
                ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption"> Students Payments List</div>
                        <div class="tools">
                            <a href="<?php echo base_url('index.php/account/StorePayment')?>" class="btn btn-xs default"> Add Payment</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div style="margin:0px 10px 10px 0px;"> 
                        <?php
                            if (!empty($success)) {
                                  echo $success;
                            }
                            $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'method' => 'get');
                            echo form_open_multipart('account/ViewStorePayment', $form_attributs);
                        ?>                           
                            <select name="class">
                                <option value="">-- Selec Class --</option>
                                <?php foreach ($s_class as $row) { ?>
                                <option value="<?php echo $row['id']?>"> <?php echo $row['class_title']?> </option>
                                <?php } ?>
                            </select>
                            <input type="submit" name="sumbit" value="Search">
                        <?php echo form_close(); ?>
                        </div>

                        <table id="sample_1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th> SL </th>
                                    <th> Student ID </th>
                                    <th> Student Name </th>
                                    <th> Class </th>
                                    <th> Invoice ID </th>
                                    <th> Date </th>
                                    <th> Total </th>                                    
                                    <!-- <th> Action </th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=0;
                                $grand_total=0;
                                 foreach ($invoice as $row) { 
                                    $sl++;
                                    $grand_total += $row->pay_total;
                                    ?>
                                    <tr>
                                        <td> <?php echo $sl?> </td>
                                        <td> <?php echo $row->student_id?> </td>
                                        <td> <?php echo $row->student_nam?> </td>
                                        <td> <?php echo $row->class_title?> </td>
                                        <td> <a href="index.php/account/store_invoice_details/<?php echo $row->id; ?>">Invoice-<?php echo $row->id?></a> </td>
                                        <td> <?php echo $row->pay_date?> </td>
                                        <td align="right"> <?php echo $row->pay_total?> TK</td>
                                        <!-- <td> <a href="btn btn-primary" class=""> Details</a></td> -->
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="6" align="right"> <strong>Grand Total</strong></td>
                                    <td align="right"> <strong> <?php echo $grand_total; ?> TK </strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div> <!-- END PAGE CONTENT-->
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