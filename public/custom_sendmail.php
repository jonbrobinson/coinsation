<?php

require '../vendor/autoload.php';
use Mailgun\Mailgun;

$mgClient = new Mailgun('key-bfbdd530ab6e397261a81dd320f9edcf');
$domain = "sandbox6f543aca5c93485abadae62657a3d854.mailgun.org";

$emailTo = "support@coinsation.com";


// Email Submit
// Note: filter_var() requires PHP >= 5.2.0
if ( isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {

  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ( $_POST as $key => $val ) {
    if ( preg_match( $test, $val ) ) {
      exit;
    }
  }

  $result = $mgClient->sendMessage($domain, array(
      'from'    => $_POST['name'] .' <' . $_POST['email'] . '>',
      'to'      => 'Ted Oakley <'. $emailTo . '>',
      'subject' => '[Coinsation Message] ' . $_POST['subject'],
      'text'    => "Message from {$_POST['name']} \n\n" .$_POST['message']
  ));
}
?>