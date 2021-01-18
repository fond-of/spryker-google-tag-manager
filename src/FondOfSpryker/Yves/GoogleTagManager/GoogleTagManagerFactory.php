<?php

namespace FondOfSpryker\Yves\GoogleTagManager;

use FondOfSpryker\Yves\GoogleTagManager\Twig\GoogleTagManagerTwigExtension;
use Spryker\Yves\Kernel\AbstractFactory;

class GoogleTagManagerFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManager\Twig\GoogleTagManagerTwigExtension
     */
    public function createGoogleTagManagerTwigExtension(): GoogleTagManagerTwigExtension
    {
        return new GoogleTagManagerTwigExtension();
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerDataLayerExpanderPluginInterface[];
     */
    public function getDataLayerExpanderPlugins(): array
    {
        return $this->getProvidedDependency(GoogleTagManagerDependencyProvider::DATALAYER_EXPANDER_PLUGINS);
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\TwigParameterBagExpanderPluginInterface[];
     */
    public function getTwigParameterBagExpanderPlugins(): array
    {
        return $this->getProvidedDependency(GoogleTagManagerDependencyProvider::TWIG_PARAMETER_BAG_EXPANDER_PLUGINS);
    }
}
