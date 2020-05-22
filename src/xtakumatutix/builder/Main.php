<?php

namespace xtakumatutix\builder;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\utils\Config;
use xtakumatutix\builder\builderCommand;

Class Main extends PluginBase
{
    public function onEnable() 
    {
        $this->getLogger()->notice("読み込み完了 - ver.".$this->getDescription()->getVersion());
        $this->getServer()->getCommandMap()->register("builder", new builderCommand($this));
        $this->config = new Config($this->getDataFolder() . "builder.yml", Config::YAML,);
    }
}