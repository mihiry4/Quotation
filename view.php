<!-- 
This is the home page for Final Project, Quotation Service. 
It is a PHP file because later on you will add PHP code to this file.

File name quotes.php 
    
Authors: Rick Mercer and Mihir Yadav
-->
<?php
session_start();
if(isset ($_SESSION ['user']) )  { // Someone is logged in
    echo 'Hello ' . $_SESSION ['user'] . "<br>";
}

?>

<!DOCTYPE html>
<html>
<br>
<br>
<!-- Clicking logout button goes the controller where $_SESSION['user'] will be unset -->
<?php
if(isset ($_SESSION ['user']))  { 
    $result = '';
    $result .= '<form action="controller.php" method="POST">';
    $result .=	'<input class="headerButton" type="submit" name="logout" value="Logout">';
    $result .= '</form>';
    echo $result;
}
?>
<br>
<head>
<title>Quotation Service</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body onload="showQuotes()">


<h1>Quotation Service</h1>

<a href="register.php">
<button name="Reg" class="headerButton" value="Register">Register</button>
</a>
<br><br>
<a href="Login.php">
<button name="login" class="headerButton" value="Login">Login</button>
</a>
<br><br>
<?php
if(isset ($_SESSION ['user']))  { 
    $temp = '<a href="addQuote.php">';
    $temp .= '<button name="addQ" class="headerButton" value="AddQuote">Add Quote</button></a>';
    echo $temp;
} ?>

<div id="divToChange"></div>
<script>
var element = document.getElementById("divToChange");
//TODO 5: 
// Complete this function using an AJAX call to controller.php
	// You will need query parameter todo=getQuotes.
	// Echo back one big string to here that has all styled quotations.
	// Write all of the complex code to layout the array of quotes 
	// inside function getQuotesAsHTML inside controller.php.
function showQuotes() {
	
	var ajax = new XMLHttpRequest();
	ajax.open("GET","controller.php?todo=getQuotes", true);
	ajax.send();
	ajax.onreadystatechange = function () {
	if(ajax.readyState == 4 && ajax.status == 200) {
		element.innerHTML = ajax.responseText;
		};
	}
}

 // End function showQuotes
</script>

</body>
</html>