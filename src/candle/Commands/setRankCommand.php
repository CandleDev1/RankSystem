<?php

namespace candle\Commands;

use candle\Loader;
use candle\Rank\rankids;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class setRankCommand extends Command
{

    public function __construct() {
        parent::__construct('setrank');
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
            $rankID = (int) $args[1];
            $rankids = [
                rankids::PLAYER,
                rankids::ADMIN,
                rankids::OWNER
            ];
            if(!in_array($rankID, $rankids)) {
                $sender->sendMessage("Rank ID '" . $rankID . "' does not exist.");
                return;
            }

            Loader::getInstance()->database->setRankID($player->getName(), $args[1]);
            $player->sendMessage('Rank has been updated to: ' . (new rankids())->intToString($args[1]));
            $player->sendTitle('rank done');

        }
    }

}