<?php

use PHPMailer\PHPMailer\PHPMailer;

$msg = '';
if (array_key_exists('email', $_POST)) {
  require '../Controller/vendor/autoload.php';
  $phpmailer = new PHPMailer();
  $phpmailer->isSMTP();
  $phpmailer->SMTPDebug = 0; // SMTP::DEBUG_SERVER;
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '71f8d31ac958eb';
  $phpmailer->Password = '5479f82c1922d6';
  $phpmailer->setFrom('admin@agos.com', 'Admin');
  $phpmailer->addAddress('osotechcoding@gmail.com', 'Samson Jerry');
  if ($phpmailer->addReplyTo($_POST['email'], $_POST['name'])) {
    $phpmailer->Subject = 'PHPMailer contact form';
    $phpmailer->isHTML(false);
    $phpmailer->Body = <<<EOT
            Email: {$_POST['email']}
            Name: {$_POST['name']}
            Message: {$_POST['message']}
EOT;
    if (!$phpmailer->send()) {
      $msg = "Sorry, Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    } else {
      $msg = 'Message sent! Thanks for contacting us.';
    }
  } else {
    $msg = 'Share it with us!';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Contact form</title>
</head>

<body>
  <h1>Contact us</h1>
  <?php if (!empty($msg)) {
    echo "<h2>$msg</h2>";
  } ?>
  <form method="POST">
    <label for="name">Name: <input type="text" name="name" id="name"></label><br>
    <label for="email">Email address: <input type="email" name="email" id="email"></label><br>
    <label for="message">Message: <textarea name="message" id="message" rows="8" cols="20"></textarea></label><br>
    <input type="submit" value="Send">
  </form>
</body>

</html>