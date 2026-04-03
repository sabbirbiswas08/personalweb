<?php
require_once __DIR__ . '/admin/includes/db.php';

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize input
    $firstName = htmlspecialchars(trim($_POST['firstName'] ?? ''));
    $lastName = htmlspecialchars(trim($_POST['lastName'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate
    if ($firstName && $lastName && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
        
        try {
            // 1. Save to Database
            $stmt = $pdo->prepare("INSERT INTO form_submissions (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $email, $subject, $message]);

            // 2. Send via SMTP
            require_once __DIR__ . '/admin/includes/smtp_mail.php';
            
            // Get Admin Email from settings
            $stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'admin_email'");
            $adminEmail = $stmt->fetchColumn() ?: 'hello@sabbirbiswas.com';

            $mailSubject = "New Website Inquiry from $firstName $lastName";
            $mailBody = "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title>Website Inquiry</title>
            </head>
            <body style='font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; padding: 40px 20px; color: #1e293b; line-height: 1.5;'>
                <!-- Preheader -->
                <div style='display: none; max-height: 0px; overflow: hidden;'>
                    New message from $firstName $lastName regarding $subject.
                </div>
                
                <div style='max-width: 580px; margin: 0 auto; background: #ffffff; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);'>
                    <div style='margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;'>
                        <h2 style='margin: 0; font-size: 20px; font-weight: 700; color: #6366f1; letter-spacing: -0.01em;'>New Website Inquiry</h2>
                        <span style='font-size: 13px; color: #94a3b8;'>Received on " . date('F j, Y \a\t g:i A') . "</span>
                    </div>

                    <div style='margin-bottom: 24px;'>
                        <label style='display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 6px; letter-spacing: 0.05em;'>From</label>
                        <div style='font-size: 15px; color: #0f172a;'>$firstName $lastName</div>
                    </div>

                    <div style='margin-bottom: 24px;'>
                        <label style='display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 6px; letter-spacing: 0.05em;'>Email Address</label>
                        <div style='font-size: 15px;'><a href='mailto:$email' style='color: #6366f1; text-decoration: none;'>$email</a></div>
                    </div>
                    
                    <div style='margin-bottom: 30px;'>
                        <label style='display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 6px; letter-spacing: 0.05em;'>Message</label>
                        <div style='background: #f8fafc; padding: 20px; border-radius: 12px; font-size: 15px; color: #334155; border: 1px solid #f1f5f9; white-space: pre-wrap;'>$message</div>
                    </div>

                    <div style='padding-top: 30px; border-top: 1px solid #f1f5f9; font-size: 12px; color: #94a3b8; text-align: center;'>
                        This is an automated notification from your portfolio CMS.<br>
                        Powered by AI &bull; Sabbir Biswas CMS
                    </div>
                </div>
            </body>
            </html>
            ";
            
            // Send using the SMTP function I just built
            $sent = smtp_mail($adminEmail, $mailSubject, $mailBody, ["Reply-To: $email"]);

            if (!$sent) {
                // Fallback to basic mail if SMTP fails
                $fallbackHeaders = "From: Website Contact Form <" . SMTP_FROM . ">\r\n";
                $fallbackHeaders .= "Reply-To: $email\r\n";
                $fallbackHeaders .= "MIME-Version: 1.0\r\n";
                $fallbackHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";
                @mail($adminEmail, $mailSubject, $mailBody, $fallbackHeaders, "-f " . SMTP_FROM);
            }

            // Respond success to AJAX
            echo json_encode(["status" => "success", "message" => "Message sent! We'll be in touch soon."]);

        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Database error occurred."]);
        }

    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Invalid form submission. Please fill all fields."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed."]);
}
?>
