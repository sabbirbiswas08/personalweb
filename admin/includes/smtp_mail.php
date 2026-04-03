<?php
/**
 * Simple SMTP Mailer Class
 * (c) Sabbir Biswas CMS - Secure & Lightweight
 */

function smtp_mail($to, $subject, $message, $headers_arr = []) {
    $host = SMTP_HOST;
    $port = SMTP_PORT; // 465 for SSL, 587 for TLS
    $user = SMTP_USER;
    $pass = SMTP_PASS;
    $from = SMTP_FROM;

    $timeout = 10;
    
    // Determine transport protocol
    $socket_host = ($port == 465) ? "ssl://$host" : $host;
    
    $socket = @stream_socket_client($socket_host . ":" . $port, $errno, $errstr, $timeout);
    if (!$socket) {
        error_log("SMTP Error: $errstr ($errno)");
        return false;
    }

    $responses = [];
    $responses[] = fgets($socket, 1024);

    // EHLO
    fwrite($socket, "EHLO " . $_SERVER['HTTP_HOST'] . "\r\n");
    $responses[] = ""; while ($line = fgets($socket, 1024)) { $responses[count($responses)-1] .= $line; if ($line[3] === " ") break; }

    // SMTP AUTH
    fwrite($socket, "AUTH LOGIN\r\n");
    $responses[] = fgets($socket, 1024);
    
    fwrite($socket, base64_encode($user) . "\r\n");
    $responses[] = fgets($socket, 1024);
    
    fwrite($socket, base64_encode($pass) . "\r\n");
    $responses[] = fgets($socket, 1024);
    
    if (strpos($responses[count($responses)-1], '235') === false) {
        error_log("SMTP Auth Failed: " . end($responses));
        return false;
    }

    // MAIL FROM
    fwrite($socket, "MAIL FROM: <$from>\r\n");
    $responses[] = fgets($socket, 1024);

    // RCPT TO
    fwrite($socket, "RCPT TO: <$to>\r\n");
    $responses[] = fgets($socket, 1024);

    // DATA
    fwrite($socket, "DATA\r\n");
    $responses[] = fgets($socket, 1024);

    // Construct full email data
    $headers = "To: $to\r\n";
    $headers .= "From: Website Contact Form <$from>\r\n";
    $headers .= "Subject: $subject\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n";
    $headers .= "Date: " . date("r") . "\r\n";
    
    // Add custom headers if any
    foreach($headers_arr as $h) {
        $headers .= trim($h) . "\r\n";
    }

    fwrite($socket, $headers . "\r\n" . $message . "\r\n.\r\n");
    $responses[] = fgets($socket, 1024);

    // QUIT
    fwrite($socket, "QUIT\r\n");
    fclose($socket);

    return (strpos(end($responses), '250') !== false);
}
?>
