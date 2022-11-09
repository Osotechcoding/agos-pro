<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendConfirmationEmailToNewStaff($fullname, $email, $login_password, $tokenExp, $link)
{
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email, $fullname);
  $phpmailer->Subject = 'User Registration Activation Email';
  $phpmailer->isHTML(true);         //Set email format to HTML
  $phpmailer->Body    =
    "Hi, $fullname,\r\n  <b />Thank you for your Registration 
    \r\n Click this link to activate your account. <a href='" . $link . "'>" . $link . "</a> \r\n \r\n Login Details:\r\n \r\n Username => $email \r\n Password => $login_password \r\n \r\n <b />This link will expire at $tokenExp";
  $phpmailer->AltBody =
    "Hi, $fullname,\r\n Thank you for your Registration 
    \r\n Click this link to activate your account. <a href='" . $link . "'>" . $link . "</a> \r\n \r\n Login Details: Username => $email \r\n Password => $login_password \r\n \r\n This link will expire at $tokenExp";
  if ($phpmailer->send()) {
    return true;
  } else {
    return false;
  }
}

function sendLoginDetailEmailToNewStaff($fullname, $email, $login_password, $role_type, $link)
{
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email, $fullname);
  $phpmailer->addAddress("osotechcoding@gmail.com", "Osotech");
  $phpmailer->Subject = 'Your AGOS Hotel Access Details';
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    =
    "Hi, $fullname, \r\n  <br />AGOS Hotel Created an account for you as <b> $role_type </b>\r\n  with these Login Details:\r\n \r\n
     \r\n Username= $email \r\n\r\n Password = $login_password \r\n \r\n
    \r\n Click the Link below to Access your Dashboard. \r\n \r\n <a href='" . $link . "'>" . $link . "</a>  \r\n\r\n Best Regards <br /> <b> AGOS Hotel</b>.";
  $phpmailer->AltBody =
    "Hi, $fullname, \r\n  <br />AGOS Hotel Created an account for you as <b> $role_type </b>\r\n with these Login Details:\r\n \r\n
     \r\n Username => $email \r\n Password => $login_password \r\n \r\n
    \r\n Click the Link below to Access your Dashboard. \r\n \r\n <a href='" . $link . "'>" . $link . "</a>  Best Regards <b /> <b>AGOS Hotel</b>.";
  if ($phpmailer->send()) {
    return true;
  } else {
    return false;
  }
}

function sendReservationBookingInfoToCustomer($name, $email, $ref_code, $checkIn, $checkOut)
{
  $message_body = "<b>Dear " . ucfirst($name) . "</b>,\r\n\r\n 
Thank you for your Booking. \r\n\r\n 
This email is to confirm your booking at AGOS Hotel from " . date('D M jS Y', strtotime($checkIn)) . " to " . date('D M jS Y', strtotime($checkOut)) . ". Payment via Your Online Wallet Token. \r\n\r\n
Booking Reference Code: <b>$ref_code</b>\r\n\r\n
Contact 08131374443 for any questions.\r\n \r\n Best Regards <b /> <b>AGOS Hotel</b>.";
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email, $name);
  $phpmailer->addAddress("osotechcoding@gmail.com", "Osotech");
  $phpmailer->Subject = 'Room Reservation at AGOS Hotel on ' . date("Y-m-d", strtotime($checkIn));
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    = $message_body;
  $phpmailer->AltBody = $message_body;
  if ($phpmailer->send()) {
    return true;
  } else {
    return false;
  }
}

function sendTopUpWalletNotificationToCustomer($name, $email, $amount, $date)
{
  $message_body = "<b>Dear " . $name . "</b>,\r\n\r\n 
This is to notify you that  your wallet account at AGOS Hotel was Credited with <b> &#8358; " . number_format($amount, 2) . "</b> \r\n\r\n on $date
by the Admin:\r\n\r\n
Contact 08131374443 for any questions.\r\n \r\n Best Regards <br /> <b>AGOS Hotel</b>.";
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email, $name);
  $phpmailer->addAddress("osotechcoding@gmail.com", "Osotech");
  $phpmailer->Subject = 'Wallet Credit Alert @ AGOS Hotel';
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    = $message_body;
  $phpmailer->AltBody = $message_body;
  if ($phpmailer->send()) {
    return true;
  } else {
    return false;
  }
}

function
sendCustomerPasswordResetLinkViaEmail($fullname, $email, $link)
{
  $message_body = "Hello <b>$fullname</b>,\r\n \r\n Somebody requested a new password for the AGOS Hotel portal account associated with <b>$email</b>.\r\n \r\n
No changes have been made to your account yet.\r\n \r\n
You can reset your password by clicking the link below:\r\n \r\n
<a href='" . $link . "'>" . $link . "</a>\r\n \r\n
If you did not request a new password, please let us know immediately by replying to this email.\r\n \r\n \r\n \r\n
Yours,\r\n \r\n
The AGOS team";
  $msg = '';
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email, $fullname);
  $phpmailer->addReplyTo("osotechcoding@gmail.com", "Osotech");
  $phpmailer->Subject = 'Password Reset Notification';
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    = $message_body;
  $phpmailer->AltBody = $message_body;
  if ($phpmailer->send()) {
    return true;
  } else {
    return false;
  }
}

function sendBookingApproveNotificationToCustomer($status, $email, $name)
{

  switch ($status) {
    case 'Approved':
      $message_body = "Hello <b>$name</b>,\r\n \r\n Your Booking with AGOS Hotel was  <b>$status</b>.\r\n \r\n
Thanks for patronizing Us.\r\n \r\n
We are ready to serve you better.\r\n\r\n
If you did not make a booking, please let us know immediately by replying to this email.\r\n \r\n 
The AGOS Team";
      break;
    case 'Rejected':
      $message_body = "Hello <b>$name</b>,\r\n \r\n Your Booking with AGOS Hotel was  <b>$status</b> due to some reasons that are known to the Management.\r\n \r\n
We are so sorry for any inconvenience.\r\n \r\n
The AGOS Team";
      break;

    default:
      # code...
      break;
  }
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email, $name);
  $phpmailer->addReplyTo("osotechcoding@gmail.com", "Osotech");
  $phpmailer->Subject = "Booking $status Notification";
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    = $message_body;
  $phpmailer->AltBody = $message_body;
  if ($phpmailer->send()) {
    return true;
  } else {
    return false;
  }
}

function sendRejectBookingNotificationToCustomer($status, $email, $name, $message)
{
  $message_body = "Hello <b>$name</b>,\r\n \r\n Your Booking with AGOS Hotel was  <b>$status</b> due to this reason.\r\n \r\n
  \r\n \r\n <i>$message</i>
We are so sorry for any inconvenience.\r\n \r\n
\r\n \r\n
The AGOS Team";
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email, $name);
  $phpmailer->addReplyTo("osotechcoding@gmail.com", "Osotech");
  $phpmailer->Subject = "Booking $status Notification";
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    = $message_body;
  $phpmailer->AltBody = $message_body;
  if ($phpmailer->send()) {
    return true;
  } else {
    return false;
  }
}


function sendConfirmationEmailToNewCustomer($fullname, $email, $login_password, $tokenExp, $link)
{
  $message_body = messageBody($fullname, $email, $login_password, $tokenExp, $link);
  //$message_body = include_once "mail.php";
  $phpmailer = new PHPMailer(true);
  $phpmailer->SMTPDebug = 0;
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress($email);
  $phpmailer->addReplyTo("osotechcoding@gmail.com", "Osotech");
  $phpmailer->Subject = "Account verification Link";
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    = $message_body;
  $phpmailer->AltBody = $message_body;
  if ($phpmailer->send()) {
    return true; //'<p class="text-success text-center">Message Sent Successfully</p>';
  } else {
    return false; // '<p class="text-danger text-center">Message Sent Failed</p>';
  }
}

function messageBody($fullname, $email, $login_password, $tokenExp, $link)
{
  return "<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml'
  xmlns:o='urn:schemas-microsoft-com:office:office'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='x-apple-disable-message-reformatting'>
  <title> Account Activation || AGOS</title>
  <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'>
  <!-- CSS Reset : BEGIN -->
  <style>
  html,
  body {
    margin: 0 auto !important;
    padding: 0 !important;
    height: 100% !important;
    width: 100% !important;
    background: #f1f1f1;
    font-family: 'Lato', Courier, monospace, sans-serif;
  }
  * {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
  }

  div[style*='margin: 16px 0'] {
    margin: 0 !important;
  }

  table,
  td {
    mso-table-lspace: 0pt !important;
    mso-table-rspace: 0pt !important;
  }

  table {
    border-spacing: 0 !important;
    border-collapse: collapse !important;
    table-layout: fixed !important;
    margin: 0 auto !important;
  }

  img {
    -ms-interpolation-mode: bicubic;
  }

  a {
    text-decoration: none;
  }

  *[x-apple-data-detectors],
  .unstyle-auto-detected-links *,
  .aBn {
    border-bottom: 0 !important;
    cursor: default !important;
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
  }
  .a6S {
    display: none !important;
    opacity: 0.01 !important;
  }
  .im {
    color: inherit !important;
  }

  img.g-img+div {
    display: none !important;
  }

  @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
    u~div .email-container {
      min-width: 320px !important;
    }
  }

  @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
    u~div .email-container {
      min-width: 375px !important;
    }
  }
  @media only screen and (min-device-width: 414px) {
    u~div .email-container {
      min-width: 414px !important;
    }
  }
  .primary {
    background: #30e3ca;
  }
  .bg_white {
    background: #ffffff;
  }
  .bg_light {
    background: #fafafa;
  }

  .bg_black {
    background: #000000;
  }
  .bg_dark {
    background: rgba(0, 0, 0, .8);
  }

  .email-section {
    padding: 2.5em;
  }

  /*BUTTON*/
  .btn {
    padding: 10px 15px;
    display: inline-block;
  }

  .btn.btn-primary {
    border-radius: 5px;
    background: #30e3ca;
    color: #ffffff;
  }

  .btn.btn-white {
    border-radius: 5px;
    background: #ffffff;
    color: #000000;
  }

  .btn.btn-white-outline {
    border-radius: 5px;
    background: transparent;
    border: 1px solid #fff;
    color: #fff;
  }

  .btn.btn-black-outline {
    border-radius: 0px;
    background: transparent;
    border: 2px solid #000;
    color: #000;
    font-weight: 700;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    font-family: 'Lato', sans-serif;
    color: #000000;
    margin-top: 0;
    font-weight: 400;
  }

  body {
    font-family: 'Lato', sans-serif;
    font-weight: 400;
    font-size: 15px;
    line-height: 1.8;
    color: rgba(0, 0, 0, .4);
  }

  a {
    color: #30e3ca;
  }

  /*LOGO*/
  .logo h1 {
    margin: 0;
  }

  .logo h1 a {
    color: #30e3ca;
    font-size: 24px;
    font-weight: 700;
    font-family: 'Lato', sans-serif;
  }

  /*HERO*/
  .hero {
    position: relative;
    z-index: 0;
  }

  .hero .text {
    color: rgba(0, 0, 0, .3);
  }

  .hero .text h2 {
    color: #000;
    font-size: 40px;
    margin-bottom: 0;
    font-weight: 400;
    line-height: 1.4;
  }

  .hero .text h3 {
    font-size: 24px;
    font-weight: 300;
  }

  .hero .text h2 span {
    font-weight: 600;
    color: #30e3ca;
  }

  /*HEADING SECTION*/
  .heading-section h2 {
    color: #000000;
    font-size: 28px;
    margin-top: 0;
    line-height: 1.4;
    font-weight: 400;
  }

  .heading-section .subheading {
    margin-bottom: 20px !important;
    display: inline-block;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(0, 0, 0, .4);
    position: relative;
  }

  .heading-section .subheading::after {
    position: absolute;
    left: 0;
    right: 0;
    bottom: -10px;
    content: '';
    width: 100%;
    height: 2px;
    background: #30e3ca;
    margin: 0 auto;
  }

  .heading-section-white {
    color: rgba(255, 255, 255, .8);
  }

  .heading-section-white h2 {
    line-height: 1;
    padding-bottom: 0;
  }

  .heading-section-white h2 {
    color: #ffffff;
  }

  .heading-section-white .subheading {
    margin-bottom: 0;
    display: inline-block;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(255, 255, 255, .4);
  }

  ul.social {
    padding: 0;
  }

  ul.social li {
    display: inline-block;
    margin-right: 10px;
  }

  /*FOOTER*/
  .footer {
    border-top: 1px solid rgba(0, 0, 0, .05);
    color: rgba(0, 0, 0, .5);
  }

  .footer .heading {
    color: #000;
    font-size: 20px;
  }

  .footer ul {
    margin: 0;
    padding: 0;
  }

  .footer ul li {
    list-style: none;
    margin-bottom: 10px;
  }

  .footer ul li a {
    color: rgba(0, 0, 0, 1);
  }

  @media screen and (max-width: 500px) {}
  </style>
</head>

<body width='100%'
  style='margin-top: 20px; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;'>
  <center style='width: 100%; background-color: #f1f1f1;'>
    <div
      style='display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;'>
      &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style='max-width: 600px; margin: 0 auto;' class='email-container'>
      <!-- BEGIN BODY -->
      <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%'
        style='margin: auto;'>
        <tr>
          <td valign='middle' class='hero bg_white' style='padding: 3em 0 2em 0;'>
            <img src='http://localhost/agos-pro/assets/img/agos-logo.jpg'
              style='width: 200px; max-width: 200px; height: auto; margin: auto; display: block;border-radius:20px'>
          </td>
        </tr><!-- end tr -->
        <tr>
          <td valign='middle' class='hero bg_white' style='padding: 2em 0 4em 0;'>
            <table>
              <tr>
                <td>
                  <div class='text' style='padding: 0 2.5em; text-align: center;'>
                    <h4>Account email verification</h4>
                    <h3> Hi, <b> " . $fullname . ",</b><br>
</h3>
<p>Thank you for your Registration</p>
<p> To claim your <b> &#8358;30,000.00</b> bonus wallet credit for your first reservation, you need to verifiy your email, by Clicking  the link
  below.</p>
<p><a href=' " . $link . "' class='btn btn-primary'>Verify Account</a></p>
<p> if the above link did not work copy and paste this link to your browser <b> " . $link . "</b></p>
<p>Login Details: <br> Username=> " . $email . " <br /> Password=> " . $login_password . "</p>
<p>This link expires at : " . $tokenExp . "</p>
</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
<table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='margin: auto;'>
  <tr>
    <td valign='middle' class='bg_light footer email-section'>
      <table>
        <tr>
          <td valign='top' width='33.333%' style='padding-top: 20px;'>
            <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%'>
              <tr>
                <td style='text-align: left; padding-right: 10px;'>
                  <h3 class='heading'>About</h3>
                  <p>AGOS Executive Business Lounge.
                  </p>
                </td>
              </tr>
            </table>
          </td>
          <td valign='top' width='33.333%' style='padding-top: 20px;'>
            <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%'>
              <tr>
                <td style='text-align: left; padding-left: 5px; padding-right: 5px;'>
                  <h3 class='heading'>Contact Info</h3>
                  <ul>
                    <li><span class='text'>54B, Adeniyi Jones Avenue, Ikeja, Lagos</span></li>
                    <li><span class='text'>+234 705 072 3751</span></a></li>
                  </ul>
                </td>
              </tr>
            </table>
          </td>
          <td valign='top' width='33.333%' style='padding-top: 20px;'>
            <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%'>
              <tr>
                <td style='text-align: left; padding-left: 10px;'>
                  <h3 class='heading'>Useful Links</h3>
                  <ul>
                    <li><a href='http://localhost/agos-pro/'>Home</a></li>
                    <li><a href='http://localhost/agos-pro/signup'>Signup</a></li>
                  </ul>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <!-- <td class='bg_light' style='text-align: center;'>
            <p>No longer want to receive these email? You can <a href='#' style='color: rgba(0,0,0,.8);'>Unsubscribe
                here</a></p>
          </td> -->
  </tr>
</table>
</div>
</center>
</body>

</html>";
}