<?php
/**
 * @author idmultiship
 */

namespace TDS\TelegramBundle\Bot;

use Telegram\Bot\Api;
use Telegram\Bot\BotsManager as BaseBotsManager;
use Telegram\Bot\Commands\Command;

/**
 * Class BotsManager
 * @package TDS\TelegramBundle\Bot
 */
class BotsManager extends BaseBotsManager
{
    protected $commands;

    /**
     * @param Command $command
     * @param $bot
     */
    public function addCommand(Command $command, $bot)
    {
        $this->commands[$bot][$command->getName()] = $command;
    }

    /**
     * Make the bot instance.
     *
     * @param string $name
     *
     * @return Api
     */
    protected function makeBot($name)
    {
        $config = $this->getBotConfig($name);

        $token = array_get($config, 'token');

        $telegram = new Api(
            $token,
            $this->getConfig('async_requests', false),
            $this->getConfig('http_client_handler', null)
        );

        foreach ($this->getBotCommands($name) as $command) {
            $telegram->addCommand($command);
        }

        return $telegram;
    }

    /**
     * @param $botName
     * @return Command[]
     */
    public function getBotCommands($botName)
    {
        return array_key_exists($botName, $this->commands) ? $this->commands[$botName] : [];
    }

}