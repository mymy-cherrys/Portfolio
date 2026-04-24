<?php
// contact.php — Traitement du formulaire de contact
mb_internal_encoding('UTF-8');
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo '<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Méthode non autorisée</title></head><body><p>Méthode non autorisée.</p></body></html>';
    exit;
}

// Anti-spam (honeypot)
if (!empty($_POST['website'])) {
    http_response_code(200);
    echo '<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Merci</title><link rel="stylesheet" href="contact.css"></head><body><main class="frame"><h1>Merci</h1><p class="intro">Votre message a été envoyé.</p><p class="postscript"><a href="index.html">Retour à l\'accueil</a></p></main></body></html>';
    exit;
}

// Récupération + nettoyage
$name    = isset($_POST['name'])    ? trim(strip_tags($_POST['name']))    : '';
$email   = isset($_POST['email'])   ? trim($_POST['email'])               : '';
$subject = isset($_POST['subject']) ? trim(strip_tags($_POST['subject'])) : '';
$message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

// Validation
$errors = [];
if ($name === '')    { $errors[] = 'Le nom est requis.'; }
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "L'email est invalide."; }
if ($message === '') { $errors[] = 'Le message est requis.'; }

if (!empty($errors)) {
    http_response_code(422);
    echo '<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Erreur</title><link rel="stylesheet" href="contact.css"></head><body>';
    echo '<main class="frame"><h1>Oups…</h1><p class="intro">Merci de corriger ces erreurs :</p><ul style="margin:0 0 18px 18px;">';
    foreach ($errors as $e) echo '<li>'.htmlspecialchars($e, ENT_QUOTES, 'UTF-8').'</li>';
    echo '</ul><p class="postscript"><a href="contact.html">Revenir au formulaire</a></p></main></body></html>';
    exit;
}

// Construction du message
$to = 'e.guilbaud24@gmail.com';
$cleanSubject = $subject !== '' ? $subject : 'Nouveau message depuis le portfolio';
$mailSubject  = '[Contact Portfolio] '.$cleanSubject;

$ip   = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'n/a';
$when = date('Y-m-d H:i:s');

$body  = "Vous avez reçu un message depuis le formulaire du portfolio\n\n";
$body .= "Nom: ".$name."\n";
$body .= "Email: ".$email."\n";
$body .= "Sujet: ".$cleanSubject."\n\n";
$body .= "Message:\n".$message."\n\n";
$body .= "--\nIP: ".$ip."\nDate: ".$when."\n";

// Envoi d'email via service externe (FormSubmit ou alternative)
$sent = sendEmailViaService($name, $email, $mailSubject, $message, $body);

if ($sent) {
    echo '<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Merci</title><link rel="stylesheet" href="contact.css"></head><body><main class="frame"><h1>Merci 🎉</h1><p class="intro">Votre message a bien été envoyé. Je vous répondrai rapidement.</p><p class="postscript"><a href="index.html">Retour à l\'accueil</a> · <a href="contact.html">Envoyer un autre message</a></p></main></body></html>';
} else {
    http_response_code(500);
    echo '<!doctype html><html lang="fr"><head><meta charset="utf-8"><title>Erreur</title><link rel="stylesheet" href="contact.css"></head><body><main class="frame"><h1>Oups…</h1><p class="intro">Un problème est survenu lors de l\'envoi. Réessayez plus tard.</p><p class="postscript"><a href="contact.html">Revenir au formulaire</a></p></main></body></html>';
}

function sendEmailViaService($name, $email, $subject, $message, $fullBody) {
    // Utiliser FormSubmit.co (service gratuit de formulaires)
    $url = 'https://formsubmit.co/e.guilbaud24@gmail.com';
    
    $data = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message,
        '_replyto' => $email,
        '_next' => $_SERVER['HTTP_REFERER'] ?? 'https://localhost'
    ];
    
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
            'timeout' => 10
        ]
    ];
    
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    
    return $response !== false;
}
