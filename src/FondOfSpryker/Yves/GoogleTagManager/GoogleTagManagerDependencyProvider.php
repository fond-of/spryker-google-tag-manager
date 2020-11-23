<?php

namespace FondOfSpryker\Yves\GoogleTagManager;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class GoogleTagManagerDependencyProvider extends AbstractBundleDependencyProvider
{
    public const VARIABLE_BUILDER_PLUGINS = 'VARIABLE_BUILDER_PLUGINS';
    public const DEFAULT_VARIABLE_PLUGINS = 'EXTENSION_DEFAULT_PLUGINS';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addGoogleTagManagerVariableBuilderPlugins($container);
        $container = $this->addDefaultGoogleTagManagerExtensionPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addDefaultGoogleTagManagerExtensionPlugins(Container $container): Container
    {
        $container->set(static::DEFAULT_VARIABLE_PLUGINS, function () {
            return $this->getDefaultGoogleTagManagerExtensionPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addGoogleTagManagerVariableBuilderPlugins(Container $container): Container
    {
        $container->set(static::VARIABLE_BUILDER_PLUGINS, function () {
            return $this->getGoogleTagManagerVariableBuilderPlugins();
        });

        return $container;
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[][][];
     */
    protected function getGoogleTagManagerVariableBuilderPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[];
     */
    protected function getGoogleTagManagerCategoryVariableBuilderPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[];
     */
    protected function getGoogleTagManagerProductCategoryVariableBuilderPlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Yves\GoogleTagManagerExtension\Dependency\GoogleTagManagerVariableBuilderPluginInterface[];
     */
    protected function getDefaultGoogleTagManagerExtensionPlugins(): array
    {
        return [];
    }
}
