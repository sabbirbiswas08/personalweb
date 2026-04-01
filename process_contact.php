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

            // 2. Send Email
            // Get Admin Email from settings
            $stmt = $pdo->query("SELECT setting_value FROM settings WHERE setting_key = 'admin_email'");
            $adminEmail = $stmt->fetchColumn() ?: 'hello@sabbirbiswas.com';

            $mailSubject = "New Website Inquiry: " . $subject;
            $mailBody = "You have received a new message from your website.\n\n" .
                        "Name: $firstName $lastName\n" .
                        "Email: $email\n" .
                        "Subject: $subject\n\n" .
                        "Message:\n$message\n";
            
            $headers = "From: Website Contact Form <noreply@" . $_SERVER['HTTP_HOST'] . ">\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

            // The -f flag sets the envelope-sender, critical for cPanel routing
            @mail($adminEmail, $mailSubject, $mailBody, $headers, "-f noreply@" . $_SERVER['HTTP_HOST']);

            // Respond success to AJAX
            echo json_encode(["status" => "success", "message" => "Message sent successfully"]);

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
