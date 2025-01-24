<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = htmlspecialchars(trim($_POST['first_name']));
    $lastName = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($firstName) || empty($lastName) || !$email || empty($subject) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.']);
        exit;
    }   

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'litsaetsesloulous@gmail.com';
        $mail->Password = 'tmtv tslp ugkp awov';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        $mail->setFrom($email, "$firstName $lastName");
        $mail->addAddress('litsaetsesloulous@gmail.com', 'Admin');

        $mail->isHTML(true);
        $mail->Subject = "Formulaire de contact : $subject";
        $mail->Body = "
            <h3>Nouvelle demande via le formulaire de contact</h3>
            <p><strong>Nom :</strong> $firstName $lastName</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Sujet :</strong> $subject</p>
            <p><strong>Message :</strong><br>$message</p>
        ";

        $mail->send();

        $mail->clearAddresses();
        $mail->addAddress($email);
        $mail->Subject = "Confirmation de réception de votre message";
        $mail->Body = "
            <h3>Merci de nous avoir contactés</h3>
            <p>Bonjour $firstName,</p>
            <p>Nous avons bien reçu votre message :</p>
            <blockquote>$message</blockquote>
            <p>Nous vous répondrons dans les plus brefs délais.</p>
        ";

        $mail->send();

        echo json_encode(['success' => true, 'message' => 'Votre message a été envoyé avec succès.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi du message : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode de requête invalide.']);
}
