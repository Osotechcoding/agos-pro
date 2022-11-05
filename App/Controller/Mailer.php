<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendConfirmationEmailToNewCustomer($fullname, $email, $login_password, $tokenExp, $link)
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
  $phpmailer->addAddress("osoetchcoding@gmail.com", "Osotech");
  $phpmailer->Subject = 'Your AGOS Hotel Access Details';
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    =
    "Hi, $fullname, \r\n  <b />AGOS Hotel Created an account for you as <b> $role_type </b>\r\n with these Login Details:\r\n \r\n
     \r\n Username => $email \r\n Password => $login_password \r\n \r\n
    \r\n Click the Link below to Access your Dashboard. \r\n \r\n <a href='" . $link . "'>" . $link . "</a>  Best Regards <b /> <b>AGOS Hotel</b>.";
  $phpmailer->AltBody =
    "Hi, $fullname, \r\n  <b />AGOS Hotel Created an account for you as <b> $role_type </b>\r\n with these Login Details:\r\n \r\n
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
  $phpmailer->addAddress("osoetchcoding@gmail.com", "Osotech");
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
This is to notify you that  your wallet at AGOS Hotel was Top-Up with &#8358; " . number_format($amount, 2) . " \r\n\r\n on $date
Recharge Amount: <b>" . number_format($amount, 2) . "</b>\r\n\r\n
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
  $phpmailer->addAddress("osoetchcoding@gmail.com", "Osotech");
  $phpmailer->Subject = 'Wallet Top-Up Notification';
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
  $message_body = "Hello <b>$fullname</b>,\r\n \r\nSomebody requested a new password for the AGOS Hotel portal account associated with <b>$email</b>.\r\n \r\n
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
  $phpmailer->addAddress("osoetchcoding@gmail.com", "Osotech");
  $phpmailer->Subject = 'Password Rest Notification';
  $phpmailer->isHTML(true);   //Set email format to HTML
  $phpmailer->Body    = $message_body;
  $phpmailer->AltBody = $message_body;
  if ($phpmailer->send()) {
    return true;
  } else {
    $msg = "Sorry, Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    $msg = 'Message sent! Thanks for contacting us.';
  }
}

function sendBookingApproveNotificationToCustomer($status, $email, $name)
{

  switch ($status) {
    case 'Approved':
      $message_body = "Hello <b>$name</b>,\r\n \r\n Your Booking with AGOS Hotel was  <b>$status</b>.\r\n \r\n
Thanks for patronizing Us.\r\n \r\n
We are ready to serve you better 24/7
If you did not make a booking, please let us know immediately by replying to this email.\r\n \r\n \r\n \r\n
Yours,\r\n \r\n
The AGOS Team";
      break;
    case 'Rejected':
      $message_body = "Hello <b>$name</b>,\r\n \r\n Your Booking with AGOS Hotel was  <b>$status</b> due to some reasons that are known to the Management.\r\n \r\n
We are so sorry for any inconvenience.\r\n \r\n
Yours,\r\n \r\n
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
  $phpmailer->addReplyTo("osoetchcoding@gmail.com", "Osotech");
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