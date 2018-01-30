<?php
$next_page="/";

// Visitor's email address from web form
//$emailField=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['emailField']));
$emailFieldFiltered=filter_var($_REQUEST['emailField'], FILTER_SANITIZE_EMAIL);

// filter_var() returns false if not a valid email
// strlen() > 0 makes sure there is a valid email to send on
// $_REQUEST['nameField'] is a hidden form field with a fixed value to avoid bots
if($emailFieldFiltered !== false && strlen($emailFieldFiltered) > 0 && $_REQUEST['nameField'] == "Fred Flintstone") {

      // to, from, and subject
      $to  = 'jeff@geeklearn.com'; 
      $from = "Smart Sixty Six Website Visitor <jeff@geeklearn.com>";

      $subject = 'Smart Sixty Six Website Visitor';
      $next_page="/sent.html";

      // message
      $message = '
      <html>
      <body>
      <br><b><font style=color:#0099ff>' . $subject . '</font></b><br>
      <table width=708 border=0 cellpadding=2 cellspacing=1 bgcolor=#CCCCCC>

      <tr>
            <td width=165 align=right valign=top bgcolor=#FFFFFF><B>E-Mail Filtered:</b> </td>
            <td width=565 align=left valign=top bgcolor=#FFFFFF>' . $emailFieldFiltered . '</td>
      </tr>

      </table>
      </body>
      </html>
      ';

      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= "From: " . $from;

      // Mail it
      mail($to, $subject, $message, $headers);
} 
// Redirect to Success or Fail Page
header("Location:$next_page");
?>