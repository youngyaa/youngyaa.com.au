<?php

require_once('phpmailer/class.phpmailer.php');

$mail = new PHPMailer();

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if( $_POST['contactform-name'] != '' AND $_POST['contactform-email'] != '' AND $_POST['contactform-message'] != '' ) {

        $name = $_POST['contactform-name'];
        $email = $_POST['contactform-email'];
        $phone = $_POST['contactform-phone'];
        $subject = $_POST['contactform-subject'];
        $message = $_POST['contactform-message'];

        $subject = isset($subject) ? $subject : 'New Message From Contact Form'; // Enter the subject here.

        $toemail = 'youremail@yourwebsite.com'; // Enter your mail addres here.
        $toname = 'Your Name'; // Enter your name here.

		$mail->SetFrom( $email , $name );
		$mail->AddReplyTo( $email , $name );
		$mail->AddAddress( $toemail , $toname );
		$mail->Subject = $subject;

		$name = isset($name) ? "Name: $name<br><br>" : '';
		$email = isset($email) ? "Email: $email<br><br>" : '';
		$phone = isset($phone) ? "Phone: $phone<br><br>" : '';
		$message = isset($message) ? "Message: $message<br><br>" : '';

		$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';

		$body = "$name $email $phone $message $referrer";

		$mail->MsgHTML( $body );
		$sendEmail = $mail->Send();

		if( $sendEmail == true ):
			echo 'Message sent!';
		else:
			echo 'Email could not be sent. Please Try Again later.<br /><br />Reason:<br />' . $mail->ErrorInfo . '';
		endif;

    } else {
        echo 'Please Fill up all the Fields and Try Again.';
    }
} else {
    echo 'An unexpected error occured. Please Try Again later.';
}

?>