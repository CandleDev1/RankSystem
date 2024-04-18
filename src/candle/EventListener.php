<?php

namespace candle;

use candle\Rank\rankids;
use candle\Rank\tagids;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\player\chat\LegacyRawChatFormatter;
use pocketmine\utils\TextFormat;

class EventListener implements Listener
{


    public function PlayerLoginEvent(PlayerLoginEvent $event): void {
        $player = $event->getPlayer();
        if(!$player->hasPlayedBefore()) {
            Loader::getInstance()->getDatabase()->createAccount($player->getName());
        }
    }


    public function PlayerJoinEvent(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();

    }

    public function PlayerChatEvent(PlayerChatEvent $event): void {
        $player = $event->getPlayer();
        $msg = $event->getMessage();
        $tag = (new tagids())->getFormat($player->getName());
        $event->setFormatter(new LegacyRawChatFormatter((TextFormat::colorize(str_replace(["{tag}", "{player}", "{msg}"], [$tag,$player->getDisplayName(), $msg], (new rankids())->getFormat($player->getName()))))));

    }

//    public function PlayerChatEvent(PlayerChatEvent $event): void {
//        $player = $event->getPlayer();
//        $msg = $event->getMessage();
//
//        $rankID = Loader::getInstance()->getDatabase()->getRankID($player->getName());
//        $rankFormat = (new rankids())->getFormat($player->getName(), $rankID);
//
//        $tagID = Loader::getInstance()->getDatabase()->getTagID($player->getName());
//        $tagFormat = (new tagids())->getFormat($player->getName(), $tagID); // Pass tagID for retrieval
//
//        // Combine rank, tag, and player name using string manipulation
//        $formattedName = TextFormat::colorize($rankFormat . $tagFormat . $player->getDisplayName());
//
//        $event->setFormatter(new LegacyRawChatFormatter(TextFormat::colorize(str_replace([
//            "{player}", "{msg}"
//        ], [$formattedName, $msg], $rankFormat))));
//    }


}