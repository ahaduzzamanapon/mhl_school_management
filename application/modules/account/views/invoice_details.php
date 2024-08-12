<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/><!-- 
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title"> <?php echo $page_title?> <small></small> </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> <?php echo lang('header_account'); ?> </li>
                    <li> <?php echo lang('header_stu_payme'); ?> </li>
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
                        <div class="caption"> <?php echo $page_title?> </div>
                        <div class="tools"> 
                            <a href="<?php echo base_url('index.php/account/ViewPayment')?>" class="btn btn-xs default"> View Payment List</a>
                        </div>
                    </div>
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
                            <table width="100%" style="margin-bottom:20px;">
                                <tr>
                                    <th width="120">Student Name:</th> 
                                    <td><?php echo $invoice['info']->student_nam?></td>  
                                    <th width="50">Student ID: </th> 
                                    <td><?php echo $invoice['info']->student_id?></td>
                                </tr>
                                <tr>
                                    <th width="100">Class:</th> 
                                    <td><?php echo $invoice['info']->class_title?></td>  
                                    <th width="100">Invoice ID: </th> 
                                    <td><?php echo $invoice['info']->id?></td>
                                </tr>
                            </table>
                            <table border="1" width="100%" class="receipt"> 
                                <thead>
                                    <tr>
                                        <th align="middle"> SL </th>
                                        <th> Description</th>
                                        <th> Unit</th>
                                        <th> Qty. </th>
                                        <th> Total </th>                                    
                                    </tr>
                                </thead>

                                <tbody>
                                <?php 
                                $sl=0;
                                $total=0;
                                // $fromDate='';
                                // $toDate='';
                                // $comments='';
                                // $dateString='';

                                foreach ($invoice['items'] as $row) { 
                                    $sl++;
                                    $sub_total = $row->unit_price*$row->quantity;
                                    $fromDate='';
                                    $toDate='';
                                    $comments='';
                                    $dateString='';


                                    if($row->from_date != NULL){
                                        $fromDate = '('.date('F',strtotime($row->from_date));
                                    }
                                    if($row->to_date != NULL){
                                        $toDate = ' - '.date('F',strtotime($row->to_date)).')';
                                    } 
                                    // if($row->from_date != NULL || $row->to_date != NULL){
                                    //     $toDate = ' - ('.$row->to_date.')';
                                    // }
                                    $dateString = $fromDate.''.$toDate;
                                    if($row->comment != ''){
                                        $comments = '( '.$row->comment.' )';
                                    }
                                ?>
                                    <tr>
                                        <td style="text-align: center;"> <?php echo $sl?> </td>
                                        <td> <?php 
                                        //echo $row->fee_title.' '.$dateString
                                        echo $row->fee_title_desc.' '.$dateString
                                        ?> 
                                            <?php echo $comments;?>
                                        </td>
                                        <td style="text-align: center;"> <?php echo $row->unit_price?></td>
                                        <td style="text-align: center;"> <?php echo $row->quantity?> </td>
                                        <td align="right"> <?php echo $sub_total?> TK</td>
                                    </tr>
                                    <?php
                                        $total +=$sub_total;
                                    ?>
                                <?php } ?>
                                    
                                </tbody>

                                <tfoot>
                                    <tr>                                    
                                        <th colspan="4"> Grand Total</th>
                                        <th align="right"> <?php echo $total ?> TK </th>
                                    </tr>
                                </tfoot>
                                
                            </table>

                          </div>
                          <div class="modal-footer">
                            <table width="100%">
                                <tr>
                                    <td width="120">তাং-<?php echo date('d/m/Y', strtotime($invoice['info']->pay_date)); ?></td> 
                                    <td>&nbsp;</td>  
                                    <th width="50">&nbsp;</th> 
                                    <td>আদায়কারীর স্বাক্ষর-</td>
                                </tr>
    
                            </table>
                          </div>
                        </div>
                    </div>                    
                    </div>

                    <input id="print" class="btn blue" type="button" onclick="printDiv('printArea')" value="Print" />

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

<script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
}
</script>