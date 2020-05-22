<?php

// アイコン:http://flat-icon-design.com/?p=400

namespace xtakumatutix\builder;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use bbo51dog\pmdiscord\Sender;
use bbo51dog\pmdiscord\element\Content;

Class builderCommand extends Command 
{
    private $Main;

    public function __construct(Main $Main)
    {
        $this->Main = $Main;
        parent::__construct("builder", "ビルダー権限です", "/builder");
        $this->setPermission("builder.command.builder");
        $this->setDescription("ビルダー権限です");
        $this->setUsage("/post <Action>");
    }

	public function execute(CommandSender $sender, string $commandLabel, array $args): bool
	{
		if ($sender instanceof Player)
		{
            $name = $sender->getName();
            if($this->Main->config->get($name) == null){
                $sender->sendMessage("ビルダー権限がありません");
                return true;
            }else{
                switch ($args[0]){
                    case "gm":
                    switch ($args[1]){
                        case 1:
                        $sender->sendMessage("クリエ");
                        return true;

                        case 0:
                        $sender->sendMessage("サバイバル");
                        return true;
                    }
                }
            }
            if ($sender->isOp()) {
                switch ($args[0]){
                    case "set":
                    if(isset($args[1])){
                        $sender->sendMessage($args[1]."さんをビルダー権限に設定しました");
                        $this->Main->config->set($args[1]);
                        $this->Main->config->save();
                        return true;
                    }
                }
            }else{
                $sender->sendMessage("あなたはOPではありません");
                return true;
            }
        }
    }
}