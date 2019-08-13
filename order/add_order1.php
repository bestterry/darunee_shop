<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<form name="frmMain" action="" method="post">
<script language="JavaScript">
	function fncSum()
	{
		 document.frmMain.txtNumberC.value = parseFloat(document.frmMain.txtNumberA.value) * parseFloat(document.frmMain.txtNumberB.value);
	}
</script>
Number A <input type="text" name="txtNumberA" value="" OnChange="fncSum();"> <br>
Number B <input type="text" name="txtNumberB" value="" OnChange="fncSum();"> <br>
A + B  = <input type="text" name="txtNumberC" value=""><br>
</form>
</body>
</html>