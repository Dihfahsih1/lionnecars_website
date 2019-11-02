<?php
/*
This first bit sets the email address that you want the form to be submitted to.
You will need to change this value to a valid email address that you can access.
*/
$webmaster_email = "dihfahsihm@gmail.com";

$feedback_page = "index.html";
$error_page = "error_message.html";
$thankyou_page = "thank_you.html";

$name = $_REQUEST['name'] ;
$email_address = $_REQUEST['email'] ;
$phone = $_REQUEST['phone'] ;
$pick = $_REQUEST['pick'] ;
$destination = $_REQUEST['destination'] ;
$date = $_REQUEST['date'] ;
$carOption = $_REQUEST['car']

$msg ='<table style="width:100%">
        <tr>
            <td>'.$name.'  '.$email_address.'</td>
        </tr>
        <tr><td>Email: '.$phone.'</td></tr>
        <tr><td>phone: '.$pick.'</td></tr>
        <tr><td>Text: '.$destination.'</td></tr>
        tr><td>Text: '.$date.'</td></tr>
        tr><td>Text: '.$carOption.'</td></tr>

    </table>';

/*
The following function checks for email injection.
Specifically, it checks for carriage returns - typically used by spammers to inject a CC list.
*/
function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}
// If the form fields are empty, redirect to the error page.
if (empty($name) || empty($email_address)) {
header( "Location: $error_page" );
}
/*
If email injection is detected, redirect to the error page.
If you add a form field, you should add it here.
*/
elseif ( isInjected($email_address) || isInjected($name)  || isInjected($phone) || isInjected($pick) || isInjected($destination)|| isInjected($date) ) {
header( "Location: $error_page" );
}

// If we passed all previous tests, send the email then redirect to the thank you page.
else {

	mail( $webmaster_email, "Customer Online Booking", $msg );

	header( "Location: $thankyou_page" );
}
?>
