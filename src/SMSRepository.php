<?php

namespace App;

use PDO;

class SMSRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(string $recipient, string $message): bool
    {
        $stmt = $this->db->prepare("INSERT INTO sms_messages (recipient, message) VALUES (:recipient, :message)");
        return $stmt->execute([
            ':recipient' => $recipient,
            ':message' => $message
        ]);
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM sms_messages ORDER BY sent_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
