<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "goran.orsolic19@gmail.com";
    $email_subject = "Your email subject line";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['ime']) ||
        !isset($_POST['ulica']) ||
        !isset($_POST['mjesto']) ||
        !isset($_POST['zip']) ||
        !isset($_POST['tel']) ||
        !isset($_POST['email']) ||
        !isset($_POST['poruka'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['ime']; // required
    $ulica = $_POST['ulica']; // not required
    $mjesto = $_POST['mjesto']; // not required
    $zip = $_POST['zip']; // not required
    $tel = $_POST['tel']; // not required
    $brand = $_POST['brand']; // not required
    $issue = $_POST['issue']; // not required
    $email_from = $_POST['email']; // required
    $poruka = $_POST['poruka']; // not required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Ulica: ".clean_string($ulica)."\n";
    $email_message .= "Mjesto: ".clean_string($mjesto)."\n";
    $email_message .= "Poštanski broj: ".clean_string($zip)."\n";
    $email_message .= "Proizvođač: ".clean_string($brand)."\n";
    $email_message .= "Stanje: ".clean_string($issue)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Poruka: ".clean_string($poruka)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Hvala na upitu, kontaktirati ćemo Vas u najkraćem roku.
 <a href="index.html">Natrag</a></li>
<?php
 
}
?>