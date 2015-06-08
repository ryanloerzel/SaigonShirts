<?php

require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if($name =="" OR $email =="" or $message =="") {
       $error_message = "You must complete all fields of the form.";
    }

    if(!isset($error_message)){
        foreach( $_POST as $value ) {
            if ( stripos($value, 'Content-Type') !== FALSE ){
                $error_message = "There was a problem with the information you entered";
            }
        }
    }

    if (!isset($error_message) && $_POST["address"] != "") {
         $error_message = "Your form submission has an error.";
    }

    require_once(ROOT_PATH . "/inc/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer(); // defaults to using php "mail()"

    if(!isset($error_message) && !$mail->ValidateAddress($email)){
         $error_message = "You must specify a valid email address.";
    }

    if (!isset($error_message)) {
        $email_body = "";

        $email_body = $email_body . "Name: " . $name . "<br>";
        $email_body = $email_body . "Email: " . $email . "<br>";
        $email_body = $email_body . "Message: " . $message;

        //SEND THE EMAIL

        $mail->SetFrom($email,$name);

        $address = "saigonshirts@gmail.com";
        $mail->AddAddress($address, "Saigon Shirts");
        $mail->Subject    = "Saigon Shirts | " . $name;
        $mail->MsgHTML($email_body);

        if($mail->Send()) {  
            header("Location: " . BASE_URL . "contact/?status=thanks");
            exit;
        } 
        else {
            $error_message = "There was a problem sending the email: " . $mail->ErrorInfo;
        }
    }
}

?><?php 
$pageTitle = "Contact Saigon Shirts";
$section = "contact";
include(ROOT_PATH . '/inc/header.php'); ?>
                          
<div class="contact_page">
     <div class="container">
            <h1>Contact Us</h1>
            <p> We would like to hear from you.  Please let us know if you have any questions or concerns.</p>

            <?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
                <p class="validated">Thanks for the email. I&rsquo;ll be in touch shortly.<p/>
            <?php } 
            else {?>

                <?php
                    if (isset ($error_message)) {
                        echo '<p class="message">' . $error_message . '</p>';
                    }
                ?>
                <form method="post" action="<?php echo BASE_URL; ?>contact/">
                    <table>
                        <tr>
                            <th>
                                <label for="name">Name</label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name" value="<?php if (isset($name)){ echo htmlspecialchars($name);} ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="email">Email</label>
                            </th>
                            <td>
                                <input type="text" name="email" id="email" value="<?php if (isset($email)){ echo htmlspecialchars($email);} ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="message">Message</label>
                            </th>
                            <td>
                                <textarea name="message" id="message"><?php if (isset($message)){ echo htmlspecialchars($message);} ?></textarea>
                            </td>
                        </tr>   
                        <tr style="display: none;">
                            <th>
                                <label for="address">Adress</label>
                            </th>
                            <td>
                                <input type="text" name="address" id="address">
                            </td>
                        </tr>

                    </table>
                    <input type="submit" value="Send">
                </form>
            <?php } ?>
     </div>
</div>

<?php include(ROOT_PATH . '/inc/footer.php'); ?> 
