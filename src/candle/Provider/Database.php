<?php

namespace candle\Provider;

use candle\Loader;
use candle\Rank\rankids;
use PDO;
use pocketmine\player\Player;
use SQLite3;

class Database
{

    public static $rankid;
    private SQLite3 $database;

    public function initDatabase() {
        $this->database = new SQLite3(Loader::getInstance()->getDataFolder() . 'ranks.db');
        $this->database->exec("CREATE TABLE IF NOT EXISTS ranks(username VARCHAR(32),rankID INT DEFAULT 0,tagID int DEFAULT 0)");
    }

    public function createAccount(string $player): void {
        $stmt = $this->database->prepare("INSERT INTO ranks(username) VALUES(:username)");
        $stmt->bindValue(":username", strtolower($player));
        $stmt->execute();
    }


    public function getAccount(string $player) {
        $statement = $this->database->prepare("SELECT username FROM ranks WHERE username = :player");
        $statement->bindValue(":player", strtolower($player));
        $result = $statement->execute();
        return $result->fetchArray(SQLITE3_ASSOC)["username"];
    }


    public function setRankID(string $player, int $rankid): void
    {
        $stmt = $this->database->prepare("UPDATE ranks set rankID = :rankID WHERE username = :player");
        $stmt->bindValue(':rankID', $rankid,PDO::PARAM_INT);
        $stmt->bindValue(':player', strtolower($player));
        $stmt->execute();
    }

    public function setTagID(string $player, int $tagID) {
        $stmt = $this->database->prepare("UPDATE ranks set tagID = :tagID WHERE username = :player");
        $stmt->bindValue(':tagID', $tagID,PDO::PARAM_INT);
        $stmt->bindValue(':player', strtolower($player));
        $stmt->execute();
    }

    public function getRankID(string $player) {
        $stmt = $this->database->prepare("SELECT rankID FROM ranks WHERE username = :player");
        $stmt->bindValue(':player', strtolower($player));
        $rslt = $stmt->execute();
        return $rslt->fetchArray(SQLITE3_ASSOC)["rankID"] ?? 0;
    }


    public function getTagID(string $player) {
        $stmt = $this->database->prepare("SELECT tagID FROM ranks WHERE username = :player");
        $stmt->bindValue(':player', strtolower($player));
        $rslt = $stmt->execute();
        return $rslt->fetchArray(SQLITE3_ASSOC)["tagID"] ?? 0;
    }


}