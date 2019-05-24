<?php


namespace KnpU\LoremIpsumBundle\Tests;


use KnpU\LoremIpsumBundle\KnpULoremIpsumBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class KnpULoremIpsumBaseTestingKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }


    public function registerBundles()
    {
        return [
            new KnpULoremIpsumBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
        });
    }

    public function getCacheDir()
    {
        return parent::getCacheDir() . '/' . spl_object_hash($this);
    }


}