<?php

namespace candle\Rank;

use candle\Loader;
use pocketmine\utils\TextFormat;

class tagids
{

    const nothing = 0;
    const OG = 11;
    const Clown = 2;
    const WOMP = 3;
    const PRO = 4;
    const UWU = 5;
    const DMOD = 6;
    const DUMB = 7;
    const ICEBREAKER = 8;
    const FIRE = 9;
    const FAT =10;

    public function TagToString(int $tagid): string {
        return match ($tagid) {
            0 => "",
            11 => "OG",
            2 => "Clown",
            3 => "WOMP",
            4 => "PRO",
            5 => "UWU",
            6 => "DMOD",
            7 => "Dumb",
            8 => "ICEBREAKER",
            9 => "Fire",
            10 => "Fat"
        };
    }

    /**
     * @param string $player
     * @return string
     */
    public function getFormat(string $player): string
    {
        return Loader::getInstance()->getConfig()->getNested("Tagformat." . Loader::getInstance()->getDatabase()->getTagID($player) . ".format");
    }

}