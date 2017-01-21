<?php

/*
 * This file is part of the some package.
 * (c) Jakub Janata <jakubjanata@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

declare(strict_types = 1);

namespace Pehapkari\InlineEditableBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pehapkari_inline');

        $rootNode
            ->children()
                ->scalarNode('fallback')->defaultValue(false)->end()
                ->scalarNode('table_name')->defaultValue('inline_content')->end()
                ->scalarNode('url_path')->defaultValue('/inline')->end()
            ->end();

        return $treeBuilder;
    }
}
