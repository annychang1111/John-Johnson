<?php
// Property of: CCP
// Designer and Developer: Anny Chang
// configure
$from = 'John B. Johnson, M.D. Contact Form <contact@choice.md>';
$sendTo ='Susan Infield <sinfield@choice.md>'; //'Keith Elgart <kelgart@choice.md>,Cynthia Dunbar <cdunbar@choice.md>';
$subject = 'John B. Johnson, M.D. Contact Form';
$fields = array( 
	'lastname' => 'Last Name',
	'firstname' => 'First Name', 
	'email' => 'Email', 
	'phone' => 'Phone', 
	'message' => "Messages",

); // array variable name => Text to appear in email
$okMessage = ' Thank You! ';
$errorMessage = 'There was an error while submitting the form. Please try again later';

// let's do the sending

try {
	$emailText = "Contact Form\n\n";

	foreach ( $_POST as $key => $value ) {

		if ( isset( $fields[ $key ] ) ) {
			$emailText .= "$fields[$key]: $value\n";
		}
	}

	mail( $sendTo, $subject, $emailText, "From: " . $from );

	$responseArray = array(
		'type' => 'success',
		'message' => $okMessage
	);
} catch ( \Exception $e ) {
	$responseArray = array(
		'type' => 'danger',
		'message' => $errorMessage
	);
}

if ( !empty( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) {
	$encoded = json_encode( $responseArray );

	header( 'Location: thankyou.html' );

	// echo $encoded;
} else {
	header( 'Location: thankyou.html' );
}
?>