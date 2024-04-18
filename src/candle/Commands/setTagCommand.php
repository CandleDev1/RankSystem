<?php

namespace candle\Commands;

use candle\Loader;
use candle\Rank\tagids;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class setTagCommand extends Command
{
    public function __construct() {
        parent::__construct('settag');
        $this->setPermission('pocketmine.group.operator');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if($sender instanceof Player) {
            if(!$args[0]) {
                $sender->sendMessage('usagemessage');
                return;
            }
            if(!$args[1]) {
                $sender->sendMessage('usagemessage');
                return;
            }
            $player = Server::getInstance()->getPlayerExact($args[0]);
            $tagid = (int) $args[1];
            $tagids = [
                tagids::nothing,
                tagids::OG,
                tagids::Clown,
                tagids::WOMP,
                tagids::PRO,
                tagids::UWU,
                tagids::DMOD,
                tagids::DUMB,
                tagids::ICEBREAKER,
                tagids::FIRE,
                tagids::FAT
            ];
            if(!in_array($tagid, $tagids)) {
                $sender->sendMessage("Tag ID '" . $tagid . "' does not exist.");
                return;
            }

            Loader::getInstance()->database->setTagID($player->getName(), $args[1]);
            $player->sendMessage('Tag has been updated to: ' . (new tagids())->TagToString($args[1]));
            $player->sendTitle('Tag done');

        }
    }

}