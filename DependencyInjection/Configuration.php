<?php

namespace SGM\NoteBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('sgm_note');

        $rootNode
            ->children()
                ->scalarNode('db_driver')->cannotBeOverwritten()->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('note_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('note_manager')->defaultValue('sgm_note.note_manager.default')->cannotBeEmpty()->end()
                ->scalarNode('provider')->defaultValue('sgm_note.provider.default')->cannotBeEmpty()->end()
                ->scalarNode('user_provider')->defaultValue('sgm_note.user_provider.default')->cannotBeEmpty()->end()
                ->scalarNode('csrf_note_provider')->defaultValue('sgm_note.csrf.note_provider.default')->cannotBeEmpty()->end()
                ->scalarNode('authorizer')->defaultValue('sgm_note.authorizer.default')->cannotBeEmpty()->end()
                ->arrayNode('new_note_form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('factory')->defaultValue('sgm_note.new_note_form.factory.default')->cannotBeEmpty()->end()
                        ->scalarNode('type')->defaultValue('sgm_note.new_note_form.type.default')->cannotBeEmpty()->end()
                        ->scalarNode('handler')->defaultValue('sgm_note.new_note_form.handler.default')->cannotBeEmpty()->end()
                        ->scalarNode('name')->defaultValue('note')->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('edit_note_form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('factory')->defaultValue('sgm_note.edit_note_form.factory.default')->cannotBeEmpty()->end()
                        ->scalarNode('type')->defaultValue('sgm_note.edit_note_form.type.default')->cannotBeEmpty()->end()
                        ->scalarNode('handler')->defaultValue('sgm_note.edit_note_form.handler.default')->cannotBeEmpty()->end()
                        ->scalarNode('name')->defaultValue('note')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
