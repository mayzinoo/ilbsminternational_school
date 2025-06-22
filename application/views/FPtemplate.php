<!DOCTYPE html>
<html>
<head>
	<title>Fingerprint Attandence</title>
	<base href="<?=base_url()?>"></base>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<style type="text/css">
	body {
		width: 75%;
		margin: auto;
		text-align: center;
	}
	</style>

	<script type="text/javascript">
	function checkAtt()
	{
	$.ajax({
		type:"POST",
		url:"<?=base_url()?>FPattandance/save_attend/",	
	    success : function (e){
}

	});

	 setTimeout("checkAtt()",300000);
}
	
	</script>
</head>
<body onload="checkAtt()">
<h1>Essential School Attandence System</h1>
<img src="uploads/atta.png" width="100%">
</body>
</html>