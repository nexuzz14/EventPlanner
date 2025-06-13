<?php
// File: send_email.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'activationakun@gmail.com';
        $mail->Password   = 'dfghlglqubnxsgtl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // Tambahkan header penting
        $mail->addCustomHeader('Precedence: bulk');
        $mail->addCustomHeader('X-MSMail-Priority: Normal');
        $mail->addCustomHeader('X-Mailer: PHP/' . phpversion());
        // Tambahkan header autentikasi
        $mail->addCustomHeader('List-Unsubscribe: <mailto:admin@example.com?subject=unsubscribe>');

        // Recipients
        $mail->setFrom('WoncrewOrganinzer@gmail.com', 'Woncrew Organnizer');
        $mail->addAddress('andry.antok25@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reservasi Baru dari ' . $_POST['name'];

        $messageBody = '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Reservasi Baru</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd;">r
        <h2 style="color: #1a237e;">Detail Reservasi</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr><td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Nama:</strong></td><td style="padding: 8px; border-bottom: 1px solid #eee;">' . htmlspecialchars($_POST['name']) . '</td></tr>
            <tr><td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Email:</strong></td><td style="padding: 8px; border-bottom: 1px solid #eee;">' . htmlspecialchars($_POST['email']) . '</td></tr>
            <tr><td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Telepon:</strong></td><td style="padding: 8px; border-bottom: 1px solid #eee;">' . htmlspecialchars($_POST['phone']) . '</td></tr>
            <tr><td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Jenis Acara:</strong></td><td style="padding: 8px; border-bottom: 1px solid #eee;">' . htmlspecialchars($_POST['event_type']) . '</td></tr>
            <tr><td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Tanggal Acara:</strong></td><td style="padding: 8px; border-bottom: 1px solid #eee;">' . htmlspecialchars($_POST['event_date']) . '</td></tr>
            <tr><td style="padding: 8px;"><strong>Jumlah Tamu:</strong></td><td style="padding: 8px;">' . htmlspecialchars($_POST['guest_count']) . '</td></tr>
        </table>
        <div style="margin-top: 20px; padding: 15px; background: #f8f9fa;">
            <h3 style="color: #1a237e;">Deskripsi Acara</h3>
            <p>' . nl2br(htmlspecialchars($_POST['message'])) . '</p>
        </div>
        <p style="margin-top: 20px; font-size: 0.9em; color: #666;">
            sistem reservasi Woncrew Organizer
        </p>
    </div>
</body>
</html>
';

        $mail->Body    = $messageBody;
        $mail->AltBody = strip_tags($messageBody);

        $mail->send();
        echo '<script>alert("Reservasi berhasil dikirim!"); window.location.href = "index.html";</script>';
    } catch (Exception $e) {
        echo '<script>alert("Gagal mengirim reservasi. Error: ' . str_replace("'", "\\'", $mail->ErrorInfo) . '");</script>';
    }
}
