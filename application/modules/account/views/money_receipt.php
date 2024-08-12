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
                <h3 class="page-title">
                    <?php echo lang('par_mpp'); ?> <small></small>
                </h3>
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
                            <i class="fa fa-bars"></i> <?php echo lang('par_gppi'); ?>
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
                        echo form_open_multipart('account/money_receipt', $form_attributs);
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
                            <div id="txtHint"> </div>
                          </div>
                          <div class="col-md-6 col-md-offset-3">
                              <div class="form-group" id="arButton" style="display: none;">
                                <div class="col-md-3" >
                                    <button id="addMore" class="fa fa-plus btn blue"></button>
                                    <button id="removeDiv" class="fa fa-minus btn red"></button>
                                </div>
                                <div class="col-md-3 col-md-offset-2">
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
        xmlhttp.open("GET", "index.php/account/student_id?q=" + str, true);
        xmlhttp.send();
    }
    //zuel 23-05-18
    function b_month() {
        var f_d = $('#f_d').val();
        var t_d = $('#t_d').val();

        if (t_d!='' && f_d!='') {
            var m_qty = parseInt(t_d)+1 - parseInt(f_d);
            $('#quantity').val(m_qty);

            var amount = $('#amount').val();
            var scholarship = $('#scholarship').val();

            var after_scholar = parseInt(amount) - parseInt(scholarship);
            var total_amnt = parseInt(after_scholar) * parseInt(m_qty);
            $('#total').val(total_amnt);
        }
        else{$('#quantity').val('1');}
    }

    function b_month_n(div_id) {
        // alert(div_id);
        var f_d0 = $('#f_d_'+div_id).val();
        var t_d0 = $('#t_d_'+div_id).val();

        if (t_d0!='' && f_d0!='') {
            var m_qty0 = parseInt(t_d0)+1 - parseInt(f_d0);
            $('#quantity_'+div_id).val(m_qty0);

            var amount0 = $('#amount_'+div_id).val();
            var scholarship0 = $('#scholarship_'+div_id).val();

            var after_scholar0 = parseInt(amount0) - parseInt(scholarship0);
            var total_amnt0 = parseInt(after_scholar0) * parseInt(m_qty0);
            $('#total_'+div_id).val(total_amnt0);
        }
        else{$('#quantity_'+div_id).val('1');}
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

    function payItem(str)//zuel
    {
        //alert(str);
        var feeItem = str.split("-");
        // alert(feeItem[2]);
        $('#amount').val(feeItem[1]);
        var scholarship = $('#hide_scholarship').val();
        var transport = $('#hide_transport').val();
        
        if(feeItem[2]!=1){
            scholarship=0;
        }

        if(feeItem[2]==28 && transport!=0){
            feeItem[1]=transport;
            $('#amount').val(feeItem[1]);
        }

        $('#scholarship').val(scholarship);
        $('#payment').val(feeItem[1]);

        var after_scholar = parseInt(feeItem[1]) - parseInt(scholarship);
        var quantity = $('#quantity').val();
        var total_amnt = parseInt(after_scholar) * parseInt(quantity);
        $('#total').val(total_amnt);
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
            var after_scholar = parseInt(amount) - parseInt($('#scholarship').val());
            // var fine = 
            $('#total').val(parseInt(after_scholar)*parseInt(quantity));
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
    $('.datepicker').datepicker({
        autoclose: true
    });    

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
                url: "index.php/account/get_student_fees",
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
                    items+='<div class="form-group" style="margin-bottom: 0px;">';
                    items+='<div class="col-md-2 col-md-offset-1">';
                    items +='<select style="height: 24px;width: 181px;" name="item[]" id="item_' + divId +'" class="payItemNew" onchange="pay_item_new('+ divId +')"><option value="">Select one</option>';

                    for (var i = 0; i < item['feeItem'].length; i++) {
                        //console.log(item['feeItem'][i]['id']);
                            if(item['feeItem'][i]['pay_type'] != null){
                                pay_cycle = ' -(' + item['feeItem'][i]['pay_type']+') ';
                            }else{
                                pay_cycle = '';
                            }
                        var id = item['feeItem'][i]['id'];
                        var title = item['feeItem'][i]['fee_title'];
                        var fee_type_id = item['feeItem'][i]['fee_type_id'];
                        var pay_type = pay_cycle;
                        var iAmount = item['feeItem'][i]['amount'];
                        
                        // var iAmount = item['feeItem'][i]['amount'];

                        items +='<option value="' + id + '-' + iAmount + '-' + fee_type_id + '">' + title +  pay_type +'-'+ iAmount + '</option>';
                    }
                    items+='</select> </div>';
                    items+='<div class="col-md-1"><input type="text" name="desc[]"  value="" class="stdPaymentNew" id="desc' + divId +'"/></div>';
                    items+='<div class="col-md-1"><input type="text" name="amount[]"  value="" class="stdPaymentNew" id="amount_' + divId +'"/></div>';
                    items+='<div class="col-md-1"><input type="text" name="scholar_amt[]"  value="" class="stdPaymentNew" id="scholarship_' + divId +'"/></div>';
                    // items+='<div class="col-md-1"><div class="input-group date" data-provide="datepicker"><input type="text" name="from_date[]" size="10" class="" placeholder="DD-MM-YYYY"><div style="display:none;" class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div></div></div>';
                    items+='<div class="col-md-1"><select name="from_date[]" onchange="b_month_n('+ divId +')" id="f_d_' + divId +'" style="height:24px; width: 90px;"><option value="">--Select--</option><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">Septembore</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></div>';

                    // items+='<div class="col-md-1"><div class="input-group date" data-provide="datepicker"><input type="text" name="to_date[]" size="10" class="" placeholder="DD-MM-YYYY"><div style="display:none;" class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div></div></div>';
                    items+='<div class="col-md-1"><select name="to_date[]" onchange="b_month_n('+ divId +')" id="t_d_' + divId +'" style="height:24px; width: 90px;"><option value="">--Select--</option><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">Septembore</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></div>';

                    items+='<div class="col-md-1"><input type="text" name="quantity[]" class="qty_new_fn" onchange="cal_total('+divId+')" id="quantity_' + divId +'" value="1"></div>';
                    items+='<div class="col-md-1"><input type="text" name="total[]" id="total_' + divId +'"></div>';
                    items+='<div class="col-md-2" style="width:150px;"><input type="text" name="comment[]" id="comment_' + divId +'"  size="15" value=""></div>';                    
                    items+='</div></div>';
                    
                    $("#fieldList").append(items);

                    $(".stdPaymentNew").change(function(){
                        var str = $('#amount_'+divId).val();
                        //var sclr = $('#scholarship_'+divId).val();
                        // $('#due').val(str);
                        var quantity = $('#quantity_'+divId).val();
                        $('#total_'+divId).val(parseInt(quantity)*parseInt(str));
                        // var total = $('#total_'+divId).val();
                        // var payment = $('#payment_'+divId).val();
                        // $('#due_'+divId).val(parseInt(total)-parseInt(payment));
                   });

                    // $(".payItemNew").change(function(){
                    //     var str = $('#item_'+divId).val();
                    //     var feeItem = str.split("-");
                    //     // alert(feeItem[2]);
                    //     var scholarship = $('#hide_scholarship').val();
                    //     var transport = $('#hide_transport').val();


                    //     if(feeItem[2] != 1)
                    //         scholarship = 0;

                    //     if(feeItem[2]==28 && transport!=0){
                    //         feeItem[1]=transport;
                    //         $('#amount').val(feeItem[1]);
                    //     }

                    //     var amount = feeItem[1];
                    //     amount = parseInt(amount) - parseInt(scholarship);

                    //     $('#amount_'+divId).val(feeItem[1]);
                    //     $('#scholarship_'+divId).val(scholarship);
                    //     $('#total_'+divId).val(parseInt(amount));

                    // });
                
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

                    // $(".qty_new_fn").change(function(){
                    //     var str = $('#quantity_'+divId).val();
                    //    //if (str!="") {
                    //         var amount = $('#amount_'+divId).val();
                    //         var quantity = $('#quantity_'+divId).val();
                    //         var scholarship = $('#scholarship_' + divId).val();

                    //         $('#total_'+divId).val(parseInt(quantity)* (parseInt(amount) - parseInt(scholarship)));

                    //         // var total = $('#total_'+divId).val();
                    //         // var payment = $('#payment_'+divId).val();
                    //         // $('#due_'+divId).val(parseInt(total)-parseInt(payment));
                    //     //}
                    // });

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
        $('#total_fee').hide();
    });
});

$("#submit").click(function(){
    var cl = document.getElementById('class').value;    
    if(cl == "--Select--" || cl == '')
    {
    alert("Select Class!!!");
    return false;
    }

    var sid = document.getElementById('stdId').value;    
    if(sid == "--Select--" || sid == '')
    {
    alert("Select Student!!!");
    return false;
    }

    var iid = document.getElementById('item').value;    
    if(iid == "--Select--" || iid == '')
    {
    alert("Select Fee!!!");
    return false;
    }
     


    if ('#class'=='') {
        alert('Select Class !!!');
    }
    var recv = $('#received').val();
    if(recv==''){
        var r = confirm("Is Receive Amount and Total Amount Equal ?");
        if (r == true) {
            return true;
        }else {
            return false;
        }
    }

   
    // $("#print").show();
    // $("#submit").hide();
    // $("#refresh").hide();
});
$("#print").hide();

//Created: 05-05-18
function cal_total(div_id)
{
    var amount = $('#amount_' + div_id).val();
    var qty = $('#quantity_' + div_id).val();
    var schol = $('#scholarship_' + div_id).val(); //zuel
    var after_schol = parseInt(amount) - parseInt(schol);

    var total = parseInt(qty) * parseInt(after_schol);

    $('#total_' + div_id).val(total);
}

function pay_item_new(div_id)
{
    var str = $('#item_'+div_id).val();
    var feeItem = str.split("-");
    // alert(feeItem[2]);
    var scholarship = $('#hide_scholarship').val();
    var transport = $('#hide_transport').val();


    if(feeItem[2] != 1)
        scholarship = 0;

    if(feeItem[2]==28 && transport!=0){
        feeItem[1]=transport;
        $('#amount').val(feeItem[1]);
    }

    var amount = feeItem[1];
    amount = parseInt(amount) - parseInt(scholarship);

    $('#amount_'+div_id).val(feeItem[1]);
    $('#scholarship_'+div_id).val(scholarship);
    $('#total_'+div_id).val(parseInt(amount));
}
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