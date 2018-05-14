<?php

namespace ArrowTeleport\Commands;

use ArrowTeleport\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class ArrowTeleportCommand extends Command{

	public function __construct(){
		parent::__construct(
			"arrowteleport",
			"Give a special bow"
		);
	}

	/**
	 * TODO: Add price
	 *
	 * @param CommandSender $sender
	 * @param string $label
	 * @param array $args
	 * @return bool
	 */
	public function execute(CommandSender $sender, string $label, array $args) : bool{
		if($sender instanceof Player) {
			$config = Main::getAPI()->config->getAll();
			if(empty($args[0])) {
				Main::getAPI()->addSpecialBow($sender);
				$sender->sendMessage(Main::PREFIX.$config["added-your-inventory"]);
				$sender->sendMessage("§l§cNOTE: §r§7It bow works if you set projectile to Arrow on config.");
			}else{
				switch($args[0]){
					case "give":
						if($sender->isOp()) {
							if(empty($args[1])) {
								$sender->sendMessage(Main::PREFIX.$config["usage-message"]);
							}else{
								if(!$player = Server::getInstance()->getPlayer($args[1])) {
									$sender->sendMessage(Main::PREFIX.$config["player-not-found"]);
								}else{
									Main::getAPI()->addSpecialBow($player);
									$addedxinventory = str_replace("{player}", $player->getName(), $config["added-x-inventory"]);
									$xaddedyourinventory = str_replace("{sender}", $sender->getName(), $config["x-added-your-inventory"]);
									$sender->sendMessage(Main::PREFIX.$addedxinventory);
									$player->sendMessage(Main::PREFIX.$xaddedyourinventory);
								}
							}
						}else{
							$sender->sendMessage(Main::PREFIX.$config["you-must-be-op"]);
						}
						break;
				}
			}
		}

		return true;
	}

}
