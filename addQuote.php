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
<h3>Add a Quote</h3>
<div>
<form action="controller.php" method="POST">
<textarea name="theQuote" rows="4" cols="50">
</textarea><br>
<input name="quoteAuthor" type="text" placeholder="Author"><br><br>
<button name="addMyQuote">Add Quote</button>
</form>
</div>

</body>
</html>