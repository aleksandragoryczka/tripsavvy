<?php

class Session
{
    private $id;
    private $userId;
    private $sessionGuid;
    private $dateGenerated;

    public function __construct(
        $id,
        $userId,
        $sessionGuid,
        $dateGenerated
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->sessionGuid = $sessionGuid;
        $this->dateGenerated = $dateGenerated;
    }

    public function getDateGenerated(): DateTime {
        return $this->dateGenerated;
    }
}