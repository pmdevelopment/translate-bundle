<?php

namespace PM\Bundle\TranslateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pm_translate');

        $rootNode
            ->children()
                ->arrayNode('language')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('from')->defaultValue('en')->end()
                        ->scalarNode('to')->defaultValue('de')->end()
                    ->end()
                ->end()
                ->scalarNode('api_key')->isRequired()->end()
            ->end();

        return $treeBuilder;
    }
}
