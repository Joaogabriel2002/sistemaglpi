<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.skymail.net.br';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ti@chesiquimica.com.br';         // <- seu e-mail Gmail
    $mail->Password   = 'Brasil@2025';           // <- senha de app (não sua senha da conta)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Remetente e destinatário
    $mail->setFrom('ti@chesiquimica.com.br', 'Seu Nome');
    $mail->addAddress('joaoogbriel3meia@gmail.com');

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Teste SMTP Gmail com PHPMailer';
    $mail->Body    = '<h1>Funcionando com Gmail SMTP via PHPMailer!</h1>';

    $mail->send();
    echo 'Email enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro no envio: {$mail->ErrorInfo}";
}
?>
