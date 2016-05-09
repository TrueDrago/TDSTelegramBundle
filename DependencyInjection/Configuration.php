<?php

namespace TDS\TelegramBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tds_telegram');

        $rootNode->children()
                 ->scalarNode('default')->isRequired()->end()
                 ->booleanNode('async_requests')->defaultTrue()->end()
                 ->scalarNode('http_client_handler')->defaultNull()->end()
                 ->arrayNode('bots')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('username')->isRequired()->end()
                            ->scalarNode('token')->isRequired()->end()
//                            ->arrayNode('commands')
//                                ->prototype('scalar')
//                                ->end()
//                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
