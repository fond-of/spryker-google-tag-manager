<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Plugin;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig_Environment;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManager\Twig\GoogleTagManagerFactory getFactory()
 */
class GoogleTagManagerTwigServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function register(Application $app)
    {
        $googleTagManagerTwigExtension = $this
            ->getFactory()
            ->createGoogleTagManagerCoreTwigExtension();

        $app['twig'] = $app->share(
            $app->extend(
                'twig',
                function (Twig_Environment $twig) use ($googleTagManagerTwigExtension, $app) {
                    $twig->addExtension($googleTagManagerTwigExtension);

                    return $twig;
                }
            )
        );
    }

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function boot(Application $app)
    {
    }
}
