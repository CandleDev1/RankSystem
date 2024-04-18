<?php

namespace candle\Rank;

use candle\Loader;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class rankids
{


    ##To add more ranks just do const RANKANME = RankID; + do not forget to add the RankID to intToString and to the setRankCommand variable $rankids line 33 and add the rankid in the config
    const PLAYER = 0;
    const ADMIN = 1;
    const OWNER = 2;


    public function intToString(int $rankid): string
    {
        return match ($rankid) {
            0 => "Player",
            1 => "Admin",
            2 => "Owner"
        };
    }

    /**
     * @param string $player
     * @return string
     */
    public function getFormat(string $player): string
    {
        return TextFormat::colorize(Loader::getInstance()->getConfig()->getNested("format." . Loader::getInstance()->getDatabase()->getRankID($player) . ".format"));
    }

}