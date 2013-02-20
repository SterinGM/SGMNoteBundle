<?php

namespace SGM\NoteBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SGMNoteExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        if (!in_array(strtolower($config['db_driver']), array('orm'))) {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }

        $loader->load(sprintf('%s.xml', $config['db_driver']));
        $loader->load('config.xml');
        $loader->load('form.xml');

        $container->setParameter('sgm_note.note_class', $config['note_class']);

        $container->setParameter('sgm_note.new_note_form.name', $config['new_note_form']['name']);
        $container->setParameter('sgm_note.edit_note_form.name', $config['edit_note_form']['name']);

        $container->setAlias('sgm_note.note_manager', $config['note_manager']);

        $container->setAlias('sgm_note.provider', $config['provider']);
        $container->setAlias('sgm_note.user_provider', $config['user_provider']);
        $container->setAlias('sgm_note.csrf.note_provider', $config['csrf_note_provider']);
        $container->setAlias('sgm_note.authorizer', $config['authorizer']);

        $container->setAlias('sgm_note.new_note_form.type', $config['new_note_form']['type']);
        $container->setAlias('sgm_note.new_note_form.factory', $config['new_note_form']['factory']);
        $container->setAlias('sgm_note.new_note_form.handler', $config['new_note_form']['handler']);
        $container->setAlias('sgm_note.edit_note_form.type', $config['edit_note_form']['type']);
        $container->setAlias('sgm_note.edit_note_form.factory', $config['edit_note_form']['factory']);
        $container->setAlias('sgm_note.edit_note_form.handler', $config['edit_note_form']['handler']);
    }
}
