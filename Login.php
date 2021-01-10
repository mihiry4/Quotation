<!-- 


Authors:  Mihir Yadav
-->


<!DOCTYPE html>
<html>
<head>
<title>Add Quote</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
// seesion_start()s are not needed until later, certainly not in Quotes 1
session_start();
?>
<h3>Login</h3>
<div class="LoginDiv" style="border:3px solid black; height:160px; width:200px; border-radius:10px;"><br>


<form action="controller.php" method="POST">
		<input type="text" name="ID" value="" placeholder="Username"><br>
		<input type="password" name="password" value="" placeholder="Password"><br> <br>
	    <input type="submit" name="Login" value="Login"> <br> <br>	
	<?php
	
  // TODO 9: Show message indicating the credentials were not Rick and 1234
  if( isset(  $_SESSION['loginError']))
    echo  $_SESSION['loginError'];	
	?>
</form>

</div>


</body>
</html>