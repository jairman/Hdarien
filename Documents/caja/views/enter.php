<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<label for="textfield"></label>
<table width="200" border="1" align="center">
  <tr>
    <td><input type="text" name="rf" id="rf" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

 
<script>
$("#rf").focus(); 
       var auxSearch = "";
            cont =0;
		$('input[name=rf]').keydown(function(e) {
				cont ++;    
                search = $(this).val();
				len = search.length;		
				if(cont==1){
					
					setTimeout(function () {
							var user = $('#rf').val();
							$("#rf").attr('disabled', 'disabled');	
						//console.log(cont)
						console.log(user)
						
					}, 500);	
		}		
            
            });

</script>
 


</body>
</html>