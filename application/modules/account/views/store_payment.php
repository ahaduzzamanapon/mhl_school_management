<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Store Payment</h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <?php echo lang('home'); ?> </li>
                    <li> Account </li>
                    <li> Student Payment</li>
                    <li> Add Payment </li>
                    <li id="result" class="pull-right topClock"></li>

                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!--END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bars"></i> Student Store Payment
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php
                        if (!empty($success)) {
                              echo $success;
                        }
                        $form_attributs = array('class' => 'form-horizontal', 'role' => 'form');
                        echo form_open_multipart('account/StorePayment', $form_attributs);
                        ?>
                        <div class="form-body">
                            <div class="formField" style="display: block;">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><?php echo lang('admi_Class'); ?> <span class="requiredStar"> * </span></label>
                                    <div class="col-md-6">
                                        <select name="class_id" id="class" onchange="classInfo(this.value)" class="form-control" data-validation="required" data-validation-error-msg="<?php echo lang('admi_Class_error_msg'); ?>">
                                            <option value=""><?php echo lang('admi_select_class'); ?></option>
                                            <?php foreach ($s_class as $row) { ?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['class_title']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div id="txtHint">
                            </div>
                          </div>
                          <div class="col-md-6 col-md-offset-3">

                              <div class="form-group" id="arButton" style="display: none;">
                                <div class="col-md-3" >
                                    <button id="addMore" class="fa fa-plus btn blue"></button>
                                    <button id="removeDiv" class="fa fa-minus btn red"></button>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <button id="total_fee" class="btn btn-info">Grand Total</button><br>
                                    Received <br>
                                    Change
                                </div>
                                <div class="col-md-3 ">                                    
                                    <input type="text" name="sum" id="sum" value="00" readonly size="5"><br>
                                    <input type="text" name="received" id="received" onchange="received_change(this.value)" value="" size="5"><br>
                                    <input type="text" name="rec_change" id="rec_change" value="" readonly size="5">
                                </div>
                              </div>

                          </div>
                          <div style="clear:both;"></div>
                        </div>

                        <div class="form-actions fluid">
                            <div class="col-md-offset-3 col-md-6">
                                <button id="submit" type="submit" class="btn green" name="submit" value="Submit"><?php echo lang('save'); ?></button>
                                 <!-- <button type="button" class="btn yellow" data-toggle="modal" data-target="#myModal">Preview</button> -->
                                <!-- <input id="print" class="btn blue" type="button" onclick="printDiv('myModal')" value="Print" /> -->
                                <!-- <button id="refresh" type="reset" class="btn default"> <?php echo lang('refresh'); ?> </button> -->
                            </div>
                        
                        <?php echo form_close(); ?>
                    </div>

                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
             
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div  class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-title" align="center">
            <h3 ><?php echo lang('school_name'); ?></h3>
            <h4><?php echo lang('school_address'); ?></h4>
        </div>
      </div>
      <div class="modal-body">
        <div id="receipt"></div>
      </div>
      <div class="modal-footer">
        <div align="left">তাং-<?php echo date('d/m/Y'); ?></div>
        <div align="center"><b>আদায়কারীর স্বাক্ষর-</b></div>
      </div>
    </div>

  </div>
</div>

<!-- BEGIN PAGE LEVEL script -->
<script>
    function studentInfo(str) {
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("ajaxResult").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("ajaxResult").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/account/studentInfoById?q=" + str, true);
        xmlhttp.send();
    }

    function classInfo(str) {
        $("#arButton").show();
        var xmlhttp;
        if (str.length === 0) {
            document.getElementById("txtHint").innerHTML = "";
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
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "index.php/account/store_student_id?q=" + str, true);
        xmlhttp.send();
    }

    jQuery(document).ready(function () {
    //here is auto reload after 1 second for time and date in the top
        jQuery(setInterval(function () {
            jQuery("#result").load("index.php/home/iceTime");
        }, 1000));
    });

    $("#stdId").bind("change keyup", function(event){
        studentInfo(this.value);
    });

    function stdPayment(str)
    {
        // $('#due').val(str);
        // var quantity = $('#quantity').val();
        // $('#total').val(parseInt(quantity)+parseInt(str));
        // var total = $('#total').val();
        // var payment = $('#payment').val();
        // $('#due').val(parseInt(total)-parseInt(payment));

    }



    function payItem(str)
    {
        var feeItem = str.split("-");
        $('#amount').val(feeItem[1]);
        //$('#quantity').val('');
        //$('#payment').val('');
        $('#payment').val(feeItem[1]);
        //var quantity = $('#quantity').val();
        //$('#total').val(parseInt(quantity)+parseInt(feeItem[1]));
        $('#total').val(parseInt(feeItem[1]));
        
    }

    function Fine(str)
    {
       if (str!="") {
            var amount = $('#amount').val();
            var quantity = $('#quantity').val();
            $('#total').val(parseInt(quantity)+parseInt(amount));

            // var total = $('#total').val();
            // var payment = $('#payment').val();
            // $('#due').val(parseInt(total)-parseInt(payment));
        }
       
    }

    function quantity_fn(str)
    {
       if (str!="") {
            var amount = $('#amount').val();
            var quantity = $('#quantity').val();
            // var fine = 
            $('#total').val(parseInt(amount)*parseInt(quantity));
            // $('#due').val(parseInt(total)-parseInt(payment));
        }
       
    }


    function DuePay(str)
    {
        var total = $('#total').val();
        $('#due').val(parseInt(total)-parseInt(str));
    }

    function received_change(str)
    {
        var total = $('#sum').val();
        //alert(total); 
        var rec = $('#received').val();
        $('#rec_change').val(parseInt(rec)-parseInt(total));
    }

</script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END PAGE LEVEL script -->
<script src="assets/global/plugins/jquery.form-validator.min.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>

<script> $.validate();</script>

<script>
    //$('.datepicker').datepicker();

    $(".monty-year-picker").datepicker( {
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });
</script>


<script>
$(function() {
    var divId = 0; 
    $("#addMore").click(function(e) {
        divId++;
        e.preventDefault();
        var classId = $("#class").val();
        classId     = classId.split("-");
        classId     = classId[0];
        var iAmount;
          return $.ajax({
                url: "index.php/account/item_sale_yes",
                data: { classId: classId },
                dataType: "json",
                success:function(response_data_json) {
                    // alert()
                    var item = JSON.stringify(response_data_json);
                    var item = jQuery.parseJSON(item);
                    var items = '';
                    var pay_cycle = '';
                    items+='<div class="newDiv_' + divId +'">';
                    //console.log('<div class="newDiv_' + divId +'">');
                    items+='<div class="form-group">';
                    items+='<div class="col-md-2 col-md-offset-2">';
                    items +='<select name="item[]" id="item_' + divId +'" class="payItemNew"><option value="">Select one</option>';

                    for (var i = 0; i < item['feeItem'].length; i++) {
                        //console.log(item['feeItem'][i]['id']);
                            // if(item['feeItem'][i]['pay_type'] != ''){
                            //     pay_cycle = ' (' + item['feeItem'][i]['pay_type']+') ';
                            // }else{
                            //     pay_cycle = '';
                            // }
                        var id = item['feeItem'][i]['id'];
                        var title = item['feeItem'][i]['item_name'];
                        //var pay_type = pay_cycle;
                        var iAmount = item['feeItem'][i]['item_retail'];

                        items +='<option value="' + id + '-' + iAmount + '-' + title + '">' + title + '</option>';
                    }
                    items+='</select> </div>';
                    items+='<div class="col-md-1"><input type="text" name="amount[]"  value="" class="stdPaymentNew" id="amount_' + divId +'"/></div>';                    
                    items+='<div class="col-md-1"><input type="text" name="quantity[]" class="qty_new_fn" id="quantity_' + divId +'" value="1"></div>';
                    items+='<div class="col-md-1"><input type="text" name="total[]" id="total_' + divId +'" readonly></div>';
                    items+='<div class="col-md-2" style="width:150px;"><input type="text" name="comment[]" id="comment_' + divId +'"  size="15" value=""></div>';                    
                    items+='</div></div>';
                    
                    $("#fieldList").append(items);

                    $(".stdPaymentNew").change(function(){
                        var str = $('#amount_'+divId).val();
                        // $('#due').val(str);
                        var quantity = $('#quantity_'+divId).val();
                        $('#total_'+divId).val(parseInt(quantity)*parseInt(str));
                        // var total = $('#total_'+divId).val();
                        // var payment = $('#payment_'+divId).val();
                        // $('#due_'+divId).val(parseInt(total)-parseInt(payment));
                   });

                    $(".payItemNew").change(function(){
                        var str = $('#item_'+divId).val();
                        var feeItem = str.split("-");
                        $('#amount_'+divId).val(feeItem[1]);
                        //$('#fine').val('');
                        //$('#payment').val('');
                        // $('#payment_'+divId).val(feeItem[1]);
                        //var fine = $('#fine').val();
                        //$('#total').val(parseInt(fine)+parseInt(feeItem[1]));
                        $('#total_'+divId).val(parseInt(feeItem[1]));
                    });
                
                    $(".FineNew").change(function(){
                        var str = $('#quantity_'+divId).val();
                       if (str!="") {
                            var amount = $('#amount_'+divId).val();
                            var quantity = $('#quantity_'+divId).val();
                            $('#total_'+divId).val(parseInt(quantity)+parseInt(amount));

                            // var total = $('#total_'+divId).val();
                            // var payment = $('#payment_'+divId).val();
                            // $('#due_'+divId).val(parseInt(total)-parseInt(payment));
                        }
                    });

                    $(".qty_new_fn").change(function(){
                        var str = $('#quantity_'+divId).val();
                       //if (str!="") {
                            var amount = $('#amount_'+divId).val();
                            var quantity = $('#quantity_'+divId).val();
                            $('#total_'+divId).val(parseInt(quantity)*parseInt(amount));

                            // var total = $('#total_'+divId).val();
                            // var payment = $('#payment_'+divId).val();
                            // $('#due_'+divId).val(parseInt(total)-parseInt(payment));
                        //}
                    });

                    //  $(".DuePayNew").change(function(){
                    //     var str = $('#payment_'+divId).val();
                    //     var total = $('#total_'+divId).val();
                    //     $('#due_'+divId).val(parseInt(total)-parseInt(str));
                    // });

            
                }
            });
       
    });

     $("#removeDiv").click(function(e) {
        e.preventDefault();
        var div_id = 'newDiv_' + divId;
        if (divId>0) {
            console.log(div_id);
            console.log(divId);
            $( "div" ).remove('.'+ div_id );
           
            divId--;
        }
       
    }); 

     $("#total_fee").click(function(f) {
        f.preventDefault();
        var total = $('#total').val();
        var sum = parseInt(total);
        console.log(divId);
        var tdValue='';
        var classId         = $('#class').val();
        classId             = classId.split("-");
        classId             = classId[1];
        var studentName     = $('#studentName').val();
        var studentId       = $('#studentId').val();
        var str             = $('#item').val();
        var feeItem         = str.split("-");
        var itemName        = feeItem[2];
        var d = new Date();
        var n = d.getFullYear();

        tdValue+= '<tr>'
        tdValue+= '<td>'+1+'</td>';
        tdValue+= '<td>'+itemName+'</td>';
        tdValue+= '<td>'+total+'</td>';
        tdValue+= '</tr>'
        var si = '2';
        while(divId>0){
            total = $('#total_'+divId).val();
            sum+=parseInt(total);
            console.log(total);
            // Modal value
            str         = $('#item_'+divId).val();
            feeItem     = str.split("-");
            itemName    = feeItem[2];
            tdValue+= '<tr>'
            tdValue+= '<td>'+si+'</td>';
            tdValue+= '<td>'+itemName+'</td>';
            tdValue+= '<td>'+total+'</td>';
            tdValue+= '</tr>'
            // modal close

            divId--;
            si++;
        }
        tdValue+= '<tr>'
        tdValue+= '<td colspan="2" align="center"><b>সর্বমোট</b></td>';
        tdValue+= '<td><b>'+sum+'</b></td>';
        tdValue+= '</tr>'

        $('#sum').val(sum);

        var receiptList = '';
        receiptList+= '<div id="std_receipt">';
        var tab = '&nbsp;&nbsp;&nbsp;&nbsp;';

        receiptList+='<div class="formField">';
        receiptList+='<div class="row">';
        receiptList+=tab;
        receiptList+='<?php echo lang('student_name'); ?>';
        receiptList+=tab;
        receiptList+=studentName;
        receiptList+='</div>';

        receiptList+='<div class="row">';
        receiptList+=tab;
        receiptList+='<?php echo lang('student_class'); ?>';
        receiptList+=tab+classId+tab;
        receiptList+='<?php echo lang('student_roll'); ?>';
        receiptList+=tab+studentId+tab;
        receiptList+='<?php echo lang('year'); ?>';
        receiptList+=tab+n+tab;
        receiptList+='</div>';
        receiptList+='</div>';
        
        receiptList+= '<div class="">';
        receiptList+= '<table class="table table-hover" border="1">';
        receiptList+= '<thead>';
        receiptList+= '<th>ক্রমিক নং</th>';
        receiptList+= '<th>বিস্তারিত বিবরন</th>';
        receiptList+= '<th>টাকা/পয়সা</th>';
        receiptList+= '</thead>';
        receiptList+= '<tbody>'+tdValue+'</tbody>';
        receiptList+= '</table>';
        receiptList+= '</div>';
        receiptList+= '</div>';

        $("#receipt").append(receiptList);
        
        $('#addMore').hide();
        $('#removeDiv').hide();
       
    });
});
$("#submit").click(function(){
    // $("#print").show();
    // $("#submit").hide();
    // $("#refresh").hide();
});
$("#print").hide();
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