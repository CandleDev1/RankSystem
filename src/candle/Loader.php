<?php

namespace candle;

use candle\Commands\setRankCommand;
use candle\Commands\setTagCommand;
use candle\Provider\Database;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase
{

    use SingletonTrait;

    public Database $database;
    public function onLoad(): void {
        self::$instance = $this;
    }

    public static function getInstance(): self {
        return self::$instance;
    }

    public function onEnable(): void
    {
       $this->saveDefaultConfig();
       $this->database = new Database();
       $this->getDatabase()->initDatabase();

       $this->getServer()->getCommandMap()->register('setRankCommand', new setRankCommand());
       $this->getServer()->getCommandMap()->register('setTagCommand', new setTagCommand());
       $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

    public function getDatabase(): Database {
        return $this->database;
    }

}