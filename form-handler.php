<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST['name']));  // Sanitize input
    $visitor_email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); // Sanitize email
    $message = strip_tags(trim($_POST['message'])); // Sanitize input

    // Validate email
    if (filter_var($visitor_email, FILTER_VALIDATE_EMAIL) === false) {
        // Handle invalid email (e.g., redirect with an error message)
        header("Location: contact.html?email_error=true"); // Example: Redirect back to contact page
        exit;
    }

    $email_from = 'info@king-chi.org';
    $email_subject = 'New Comment Submission';  // More specific subject
    $email_body = "User Name: $name.\nUser Email: $visitor_email.\nUser Message: $message.\n";

    $to = 'info@king-chi.org';

    $headers = "From: $email_from\r\n";
    $headers .= "Reply-To: $visitor_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // Recommended: Specify content type

    if (mail($to, $email_subject, $email_body, $headers)) {
        // Success!
        header("Location: contact.html?message=success"); // Redirect with success message
        exit;
    } else {
        // Error sending email
        header("Location: contact.html?mail_error=true"); // Redirect with error message
        exit;
    }
} else {
    // Not a POST request
    header("Location: contact.html"); // Redirect to contact page
    exit;
}
?>
