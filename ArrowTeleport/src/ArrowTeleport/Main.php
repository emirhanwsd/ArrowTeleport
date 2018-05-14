<?php

/**

  This plugin created by EmirhanWSD

*/

namespace ArrowTeleport;

use ArrowTeleport\EventListener;
use ArrowTeleport\Commands\ArrowTeleportCommand;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use pocketmine\Player;

use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;

class Main extends PluginBase {
	
	const AUTHOR = "EmirhanWSD";
	
	const VERSION = "1.0";
	
	const NAME = "ArrowTeleport";
	
	public const PREFIX = "§cArrowTeleport §8» §f";
	
	/** @var Config */
	
	public $config;
	
	/** @var Main */
	
	private static $api;
	
	public $projectiles = array(
	  "Arrow",
	  "Snowball",
	  "Egg"
		
	);
	
	public function onLoad() {
		self::$api = $this;
		
	}
	
	public function onEnable() {
		@mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder()."messages.yml", Config::YAML, [
		  "price-enable" => false,
		  "price" => 1000,
		  "player-not-found" => "§cPlayer not found.",
		  "added-your-inventory" => "§aSpecial bow added your inventory.",
		  "added-x-inventory" => "§aAdded special bow to §b{player}§a's inventory.",
		  "x-added-your-inventory" => "§b{sender} §aadded special bow to your inventory.",
		  "usage-message" => "§cUsage : §7/arrowteleport give <player-name>",
		  "you-must-be-op" => "§cYou must be op for use this command."
		
		]);
		$this->saveResource("messages.yml");
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		$this->getServer()->getCommandMap()->register("arrowteleport", new ArrowTeleportCommand());
		
	}
	
	/** @return Main */
	
	public static function getAPI(): Main {
		return self::$api;
		
	}
	
	/** @var Player $player */
	
	public function addSpecialBow(Player $player) {
		$item = Item::get(261, 2, 1);
		$item->setCustomName("§r§cSpecial Teleport Bow");
		$enchantment = Enchantment::getEnchantment(0);
		$enchantment = new EnchantmentInstance($enchantment, 0);
		$item->addEnchantment($enchantment);
		$player->getInventory()->addItem($item);
		
	}
	
	/**
	* @var string $projectile
	* @return bool
	*/
	
	public function isProjectile(string $projectile): bool {
		if(in_array($projectile, $this->projectiles)) {
			return true;
			
		}else{
			return false;
		
		}
	
	}
	
}
