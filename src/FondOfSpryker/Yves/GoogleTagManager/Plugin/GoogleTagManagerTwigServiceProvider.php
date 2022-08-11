<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Plugin;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig_Environment;

/**
 * @deprecated Use {@link \FondOfSpryker\Yves\GoogleTagManager\Plugin\Twig\GoogleTagManagerTwigPlugin} instead.
 * @method \FondOfSpryker\Yves\GoogleTagManager\GoogleTagManagerFactory getFactory()
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
            ->createGoogleTagManagerTwigExtension();

        $app['twig'] = $app->extend(
            'twig',
            function (Twig_Environment $twig) use ($googleTagManagerTwigExtension) {
                $twig->addExtension($googleTagManagerTwigExtension);

                return $twig;
            }
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
