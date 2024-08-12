
    <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($message)) {
                    echo '<br>' . $message;
                }
                ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <span style="color:green; font-weight: bold; font-size: 16px;">Total Amount:</span>   <?php echo $total_amount[0]['total_amount']; ?>,     <span style="color:green; font-weight: bold; font-size: 16px;">Total Entry:</span>   <?php echo $total_row; ?>

                <input id="print" class="btn blue" type="button" onclick="printDiv('printArea')" value="Print" />
                <div class="portlet box green" >
                    <div class="portlet-title">
                        <div class="caption">
                            Transaction List
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body"  id="printArea">
                        <div class="modal-header">
                            <div class="modal-title" align="center">
                                <h3 ><?php echo lang('school_name'); ?></h3>
                                <h4><?php echo lang('school_address'); ?></h4>
                            </div>
                          </div>
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo 'ID'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Account Type'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Account Head '; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Account Sub Head '; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Date'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Amount'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Note'; ?>
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               <?php $total_amount_to=0; if($transaction_list > 0) {
                                foreach ($transaction_list as $row) {  ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['category_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['accounts_head_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sub_head_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['date']; ?>
                                        </td>
                                         <td  style="text-align: right;">
                                            <?php echo $row['amount']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['note']; ?>
                                        </td>
                                    </tr>
                                <?php $total_amount_to=$total_amount_to+$row['amount']; } ?>
                                    <tr>
                                        <th colspan="5" style="text-align: right;">
                                            Total
                                        </th>
                                        <td  style="text-align: right; font-weight: bold;">
                                            <?php echo number_format($total_amount_to, 2); ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script>
    $('#sample_1').DataTable();
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