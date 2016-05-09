<?php

namespace TDS\TelegramBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class TDSTelegramExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('tds_telegram', $config);
//        $container->setParameter('tds_telegram.default', $config['default']);
//        $container->setParameter('tds_freekassa.async_requests', $config['async_requests']);
//        $container->setParameter('tds_freekassa.http_client_handler', $config['http_client_handler']);
//        $container->setParameter('tds_freekassa.bots', $config['bots']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
