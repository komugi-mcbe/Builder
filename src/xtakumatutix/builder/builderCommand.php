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
            $config = $this->Main->config;
            if(!$config->exists($name)) {
                $sender->sendMessage("ビルダー権限がありません");
                return true;
            }else{
                switch ($args[0]){
                    case "gm":
                    switch ($args[1]){
                        case 1:
                        $sender->sendMessage("クリエ");
                        break;

                        case 0:
                        $sender->sendMessage("サバイバル");
                        break;
                    }
                }
            }
            if ($sender->isOp()) {
                switch ($args[0]){
                    case "set":
                    if(isset($args[1])){
                        if(!$config->exists($args[1])){
                            $sender->sendMessage($args[1]."さんをビルダー権限に設定しました");
                            $config->set($args[1]);
                            $config->save();
                        }else{
                            $sender->sendMessage($args[1]."さんは既にビルダー権限が付与されています");
                        }
                    }
                    case "remove":
                    if(isset($args[1])) {
                        if(!$config->exists($args[1])){
                            $sender->sendMessage($args[1]."さんをビルダー権限に設定されていません");
                        }else{
                            $sender->sendMessage($args[1]."さんからビルダー権限を剥奪しました");
                            $config->remove($args[1]);
                            $config->save();
                        }
                    }
                    case "list":
                    $array = [];
                    foreach ($config->getAll() as $key => $value) {
                        array_push($array, $key);
                    }
                    $sender->sendMessage("ビルダー権限は付与されているプレイヤーは以下の通りになります。\n".implode(", ", $array));
                }
            }else{
                $sender->sendMessage("あなたはOPではありません");
            }
            return true;
        }
    }
}