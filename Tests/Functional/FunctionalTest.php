<?php

namespace KnpU\LoremIpsumBundle\Tests\Functional;

use KnpU\LoremIpsumBundle\Service\KnpUIpsum;
use KnpU\LoremIpsumBundle\Service\WordProviderInterface;
use KnpU\LoremIpsumBundle\Tests\KnpULoremIpsumBaseTestingKernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new KnpULoremIpsumTestingKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $ipsum = $container->get('knpu_lorem_ipsum.service.knpu_ipsum');
        $this->assertInstanceOf(KnpUIpsum::class, $ipsum);
        $this->assertInternalType('string', $ipsum->getParagraphs());
    }

    public function testServiceWiringWithRegisterOneMoreWordProvider()
    {
        $kernel = new KnpULoremIpsumTestingKernel();
        $kernel->boot();
        $container = $kernel->getContainer();
        $ipsum = $container->get('knpu_lorem_ipsum.service.knpu_ipsum');

        foreach ($ipsum->getWordProviders() as $wordProvider)
        {
            $this->assertInstanceOf(WordProviderInterface::class, $wordProvider);
        }

        $this->assertSame(2, count($ipsum->getWordProviders()));
    }
}

class KnpULoremIpsumTestingKernel extends KnpULoremIpsumBaseTestingKernel
{
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function(ContainerBuilder $container) {
            $container->register('stub_word_list', StubWordList::class)
                ->addTag('knpu_ipsum_word_provider');
        });
    }
}

class StubWordList implements WordProviderInterface {

    public function getWordList(): array
    {
        return ['stub', 'stub2'];
    }
}