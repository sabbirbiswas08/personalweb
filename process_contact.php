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
            <html>
            <body style='font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
                    <h2 style='color: #6366f1; border-bottom: 2px solid #eef2ff; padding-bottom: 10px;'>New Website Inquiry</h2>
                    <p><strong>From:</strong> $firstName $lastName</p>
                    <p><strong>Email Address:</strong> <a href='mailto:$email'>$email</a></p>
                    <p><strong>Subject:</strong> $subject</p>
                    <div style='background: #f8fafc; padding: 15px; border-left: 4px solid #6366f1; margin-top: 20px;'>
                        <p style='margin: 0; white-space: pre-wrap;'>$message</p>
                    </div>
                    <p style='font-size: 12px; color: #888; margin-top: 30px;'>Sent automatically from your portfolio website.</p>
                </div>
            </body>
            </html>
            ";
            
            // Send using the SMTP function I just built
            $sent = smtp_mail($adminEmail, $mailSubject, $mailBody, ["Reply-To: $email"]);

            if (!$sent) {
                // Fallback to basic mail if SMTP fails
                @mail($adminEmail, $mailSubject, $mailBody, "From: " . SMTP_FROM . "\r\nReply-To: $email");
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
