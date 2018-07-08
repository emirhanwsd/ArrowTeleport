<?php

/**

This plugin created by EmirhanWSD

 */

namespace ArrowTeleport;

use ArrowTeleport\Commands\ArrowTeleportCommand;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\event\Listener;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
	public const PREFIX = "§cArrowTeleport §8» §f";

	/** @var Config */
	public $config;
	/** @var Main */
	private static $api;

	public $projectiles = [
		"Arrow",
		"Snowball",
		"Egg"
	];

	public function onLoad(){
		self::$api = $this;
	}

	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder()."messages.yml", Config::YAML, [
			"price-enable" => false,
			"price" => 1000,
			"player-not-found" => "§cPlayer not found.",
			"added-your-inventory" => "§aSpecial bow added your inventory.",
			"added-x-inventory" => "§aAdded special bow to §b{player}§a's inventory.",
			"x-added-your-inventory" => "§b{sender} §aadded special bow to your inventory.",
			"usage-message" => "§cUsage : §7/arrowteleport give <player-name>",
			"you-must-be-op" => "§cYou must be op for use this command.",
			"projectile" => "Arrow"
		]);
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getCommandMap()->register("arrowteleport", new ArrowTeleportCommand());
		$this->sendConsoleMessages();
	}

	public static function getAPI() : Main{
		return self::$api;
	}

	public function addSpecialBow(Player $player) {
		$item = Item::get(Item::BOW, 2, 1);
		$item->setCustomName("§r§cSpecial Teleport Bow");
		$enchantment = Enchantment::getEnchantment(0);
		$enchantment = new EnchantmentInstance($enchantment, 0);
		$item->addEnchantment($enchantment);
		$player->getInventory()->addItem($item);
	}

	public function isProjectile(string $projectile): bool {
		return in_array($projectile, $this->projectiles);
	}

	public function sendConsoleMessages() : void{
		$this->getLogger()->info("§bArrowTeleport §aenabled by EmirhanWSD");
		$this->getLogger()->notice("§cIf you set projectile on config to other projectile or other items name, this plugin will not work.");
	}

	public function onHit(ProjectileHitBlockEvent $e){
		$entity = $e->getEntity();
		$name = (new \ReflectionClass($entity))->getShortName();
		if($this->config->get("projectile") == $name){
			$player = $entity->getOwningEntity();
			if($player instanceof Player){
				$player->teleport($e->getBlockHit());
				$player->getLevel()->addSound(new EndermanTeleportSound($player));
			}
		}
	}

}