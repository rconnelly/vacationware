<?php
$nameError = "";
$nameError2 = '';
$emailError = '';
$commentError = '';
$ltitle = '';


 if(isset($_REQUEST['submitted'])) {
 	
	$emailto = $_REQUEST['emailto'];
	$ltitle = $_REQUEST['ltitle'];
	
	$hasError = false;
	
	if(trim($_REQUEST['contactName']) === '') {
		$nameError = 'Please enter your first name.';
		$hasError = true;
	} else {
		$name = trim($_REQUEST['contactName']);
	}
	
	if(trim($_REQUEST['contactName2']) === '') {
		$nameError2 = 'Please enter your last name.';
		$hasError = true;
	} else {
		$name = trim($_REQUEST['contactName2']);
	}

	if(trim($_REQUEST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_REQUEST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
		var_dump($emailError);
	} else {
		$email = trim($_REQUEST['email']);
	}

	if(trim($_REQUEST['commentsText']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_REQUEST['commentsText']));
		} else {
			$comments = trim($_REQUEST['commentsText']);
		}
	}
	
	
	if(!$hasError) {
		$subject = '[Message] Enquiry for '. $ltitle;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$email. "\r\n" . 'Reply-To: ' . $email;

		
		$emailSent = mail($emailto, $subject, $body, $headers);
		if($emailSent){
			echo "OK";
		}else{
			echo "not OK!";
		}
	}else{
		echo "not OK too!";
	}
}


?>