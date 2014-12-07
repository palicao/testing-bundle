<?php

namespace Cosma\Bundle\TestingBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cosma_testing');

        $rootNode
        ->children()
            ->scalarNode('fixture_path')->defaultValue('Fixture')->end()
            ->scalarNode('entity_namespace')->defaultValue('Entity')->end()
        ->end()
        ;

        return $treeBuilder;
    }
}
