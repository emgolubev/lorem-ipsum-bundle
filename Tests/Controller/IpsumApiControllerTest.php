<?php


namespace KnpU\LoremIpsumBundle\Tests\Controller;


use KnpU\LoremIpsumBundle\KnpULoremIpsumBundle;
use KnpU\LoremIpsumBundle\Tests\KnpULoremIpsumBaseTestingKernel;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\RouteCollectionBuilder;

class IpsumApiControllerTest extends TestCase
{
    public function testIndex()
    {
        $kernel = new KnpULoremIpsumControllerKernel();
        $client = new Client($kernel);
        $client->request('GET', '/api/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}

class KnpULoremIpsumControllerKernel extends KnpULoremIpsumBaseTestingKernel
{
    use MicroKernelTrait;

    public function registerBundles()
    {
        return [
            new KnpULoremIpsumBundle(),
            new FrameworkBundle(),
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->import(__DIR__.'/../../Resources/config/routes.xml', '/api');
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {

        $c->loadFromExtension('framework', [
            'secret' => '!qwerty12'
        ]);
    }


}