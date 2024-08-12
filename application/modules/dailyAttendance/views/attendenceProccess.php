<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    <?php echo lang('att_scfa'); ?> <small></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <?php echo lang('home'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_stu_paren'); ?>
                    </li>
                    <li>
                        <?php echo lang('header_attendance'); ?>
                    </li>
                    <li>
                    Attendance Proccess
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
                <div class="tab-content">
                    <div id="tab_0" class="tab-pane active">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php echo lang('att_scasfa'); ?>
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;">
                                    </a>
                                    <a class="reload" href="javascript:;">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Process date</label>
                                        <input type="date" name="process_date" id="process_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div id='loading' style="display:none;">
                                        <img src='<?php echo base_url(); ?>assets/global/img/ajax-loading.gif' />
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" id="process">Process</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END CONTENT -->


    <script>
        $(document).ready(function() {
            $("#process").click(function() {
                var process_date = $("#process_date").val();
                if (process_date == "") {
                    alert("Please select date");
                    return false;
                }

                $("#loading").show();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>dailyAttendance/proccess",
                    data: {
                        date: process_date
                    },
                    success: function(data) {
                        alert(data);
                        $("#loading").hide();
                    },
                    error: function(data) {
                        alert('there is an error');
                        $("#loading").hide();
                    }
                });
            });
        });
    </script>

