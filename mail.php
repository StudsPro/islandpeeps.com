<?php


$to= 'thelastgraliator@gmail.com';

// subject
$subject = 'Birthday Reminders for August';

// message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
// Mail it
//mail($to, $subject, $message, $headers);
$message="Test";
mail($to, $subject, $message);

 // jVCdekJXJMkr_i7bWMwTWg
 define('Notification_EmailFrom' , 'notifications@limousinerentalsingapore.com');

define('Notification_EmailFromName' , 'Limousinecars');

define('Mandrill_API_Key' , 'jVCdekJXJMkr_i7bWMwTWg');

define('Mandrill_Message_URL' , 'https://mandrillapp.com/api/1.0/messages/send.json');
 send_email($subject,$message,$to,"Anil");
  function send_email($subject,$html_body,$to_email,$to_name)
 {
  
        
  $posted_json='{"key": "'.Mandrill_API_Key.'","message": {"html": "'.$html_body.'","subject": "'.$subject.'","from_email": "'.Notification_EmailFrom.'","from_name": "'.Notification_EmailFromName.'","to": [{"email": "'.$to_email.'","name": "'.$to_name.'","type": "to"}]},"async": true}';
       

  $request_do = curl_init();
  curl_setopt($request_do, CURLOPT_URL, Mandrill_Message_URL);
        curl_setopt($request_do, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($request_do, CURLOPT_TIMEOUT,        30);
        curl_setopt($request_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($request_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($request_do, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($request_do, CURLOPT_POST,           true );
        curl_setopt($request_do, CURLOPT_POSTFIELDS,     $posted_json);
        //curl_setopt($request_do, CURLOPT_HTTPHEADER,     $this->Headers);
        $result = curl_exec($request_do);
        echo "<pre>";
        print_r($result); 
        curl_close($request_do);
  return $result;
 }




echo "Test"; exit;
?>