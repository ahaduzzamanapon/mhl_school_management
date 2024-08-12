<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/><!-- 
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
<!-- END PAGE LEVEL STYLES -->
<style type="text/css">
    input[type=date]{
        line-height: 1;
    }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title"> Payment Transaction History</h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> <?php echo lang('header_account'); ?> </li>
                    <li> <?php echo lang('header_stu_payme'); ?> </li>
                    <li >Transection History</li>
                    <li id="result" class="pull-right"></li>
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
                        <div class="caption"> Payment Fee Transaction History</div>
                        <div class="tools">
                            <!-- <a href="<?php echo base_url('index.php/account/money_receipt')?>" class="btn btn-xs default"> Add Payment</a> -->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div style="margin:0px 10px 10px 0px;"> 
                        <?php
                            if (!empty($success)) {
                                  echo $success;
                            }
                            $form_attributs = array('class' => 'form-horizontal', 'role' => 'form', 'method' => 'get');
                            echo form_open_multipart('account/TransectionHistory', $form_attributs);
                        ?>                           
                        <table>
                            <tr>
                                <th>Select Class</th>
                                <th>Select Student</th>
                                <th>Select Fee Item</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="class" onchange="classInfo(this.value)">
                                        <option value="">--Selec--</option>
                                        <?php foreach ($s_class as $row) { ?>
                                        <option value="<?php echo $row['id']?>"> <?php echo $row['class_title']?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="studentId" id="studentId" style="width: 200px;">
                                        <option value="">--Select Student--</option>';
                                        <?php
                                        foreach ($studentInfo as $value) {?>
                                            <option value="<?php echo $value['student_id']; ?>" <?php echo $this->input->get('studentId')==$value['student_id']?"selected":"";?>> <?php echo $value['student_id'].'  ( '.$value['roll_number'].' - '.$value['student_nam'].'  ) '; ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="feeId" id="feeId" style="width: 150px;">
                                        <option value="">--Select Fee Item--</option>';
                                        <?php
                                        foreach ($feeInfo as $value) {?>
                                            <option value="<?php echo $value['id']; ?>" <?php echo $this->input->get('feeId')==$value['id']?"selected":"";?>> <?php echo $value['fee_title']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="from_date" size="14" value="<?php echo $this->input->get('from_date')?>">
                                </td>
                                <td>
                                    <input type="date" name="to_date" size="14" value="<?php echo $this->input->get('to_date')?>"> 
                                </td>
                                <td><input type="submit" name="sumbit" value="Search"></td>
                                <td><input type="submit" name="sumbit" value="Fees Summary"></td>
                                <td><input type="submit" name="sumbit" value="Class Summary"></td>
                            </tr>

                            <!-- <tr>
                                <td colspan="6">
                                    <input type="submit" name="sumbit" value="Search">
                                    <input type="submit" name="sumbit" value="Fees Summary">
                                    <input type="submit" name="sumbit" value="Class Summary">
                                </td>
                            </tr> -->
                        </table>
                        <?php echo form_close(); ?>
                        </div>

                    <?php if($this->input->get('sumbit') == 'Search'){ ?>
                        <table id="sample_1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th style="text-align: center;"> SL </th>
                                    <th style="text-align: center;"> Student ID </th>
                                    <th style="text-align: center;"> Student Name </th>
                                    <th style="text-align: center;"> Class </th>
                                    <th style="text-align: center;"> Fee Item </th>
                                    <th style="text-align: center;"> Receive Date </th>
                                    <th style="text-align: center;"> Unit Price </th>
                                    <th style="text-align: center;"> Qty </th>
                                    <th style="text-align: center;"> Pay Amt </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=0;
                                $grand_total=0;
                                $fromDate='';
                                $toDate='';
                                $comments='';
                                $dateString='';

                                foreach ($results as $row) { 
                                    $sl++;
                                    $sub_total = $row['unit_price']*$row['quantity'];
                                ?>
                                    <tr>
                                        <td style="text-align: center;"> <?php echo $sl?> </td>
                                        <td> <?php echo $row['item_stu_id']; ?></td>
                                        <td> <?php echo $row['student_nam']; ?></td>
                                        <td> <?php echo $row['class_title']; ?></td>
                                        <td> <?php echo $row['fee_title']; ?></td>
                                        <td> <?php echo $row['item_date']; ?></td>
                                        <td> <?php echo $row['unit_price']; ?></td>
                                        <td> <?php echo $row['quantity']; ?></td>
                                        <td align="right"> <?php echo $sub_total;?> TK</td>
                                    </tr>
                                    <?php
                                        $grand_total +=$sub_total;
                                    ?>
                                <?php } ?>
                                <tr>
                                    <td colspan="8" align="right"> <strong>Grand Total</strong></td>
                                    <td align="right"> <strong> <?php echo $grand_total; ?> TK </strong></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>

                        <!--=================================== -->
                    <?php if($this->input->get('sumbit') == 'Fees Summary'){ ?>
                    <div class="portlet-body">

                    <div class="row">
                    <div class="col-md-6" id="printArea">
                        <div  class="modal-content" style="width: 450px; margin: 0 auto;">
                          <div class="modal-header">
                            <div class="modal-title" align="center">
                                <h3 ><?php echo lang('school_name'); ?></h3>
                                <h4><?php echo lang('school_address'); ?></h4>
                            </div>
                          </div>

                          <div class="modal-body">
                            <style type="text/css">
                                .receipt{}
                                .receipt thead th{text-align: center; padding: 3px;}
                                .receipt tbody td{padding: 3px;}
                                .receipt tfoot th{text-align: right;padding: 3px;}
                            </style>
                            <!-- <table width="100%" style="margin-bottom:20px;"> -->
                        <table id="sample_1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th style="text-align: center;"> SL </th>
                                    <th style="text-align: center;"> Fee Titile </th>
                                    <th style="text-align: center;"> Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=0;
                                $grand_total=0;
                                $fromDate='';
                                $toDate='';
                                foreach ($results as $row) { 
                                    $sl++;
                                    $grand_total = $grand_total+$row['total_amount'];
                                ?>
                                    <tr>
                                        <td style="text-align: center;"> <?php echo $sl?> </td>
                                        <td> <?php echo $row['fee_title']; ?></td>
                                        <td align="right"> <?php echo $row['total_amount']; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" align="right"> <strong>Grand Total</strong></td>
                                    <td align="right"> <strong> <?php echo $grand_total; ?> TK </strong></td>
                                </tr>
                            </tbody>
                        </table>
                         </div>
                    </div>                    
                    </div>

                    <input id="print" class="btn blue" type="button" onclick="printDiv('printArea')" value="Print" />

                    </div>
                        <?php } ?>
                        <!--=================================== -->

        <?php if($this->input->get('sumbit') == 'Class Summary'){ ?>
                    <div class="portlet-body">
                    <div class="row">
                    <div class="col-md-8" id="printArea">
                        <div  class="modal-content" style="width: 100%; margin: 0 auto;">
                          <div class="modal-header">
                            <div class="modal-title" align="center">
                                <h3 ><?php echo lang('school_name'); ?></h3>
                                <h4><?php echo lang('school_address'); ?></h4>
                            </div>
                          </div>
                          <div class="modal-body">
                            <style type="text/css">
                                .receipt{}
                                .receipt thead th{text-align: center; padding: 3px;}
                                .receipt tbody td{padding: 3px;}
                                .receipt tfoot th{text-align: right;padding: 3px;}
                            </style>
                        <table id="sample_1" class="table table-striped table-bordered table-hover" >
            <?php 
                $grand_total=0;
                foreach ($results['class'] as $key0=> $row0) {
                    $c_id=$row0[0]['id'];
                    if (!empty($results['data'][$c_id])) {
            ?>
                            <thead>
                                <tr>
                                    <th colspan="5" style="text-align: center;"> <?php echo $row0[0]['class_title']; ?> </th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Stu Id.</th>
                                    <th>Sut Name</th>
                                    <th>Roll</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl=0;
                                $sub_total=0;
                                
                                $fromDate='';
                                $toDate='';

                                foreach ($results['data'][$c_id]as $key=> $row) { 
                                    $sl++;
                                    $sub_total = $sub_total+$row['total_amount'];
                                    $grand_total = $grand_total+$row['total_amount'];
                                ?>
                                    <tr>
                                        <td style="text-align: center;"> <?php echo $sl?> </td>
                                        <td> <?php echo $row['student_id']; ?></td>
                                        <td> <?php echo $row['student_nam']; ?></td>
                                        <td> <?php echo $row['roll_number']; ?></td>
                                        <td align="right"> <?php echo $row['total_amount']; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4" align="right"> <strong>Sub Total</strong></td>
                                    <td align="right"> <strong> <?php echo $sub_total; ?></strong></td>
                                </tr>
                            </tbody>
                        <?php } }?>
                            <tr>
                                <td colspan="4" align="right"> <strong>Grand Total</strong></td>
                                <td align="right"> <strong> <?php echo $grand_total; ?></strong></td>
                            </tr>
                        </table>
                         </div>
                    </div>                    
                    </div>
                    <input id="print" class="btn blue" type="button" onclick="printDiv('printArea')" value="Print" />
                    </div>
                        <?php } ?>
                        <!--=================================== -->
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
        // jQuery(setInterval(function () {
        //     jQuery("#result").load("index.php/home/iceTime");
        // }, 1000));
        // ComponentsPickers.init();
    });

</script>

<script>
    
    function classInfo(str) {
        var xmlhttp;
        // alert(str);
        if (str.length === 0) {
            document.getElementById("studentId").innerHTML = "";
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
                document.getElementById("studentId").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/account/student_list?q=" + str, true);
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

    //jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        // jQuery(setInterval(function() {
        //     jQuery("#result").load("index.php/home/iceTime");
        // }, 1000));
    //});
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