# Blog_Demo_king-chi
Follow along Demo [,](https://www.youtube.com/@King-Chi-m9s) create Blog page with comment section. fixing PHP error message: This XML file does not appear to have any style information associated with it. The document tree is shown below.
<Error>
<Code>InvalidArgument</Code>
<Message>Invalid argument.</Message>
<Details>POST object expects Content-Type multipart/form-data</Details>
</Error>

Explanation:

This PHP code, is designed to handle the submission of the comment form on your webpage. Here's a breakdown of what it does:

Checks the Request Method:

if ($_SERVER["REQUEST_METHOD"] == "POST"): It first verifies if the script was accessed using the HTTP POST method, which is the method your form uses (method="POST"). This ensures the code only runs when the form is submitted.
Retrieves and Sanitizes Input:

$name = strip_tags(trim($_POST['name']));: It retrieves the value entered in the "name" field, removes any HTML or PHP tags (strip_tags) to prevent potential security issues, and removes leading/trailing whitespace (trim).
$visitor_email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);: It retrieves the value from the "email" field, trims whitespace, and then uses filter_var with FILTER_SANITIZE_EMAIL to remove any characters that are not valid in an email address.
$message = strip_tags(trim($_POST['message']));: It retrieves the value from the "message" textarea, removes tags, and trims whitespace.
Validates Email:

if (filter_var($visitor_email, FILTER_VALIDATE_EMAIL) === false): It uses filter_var with FILTER_VALIDATE_EMAIL to check if the sanitized email address is in a valid email format. If not, it redirects the user back to contact.html with an email_error parameter in the URL.
Sets Email Parameters:

$email_from = 'info@king-chi.org';: Sets the sender's email address. Important: Some mail servers might have restrictions on the From address. You might need to use an email address associated with your domain for better deliverability.
$email_subject = 'New Comment Submission';: Sets the subject line of the email you will receive.
$email_body = "User Name: $name.\nUser Email: $visitor_email.\nUser Message: $message.\n";: Creates the body of the email, including the user's name, email, and comment. The \n creates new lines in the plain text email.
$to = 'info@king-chi.org';: Sets the recipient's email address where the comment will be sent.
Sets Email Headers:

$headers = "From: $email_from\r\n";: Sets the From header. \r\n represents a newline character, which is necessary for email headers.
$headers .= "Reply-To: $visitor_email\r\n";: Sets the Reply-To header, so when you reply to the email, it goes to the user who submitted the comment.
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";: Crucially, this line sets the content type of the email to plain text, using the UTF-8 character encoding for proper display of various characters.
Sends the Email:

if (mail($to, $email_subject, $email_body, $headers)): This is the core function that attempts to send the email. It takes the recipient, subject, body, and headers as arguments. It returns true on success and false on failure.
Handles Success or Failure:

header("Location: contact.html?message=success");: If the email is sent successfully, it redirects the user back to contact.html with a message=success parameter in the URL, which you can use to display a success message to the user.
header("Location: contact.html?mail_error=true");: If there's an error sending the email, it redirects the user back to contact.html with a mail_error=true parameter, allowing you to display an error message.
exit;: After sending the header for redirection, exit; stops the further execution of the script.
Handles Non-POST Requests:

else { header("Location: contact.html"); exit; }: If the script is accessed using any method other than POST (e.g., directly in the browser's address bar), it redirects the user back to the contact.html page.
To make this code work with your HTML form:

Save the PHP code: Save the code above in a file named contact-form-handler.php in the same directory (or a subdirectory) as your contact.html file.
Ensure your web server is running PHP: Your website needs to be hosted on a web server that supports PHP.
Access contact.html through the web server: Open the contact.html file through your web server's URL (e.g., http://yourdomain.com/contact.html), not by directly opening the local file in your browser.
Submit the form: Fill out the form fields and click the "POST COMMENT" button.
When the form is submitted, the browser will send a POST request to contact-form-handler.php with the data from the form fields (name, email, message). The PHP script will then process this data and attempt to send the email. You can then modify your contact.html to check for the message or mail_error URL parameters and display appropriate feedback to the user.
