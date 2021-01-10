<?php
// This file contains a bridge between the view and the model and redirects back to the proper page
// with after processing whatever form this code absorbs. This is the C in MVC, the Controller.
//
// Authors: Rick Mercer and  Mihir Yadav
//

require_once './DatabaseAdaptor.php';

session_start (); // Not needed in Quotes1


$theDBA = new DatabaseAdaptor();


// get all quotes
if (isset ( $_GET ['todo'] ) && $_GET ['todo'] === 'getQuotes') {
    $arr = $theDBA->getAllQuotations();
    unset($_GET ['todo']);
    $s = getQuotesAsHTML ( $arr );
    echo $s;
    
}

// add Quote
if (isset ( $_POST ['addMyQuote'] )) {
    $refinedQuote = htmlspecialchars($_POST ['theQuote']);
    $refinedAuthor =  htmlspecialchars($_POST ['quoteAuthor']);
    $theDBA->addQuote($refinedQuote,$refinedAuthor);
    header ( 'Location: view.php' );
}



// login
if(isset( $_POST ['Login'])){
    unset($_SESSION['loginError']);
    $refinedID =  htmlspecialchars($_POST ['ID']);
    $refinedPwd =  htmlspecialchars($_POST ['password']);
    if($theDBA->verifyCredentials($refinedID, $refinedPwd) ){
        $_SESSION ['user'] = $_POST ['ID'];
        header ( 'Location: view.php' );
    } else{
        $_SESSION['loginError'] = 'Invalid credentials.';
        header ( 'Location: Login.php' );
    }
}


// register
if(isset( $_POST ['Register'])){
    unset($_SESSION['registrationError']);
    $refinedUsername =  htmlspecialchars($_POST ['registerUsername']);
    if($theDBA->Exists($refinedUsername)){
        $_SESSION['registrationError'] = 'Username already Exists.';
        header ( 'Location: register.php' );
        
    }else{
        $refinedPwd =  htmlspecialchars($_POST ['registerPassword']);
        $hashed_pwd = password_hash($refinedPwd, PASSWORD_DEFAULT);
        $theDBA->addUser($refinedUsername, $hashed_pwd);
        header ( 'Location: view.php' );
    }
    
}

//  update (likes,dislikes,delete)
if (isset ($_POST ['update'])){
    if ($_POST ['update'] === 'increase') {
        $theDBA->increaseRating($_POST ['ID']);
    } else if ($_POST ['update'] === 'decrease'){
        $theDBA->decreaseRating($_POST ['ID']);
    } else  if ($_POST ['update'] === 'delete'){
        $theDBA->deleteQuote($_POST ['ID']);
    }
        header ( 'Location: view.php' );
}

if (isset ( $_POST ['logout'] ) && $_POST ['logout'] === 'Logout') {
    session_destroy ();  // unset all $_SESSION[] elements
    header ( 'Location: view.php' );
}



function getQuotesAsHTML($arr) {
    // TODO 6: Many things. You should have at least two quotes in
    // table quotes. layout each quote using a combo of PHP and HTML
    // strings that includes HTML for buttons along with the actual
    // quote and the author, ~15 PHP statements. This function will
    // be the most time consuming in Quotes 1. You will
    // need to add css rules to styles.css.
    $result = '';
    foreach ( $arr as $cols) {
        $result .= '<br><br><div class="container">';
        $result .= '"' . $cols ['quote'] . '"';
        $result .= '<br><br>';
        $result .= '<p class="author">';
        $result .= '&nbsp;&nbsp;--';
        $result .= $cols['author'];
        $result .= '<br></p><form action="controller.php" method="post">';
        $result .= '<input type="hidden" name="ID" value="' ;
        $result .= $cols['id'];
        $result .= '">&nbsp;&nbsp;&nbsp;';
        $result .= '<button name="update" class="plusButton" value="increase">+</button>';
        $result .= '&nbsp;<span id="rating"> ';
        $result .=  $cols['rating'];
        $result .=  ' </span>&nbsp;&nbsp;';
        $result .= '<button name="update" class="minusButton" value="decrease">-</button> &nbsp;&nbsp;';
        if(isset ($_SESSION ['user']))  { 
            $result .= '<button name="update" class="delButton" value="delete">Delete</button></form></div>';
        } else {
            $result .= '</form></div>';
        }
    }
    
    return $result;
}



?>