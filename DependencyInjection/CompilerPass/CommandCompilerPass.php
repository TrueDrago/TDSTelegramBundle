<?php
/**
 * @author idmultiship
 */

namespace TDS\TelegramBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CommandCompilerPass
 * @package TDS\FreekassaBundle\DependencyInjection\CompilerPass
 */
class CommandCompilerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('tds_telegram.bot.bots_manager')) {
            return;
        }

        $definition = $container->getDefinition(
            'tds_telegram.bot.bots_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'tds_telegram.command'
        );
        
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addCommand',
                    array(new Reference($id), $attributes["bot"])
                );
            }
        }
    }
}