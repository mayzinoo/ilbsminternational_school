//var site_url="https://www.essentialschool.online/";
var site_url="http://essentialsmsilbsm.minguntechnology.com/";

function clonerow()
{
	//arg.preventDefault();
		var clone=$( ".clonethis:last-child" ).clone();
		no= $('td.no').length+1;
		clone.find("td[class='no']").html(no);
		clone.appendTo( "#SourceWrapper" );		
		clone.find("input[name='amount[]']").val("");
		clone.find("input[name='receive[]']").val("");
		clone.find("input[name='discount[]']").val(0);
		clone.find("input[name='subject[]']").val("");
		clone.find("input[name='description[]']").val("");

		window.scrollBy(0, 70);
}

function clonesalerow()
{
    var clone=$( ".clonethis:last-child" ).clone();
		no= $('td.no').length+1;
		clone.find("td[class='no']").html(no);
		clone.appendTo( "#SourceWrapper" );		
		clone.find("input[name='item_name[]']").val("");
		clone.find("input[name='quantity[]']").val("");
		clone.find("input[name='price[]']").val(0);
		clone.find("input[name='total[]']").val("");
		clone.find("textarea[name='description[]']").val("");
}
function wardenclonerow()
{
	//arg.preventDefault();
		var clone=$( ".wardenclonethis:last-child" ).clone();
		no= $('td.no').length+1;
		clone.find("td[class='no']").html(no);
		clone.appendTo( "#wardenWrapper" );		
		clone.find("input[name='warden-techr[]']").val("");
		clone.find("input[name='warden-phone[]']").val("");
		window.scrollBy(0, 70);
}
function guideclonerow()
{
	//arg.preventDefault();
		var clone=$( ".guideclonethis:last-child" ).clone();
		no= $('td.no').length+1;
		clone.find("td[class='no']").html(no);
		clone.appendTo( "#guideWrapper" );		
		clone.find("input[name='guide-techr[]']").val("");
		clone.find("input[name='guide-phone[]']").val("");
		window.scrollBy(0, 70);
}
function getdata(tbl,arg)
{

		var target = $(arg.target);
		var parent = target.parent().parent().parent();
		var id=target.val();
		data="tbl="+tbl+"&id="+id;

		$.ajax({
		type:"POST",
		data: data,
		url:site_url+"Grab_controller/grabdata/",
		cache: false,
		dataType:"json",
		success: function(d) 
		{
				parent.find("input[name='amount[]']").val(d.amount);
				parent.find("input[name='receive[]']").val(d.amount);
				calculateSum();
        }
		
	});

}

        function hidestudent()
        {
            $("#student").hide();
        }
        
         function showstudent()
        {
            $("#student").show();
        }
        


 function getData(planid)
    {
        data="install_plan_id="+planid;
        $.ajax({
                type: "POST",
                url : site_url+"Installment/searchStudent/",
                data : data,

                success : function(e)
                {
                  
                var res=e.split("]");
                
                $("#student_id").html(res[0]);
                $("#fees").val(res[1]);
                $("#session_id").val(res[2]);
                $("#session").val(res[3]);
                }
            });
    }
    
    function calculateDay()
    {
        var start_date=$("#start_date").val();
        var end_date=$("#end_date").val();
        // alert(end_date);
        data="start_date="+start_date+"&end_date="+end_date;
        
        $.ajax({
                type: "POST",
                url : site_url+"admin/Holiday/calculateDay",
                data : data,

                success : function(e)
                {
                  
                $("#day").val(e);
                }
            });
    }
    
    function daydiff(first, second) {
    return (second-first)/(1000*60*60*24)
}
    
    function getstudentLists(classid)
    {
        data="class_id="+classid;
        $.ajax({
                type: "POST",
                url : site_url+"Balance_fee/searchStudent/",
                data : data,

                success : function(e)
                {
                  
                $("#student_id").html(e);
                }
            });
    }

function searchdata(table)
{		
	
// 		$("#content").html("<tr><td align='center' colspan='18'><img src='images/loading.gif'/></td></tr>");

		var data=$("#"+table).serialize();
		$.ajax({
				type: "POST",
				url : site_url+"Inventory/searchdata/"+table,
				data : data,
				success : function(e)
				{
				 $("#content").html(e);	
				}
			});
}


function calculateTotal(qty,arg)
{
    var target = $(arg.target);
	var parent = target.parent().parent().parent();
    var quantity=qty;
    var p=parent.find("input[name='price[]']").val();
    var price=parseFloat(p);
    var sum=quantity * price;
    parent.find("input[name='total[]']").val(sum);
}

function getPrice(val,arg)
{
    var target = $(arg.target);
	var parent = target.parent().parent().parent();
    var data="item="+val;
    
    $.ajax({
		type:"POST",
		data:data,
		url:site_url+"Inventory/getPrice/"+val,
		dataType:"json",
		success: function(d) 
		{	
		    
		  //  var a=JSON.parse(d);
            parent.find("input[name='price[]']").val(d.price);
            parent.find("textarea[name='description[]']").val(d.description);
            // $(arg.target).parent().parent().find("input[name='price[]']").val(a.price);
        }
    });
}


    function getPricedata(item)
        {
            $.ajax({
    		type:"POST",
    		url:site_url+"Inventory/getPricedata/"+item,
        		success: function(d) 
        		{	
        		    $("#price").val(d);
                }
            });
        }
        
        function calculateThis(qty)
        {
            var price=$("#price").val();
            var total=qty * price;
            $("#total").val(total);
        }
        


function getstudentdata(sid)
{
    
    $.ajax({
		type:"POST",
		url:site_url+"Grab_controller/grabstudentdata/"+sid,
		cache: false,
		dataType:"json",
		success: function(d) 

		{				
                var sname=d.firstname+d.lastname;
                var parent=d.father_name+"+"+d.mother_name;
                var photo=site_url+d.image;
                var photolink="<img src="+"'"+photo+"'>";
                var photoname="<input type='hidden' name='photoselect' value="+"'"+d.image+"'"+">";
				$("#name").val(sname);
				$("#parent").val(parent);
				$("#phone").val(d.mobileno);
				$("#address").val(d.permanent_address);
				$("#email").val(d.email);
				$("#photo").html(photolink+photoname);
              
        }
    });
}


function editmobile()
{
    $("#editmb").hide();
    $("#hidemb").show();
}

function updatephone(value,sid)
{
    // alert(value);
    var data="phone="+value+"&student_id="+sid;
    $.ajax({
		type:"POST",
		url:site_url+"parent/Parents/updatephone",
		data: data,
		success: function(j) 
		{			
                $("#editmb").show();
                $("#hidemb").hide();
                $("#ph").html(value);
        }
    });
}

function editaddress()
{
    $("#editad").hide();
    $("#hidead").show();
}

function updateaddress(value,sid)
{
    // alert(value);
    var data="address="+value+"&student_id="+sid;
    $.ajax({
		type:"POST",
		url:site_url+"parent/Parents/updateaddress",
		data: data,
		success: function(j) 
		{			
                $("#editad").show();
                $("#hidead").hide();
                $("#ad").html(value);
        }
    });
}


function getFees(lid)
{
    
    $.ajax({
		type:"POST",
		url:site_url+"Grab_controller/grabFee/"+lid,
		cache: false,
		dataType:"json",
		success: function(j) 

		{				
                var fee=j.fees;
                var start_date=j.start_date;
                var end_date=j.end_date;
               
				$("#fees").val(fee);
				$("#start_date").val(start_date);
				$("#end_date").val(end_date);
				
        }
    });
}

function insert_attendance(id)
{
	if(id.length==8){
	
	$("#att_id").blur();

	data="id="+id;
	$.ajax({
		type:"POST",
		data: data,
		url:site_url+"site/insert_attendance/",
		cache: false,
		success: function(d) 

		{			

			$("#stu_result").html(d);

			setTimeout("hideinfo()",500);
        }
		
	});
	}
}

function insert_teaattendance(id)
{
	$("#att_id").blur();

	data="id="+id;
	$.ajax({
		type:"POST",
		data: data,
		url:site_url+"site/insert_teaattendance/",
		cache: false,
		success: function(d) 

		{			
			$("#stu_result").html(d);
			setTimeout("hideinfo()",500);
        }
		
	});
}



function hideinfo()
{
	$("#att_id").val("");
	$("#att_id").focus();
	$("#stu_result").html("");

}

function calculate_discount(event)

{
	var target=$(event.target);
	var parent=target.parent().parent().parent();
	var amount=parent.find("input[name='amount[]']").val();
	var dis=parent.find("input[name='discount[]']").val();

	parent.find("input[name='receive[]']").val(parseFloat(amount)-parseFloat(dis));
	calculateSum();

}
 function calculateSum() {
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".total").each(function() {
 //	alert(sum);
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });

        $("#nettotal").val(sum);
       

    }

function calculateDiscount()
{
    var dp=parseFloat($("#dpercent").val());
    var fee=parseFloat($("#final_fees").val());
    var damt=(dp/100) * fee;
    $("#discount").val(damt);
}

function calculateBalance(id)
{
    var final="final_fees"+id;
    var pay="pay_amt"+id;
    var bal="balance"+id;
    var prev_balance=parseFloat($("#"+final).val());
    var pay_amt=parseFloat($("#"+pay).val());
    // var damt=parseFloat($("#discount").val());
    var balance=prev_balance - pay_amt;
    $("#"+bal).val(balance);
}

// function calculateBalance()
// {
//     var prev_balance=parseFloat($("#final_fees").val());
//     var pay_amt=parseFloat($("#pay_amt").val());
//     var damt=parseFloat($("#discount").val());
//     var balance=prev_balance - pay_amt - damt;
//     $("#balance").val(balance);
// }



function removerform(event)
{
    var target = $(event.target);
    target.parent().parent().remove();
    calculateSum();
}








function getposition(id)
{

    data="id="+id;
    $.ajax({
        type:"POST",
        data: data,
        url:site_url+"Grab_controller/getposition/",
        cache: false,
        dataType:"json",
        success: function(d) 

        {               

               $("#amount").val(d.salary);
               $("#position").val(d.position);
              
        }
        
    });
}


   
