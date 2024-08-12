
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

                
                <div class="portlet box green" id="printArea">
                    <div class="portlet-title">
                        <div class="caption">
                            Transaction List
                        </div>
                        <div class="tools">
                        </div>
                    </div>




                    <div class="portlet-body" >
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
                                        <?php echo 'Amount'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Note'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Date'; ?>
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               <?php if($transaction_list > 0) {
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
                                            <?php echo $row['amount']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['note']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['date']; ?>
                                        </td>

                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
                <div>
                    <input id="print" class="btn blue" type="button" onclick="printDiv('printArea')" value="Print" />
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