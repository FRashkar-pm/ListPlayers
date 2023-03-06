<?php

/*
by AEDXDV

Youtube: @AEDXDEV
Discord: AEDXDEV#1622

*/
namespace ListPlayers;

use JaxkDev\DiscordBot\Plugin\Events\MessageSent;
use JaxkDev\DiscordBot\Plugin\Api;
use JaxkDev\DiscordBot\Plugin\Main;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\Server;

class ListPlayers extends PluginBase implements Listener{
  
    public function onEnable() : void{
        $this->getLogger()->info(TextFormat::GREEN . "Enabled ListPlayers");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onSendMsg(MessageSent $event){
        $discordbot = Server::getInstance()->getPluginManager()->getPlugin("DiscordBot");
        $api = $this->discordbot->getApi();
        $message = $event->getMessage();
        $content = $message->getContent();
        $channel_id = $message->getChannelId();
        $args = explode(" ", $content);
        // command
        if($args[0] == "!list"){
          $api->sendMessage(new \JaxkDev\DiscordBot\Models\Messages\Message($channel_id, null, "`" . count($this->getServer()->getOnlinePlayers()) . "`" . "\n" . "```" .  implode("\n", array_map(fn(Player $player) => $player->getName(), $this->getServer()->getOnlinePlayers()))  . "```"));
        }
    }
}
