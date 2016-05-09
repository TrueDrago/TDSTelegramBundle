<?php

namespace TDS\TelegramBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TDS\TelegramBundle\DependencyInjection\CompilerPass\CommandCompilerPass;

class TDSTelegramBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CommandCompilerPass());
    }
}
