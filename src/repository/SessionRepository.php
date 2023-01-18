<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class SessionRepository
{
    public function createSession(int $user_id): string
    {
        $conn = $this->database->connect();
        $conn->beginTransaction();

        $stmt = $conn->prepare('DELETE FROM sessions WHERE "user_id" = :user_id');
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $conn->prepare('INSERT INTO sessions ("user_id", "sessionGUID") VALUES (?, ?)');
        $guid = $this->createGUID();
        $stmt->execute([
            $user_id,
            $guid
        ]);

        $conn->commit();
        return $guid;
    }

    public function sessionExists(string $sessionGuid): bool {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM sessions WHERE "sessionGuid" = :guid
        ');
        $stmt->bindParam(':guid', $sessionGuid, PDO::PARAM_STR);
        $stmt->execute();

        $session = $stmt->fetch(PDO::FETCH_ASSOC);
        return $session != false;
    }

    public function deleteSession(string $sessionGUID) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM sessions WHERE "sessionGUID" = :guid
        ');
        $stmt->bindParam(':guid', $sessionGUID, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function deleteOldSessions() {
        $time = time() - (86400 * 30);
        $stmt = $this->database->connect()->prepare('
            DELETE FROM sessions WHERE "dateGenerated" < to_timestamp(:time)
        ');
        $stmt->bindParam(':time', $time, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function createGUID()
    {
        mt_srand(intval(floatval(microtime())*10000));
        $set_charid = strtoupper(md5(uniqid(rand(), true)));
        $set_hyphen = chr(45);
        return substr($set_charid, 0, 8).$set_hyphen
        .substr($set_charid, 8, 4).$set_hyphen
        .substr($set_charid,12, 4).$set_hyphen
        .substr($set_charid,16, 4).$set_hyphen
        .substr($set_charid,20,12);
    }
}