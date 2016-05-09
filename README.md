TDSTelegramBundle
==================

TDSTelegramBundle is just a service wrapper for [Telegram Bot API PHP SDK](https://telegram-bot-sdk.readme.io/)

**WARNING**
Not all features of the original SDK are supported (although the main features are working).
See the **TODOs** section for more info. 


Installation
------------

**Step 1: Download Bundle using composer**

Require the bundle with composer:

    $ composer require tds/telegram-bundle "dev-master"
    
Composer will install the bundle to your project's vendor directory.


**Step 2: Enable the bundle**

Enable the bundle in the kernel:


    <?php
    // app/AppKernel.php
    
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new TDS\TelegramBundle\TelegramBundle(),
            // ...
        );
    }

**Step 3: Configure your application's config.yml**


```yml
    tds_telegram:
        default: 'default'
        async_requests: false
        http_client_handler: ~
        bots:
            default:
                username: 'SampleBot'
                token: 'YOUR TOKEN HERE'
```        

**Step 4: Create your commands**

1. Create a command class, as shown at the [SDK documentation](https://telegram-bot-sdk.readme.io/docs/commands-system)
2. Make this command a symfony service at your services.yml:
```yml
    app.telegram_command.start_command:
        class: AppBundle\Telegram\Command\StartCommand
        tags:
          - { name: 'tds_telegram.command', bot: 'default' }
```

As you can notice 'bot' parameter is the same as bot, defined at main config's **bots** section. 
It tells the BotManager where it should inject this command, defined as a an ordinary symfony service.

**Step 5: Use the library**

Simple example of getting BotsManager service, fetching from it the desired bot and processing updates with commands:

```php
    $manager = $this->getContainer()->get('tds_telegram.bot.bots_manager');
    $bot = $manager->bot('default');
    while (1) {
        $upd = $bot->commandsHandler();
    }
```

**Step 6: Read the docs**

[Investigate the SDK documentation](https://telegram-bot-sdk.readme.io/)

TODOs
-----
This section here is a reminder of the current bundle's minimalistic composition. Feel free to contribute! 

1. Unit tests and CI
2. **http_client_handler** option is untested
3. **command_groups** and **shared_commands** options are not implemented
4. Think about late commands initialization
5. Think about builtin CLI command and controller
6. Better config docs

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

[LICENSE](https://github.com/TrueDrago/TDSTelegramBundle/blob/master/LICENSE)


