<?php declare(strict_types=1);


namespace KnpU\LoremIpsumBundle\DependencyInjection;


use KnpU\LoremIpsumBundle\Service\WordProviderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
//use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class KnpULoremIpsumExtension extends Extension
{
    public const ALIAS = 'knpu_lorem_ipsum';

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/'));
        $loader->load('services.xml');

//        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/'));
//        $loader->load('services.yaml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('knpu_lorem_ipsum.service.knpu_ipsum');

        $definition->setArgument(1, $config['unicorns_are_real']);
        $definition->setArgument(2, $config['min_sunshine']);

        $container->registerForAutoconfiguration(WordProviderInterface::class)
            ->addTag('knpu_ipsum_word_provider');

    }

    public function getAlias()
    {
        return static::ALIAS;
    }
}
