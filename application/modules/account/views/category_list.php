<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
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
                    <?php echo 'Category List'; ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                        
                    </li>
                    <li>
                        <?php echo 'Category List'; ?>
                        
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
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Category List
                        </div>
                        <div class="tools">
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo 'Category Id'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Category Name'; ?>
                                    </th>
                                    <th>
                                        <?php echo 'Action'; ?>
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($category > 0){
                                foreach ($category as $row) {  ?>
                                  

                                    <tr>
                                        <td>
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['category_name']; ?>
                                        </td>
        
                                        <td>
                                            <a class="btn btn-xs default tableActionButtonMargin" href="index.php/account/editCategory?id=<?php echo $row['id']; ?>"> <i class="fa fa-pencil-square"></i> <?php echo lang('stu_clas_Edit'); ?> </a>
                                            <a class="btn btn-xs red tableActionButtonMargin" href="index.php/account/categoryDelete?di=<?php echo $row['id']; ?>" onClick="javascript:return confirm('Are you sure you want to delete this student?')"> <i class="fa fa-trash-o"></i> <?php echo lang('stu_clas_Delete'); ?> </a>
                                        </td>
                                    </tr>
                                <?php }} else{ ?>


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->


<!--Begin Page Level Script-->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<!--End Page Level Script-->
<script>
    jQuery(document).ready(function() {
        //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function() {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });
</script>
