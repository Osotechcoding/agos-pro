<?php

use PHPMailer\PHPMailer\PHPMailer;

$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.mailtrap.io';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = '71f8d31ac958eb';
$phpmailer->Password = '5479f82c1922d6';