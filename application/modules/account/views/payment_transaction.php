<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/><!-- 
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
<!-- END PAGE LEVEL STYLES -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title"> Payment Transaction </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> <?php echo lang('header_account'); ?> </li>
                    <li> <?php echo lang('header_stu_payme'); ?> </li>
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
                        <div class="caption"> Payment Fee Transaction </div>
                        <div class="tools">
                            <!-- <a href="<?php echo base_url('index.php/account/money_receipt')?>" class="btn btn-xs default"> Add Payment</a> -->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php //if($this->input->get('sumbit') == 'Search'){ ?>
                        <div style="margin: 10px auto;">
                            <em>Student ID:</em> <strong><?php echo $results['info']->student_id?></strong>
                            <em>Student Name:</em> <strong><?php echo $results['info']->student_nam?></strong>
                            <em>Roll No: </em> <strong> <?php echo $results['info']->roll_number?></strong>
                        </div>

                        <table id="sample_1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th style="text-align: center;"> SL </th>
                                    <th> Description</th>
                                    <th style="text-align: center;"> Unit</th>
                                    <th style="text-align: center;"> Qty. </th>
                                    <th style="text-align: center;"> Total </th>                                    
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

                                foreach ($results['invoice_items'] as $row) { 
                                    $sl++;
                                    $sub_total = $row->unit_price*$row->quantity;
                                    $fromDate='';
                                    $toDate='';
                                    $comments='';
                                    $dateString='';


                                    if($row->from_date != NULL){
                                        $fromDate = $row->from_date;
                                    }
                                    if($row->to_date != NULL){
                                        $toDate = ' - '.$row->to_date;
                                    } 
                                    // if($row->from_date != NULL || $row->to_date != NULL){
                                    //     $toDate = ' - ('.$row->to_date.')';
                                    // }
                                    $dateString = $fromDate.''.$toDate;
                                    if($row->comment != ''){
                                        $comments = '<br>'.$row->comment;
                                    }
                                ?>
                                    <tr>
                                        <td style="text-align: center;"> <?php echo $sl?> </td>
                                        <td> <?php echo $row->fee_title.' '.$dateString?> 
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

                                <?php //} ?>
                                <!-- <tr>
                                    <td colspan="6" align="right"> <strong>Grand Total</strong></td>
                                    <td align="right"> <strong> <?php //echo $grand_total; ?> TK </strong></td>
                                    <td>&nbsp;</td>
                                </tr> -->
                            </tbody>
                        </table>

                        <!-- <pre> -->
                        <?php //print_r($results['invoice_items']); ?>

                        <?php //} ?>
                        
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
        // alert('ok');
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