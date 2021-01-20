<?php

namespace FondOfSpryker\Yves\GoogleTagManager;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerDependencyProvider extends AbstractBundleDependencyProvider
{
    public const DATALAYER_EXPANDER_PLUGINS = 'DATALAYER_EXPANDER_PLUGINS';
    public const TWIG_PARAMETER_BAG_EXPANDER_PLUGINS = 'TWIG_PARAMETER_BAG_EXPANDER_PLUGINS';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addDataLayerExpanderPlugins($container);
        $container = $this->addTwigParameterBagExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addDataLayerExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container->set(static::DATALAYER_EXPANDER_PLUGINS, static function () use ($self) {
            return $self->getDataLayerExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerDataLayerExpanderPluginInterface[];
     */
    protected function getDataLayerExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addTwigParameterBagExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container->set(static::TWIG_PARAMETER_BAG_EXPANDER_PLUGINS, static function () use ($self) {
            return $self->getTwigParameterBagExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerDataLayerExpanderPluginInterface[];
     */
    protected function getTwigParameterBagExpanderPlugins(): array
    {
        return [];
    }
}
