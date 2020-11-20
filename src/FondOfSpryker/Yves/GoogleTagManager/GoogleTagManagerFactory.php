<?php

namespace FondOfSpryker\Yves\GoogleTagManager;

use FondOfSpryker\Yves\GoogleTagManager\Twig\GoogleTagManagerTwigExtension;
use Spryker\Yves\Kernel\AbstractFactory;

class GoogleTagManagerFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Yves\GoogleTagManager\Twig\GoogleTagManagerTwigExtension
     */
    public function createGoogleTagManagerTwigExtension()
    {
        return new GoogleTagManagerTwigExtension();
    }

    /**
     * @return GoogleTagManagerVariableBuilderPlugin[][][]
     */
    public function getVariableBuilderPlugins(): array
    {
        return $this->getProvidedDependency(GoogleTagManagerDependencyProvider::VARIABLE_BUILDER_PLUGINS);
    }

    /**
     * @return GoogleTagManagerVariableBuilderPlugin[]
     */
    public function getDefaultVariableBuilderPlugin(): array
    {
        return $this->getProvidedDependency(GoogleTagManagerDependencyProvider::DEFAULT_VARIABLE_PLUGINS);
    }
}
