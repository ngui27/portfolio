<?php

class ContactController
{
    private const DEST       = 'ngui27@yelidev.ca';
    private const MAX_HOURLY = 3;

    public function send(): void
    {
        header('Content-Type: application/json; charset=UTF-8');

        // 1. Honeypot — un bot remplit ce champ caché, un humain ne le voit pas
        if (!empty($_POST['website'])) {
            echo json_encode(['success' => false, 'message' => 'Requête rejetée.']);
            exit;
        }

        // 2. CSRF — le jeton doit correspondre à celui stocké en session
        $token = $_POST['_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            echo json_encode(['success' => false, 'message' => 'Session expirée. Rechargez la page.']);
            exit;
        }

        // 3. Rate limiting — 3 envois max par heure et par session
        if (!$this->checkRateLimit()) {
            echo json_encode(['success' => false, 'message' => 'Trop de messages envoyés. Réessayez dans une heure.']);
            exit;
        }

        // 4. Assainissement et validation
        $name    = trim(strip_tags($_POST['name']    ?? ''));
        $email   = trim(strip_tags($_POST['email']   ?? ''));
        $message = trim(strip_tags($_POST['message'] ?? ''));

        if (!$name || !$email || !$message) {
            echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis.']);
            exit;
        }

        if (mb_strlen($name) > 100 || mb_strlen($email) > 150 || mb_strlen($message) > 2000) {
            echo json_encode(['success' => false, 'message' => 'Un champ dépasse la longueur maximale autorisée.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Adresse email invalide.']);
            exit;
        }

        $subject  = "=?UTF-8?B?" . base64_encode("Message de $name — YéliDev") . "?=";
        $body     = "Nom : $name\nEmail : $email\n\n$message";

        // L'adresse From doit correspondre à un email hébergé sur le même serveur o2switch.
        // Remplace noreply@yelidev.com par noreply@tondomaine.com avant de déployer.
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "From: YeliDev <noreply@yelidev.com>\r\n";
        $headers .= "Reply-To: $email\r\n";

        $sent = mail(self::DEST, $subject, $body, $headers);

        if ($sent) {
            echo json_encode(['success' => true, 'message' => 'Message envoyé ! Je vous réponds sous 24h.']);
        } else {
            echo json_encode(['success' => false, 'message' => "Erreur lors de l'envoi. Écrivez-moi directement à " . self::DEST]);
        }
        exit;
    }

    private function checkRateLimit(): bool
    {
        $now = time();

        if (!isset($_SESSION['ct_attempts'])) {
            $_SESSION['ct_attempts'] = [];
        }

        // Supprime les tentatives de plus d'une heure
        $_SESSION['ct_attempts'] = array_values(array_filter(
            $_SESSION['ct_attempts'],
            fn($t) => ($now - $t) < 3600
        ));

        if (count($_SESSION['ct_attempts']) >= self::MAX_HOURLY) {
            return false;
        }

        $_SESSION['ct_attempts'][] = $now;
        return true;
    }
}
