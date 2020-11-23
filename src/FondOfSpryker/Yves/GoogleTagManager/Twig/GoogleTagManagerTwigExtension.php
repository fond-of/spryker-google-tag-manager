<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Twig;

use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use SprykerShop\Yves\ShopApplication\Plugin\AbstractTwigExtensionPlugin;
use Twig\Environment;
use Twig_SimpleFunction;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManager\GoogleTagManagerFactory getFactory()
 * @method \FondOfSpryker\Yves\GoogleTagManager\GoogleTagManagerConfig getConfig()
 */
class GoogleTagManagerTwigExtension extends AbstractTwigExtensionPlugin
{
    public const FUNCTION_GOOGLE_TAG_MANAGER = 'googleTagManager';
    public const FUNCTION_DATA_LAYER = 'dataLayer';

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            $this->createGoogleTagManagerFunction(),
            $this->createDataLayerFunction(),
        ];
    }

    /**
     * @return \Twig_SimpleFunction
     */
    protected function createGoogleTagManagerFunction()
    {
        return new Twig_SimpleFunction(
            static::FUNCTION_GOOGLE_TAG_MANAGER,
            [$this, 'renderGoogleTagManager'],
            [
                'is_safe' => ['html'],
                'needs_environment' => true,
            ]
        );
    }

    /**
     * @return \Twig_SimpleFunction
     */
    protected function createDataLayerFunction()
    {
        return new Twig_SimpleFunction(
            static::FUNCTION_DATA_LAYER,
            [$this, 'renderDataLayer'],
            [
                'is_safe' => ['html'],
                'needs_environment' => true,
            ]
        );
    }

    /**
     * @param \Twig\Environment $twig
     * @param string $templateName
     *
     * @return string
     */
    public function renderGoogleTagManager(Environment $twig, $templateName): string
    {
        if (!$this->getConfig()->isEnabled() || !$this->getConfig()->getContainerID()) {
            return '';
        }

        return $twig->render($templateName, [
            'containerID' => $this->getConfig()->getContainerID(),
        ]);
    }

    /**
     * @param \Twig\Environment $twig
     * @param string $page
     * @param array $params
     *
     * @return string
     */
    public function renderDataLayer(Environment $twig, string $page, array $params): string
    {
        if (!$this->getConfig()->isEnabled() || !$this->getConfig()->getContainerID()) {
            return '';
        }

        $dataLayerVariables = $this->addDefaultVariables($page, $params);

        foreach ($this->getFactory()->getVariableBuilderPlugins() as $type => $variableBuilderPlugins) {
            if (strtolower($type) !== strtolower($page)) {
                continue;
            }

            foreach ($variableBuilderPlugins as $pageTypePlugins) {
                foreach ($pageTypePlugins as $plugin) {
                    $dataLayerVariables = array_merge(
                        $dataLayerVariables,
                        $plugin->addVariable($page, $params)
                    );
                }
            }
        }

        return $twig->render($this->getDataLayerTemplateName(), [
            'data' => $dataLayerVariables,
        ]);
    }

    /**
     * @param $page
     * @param array $params
     *
     * @return array
     */
    protected function addDefaultVariables($page, array $params = []): array
    {
        $dataLayerVariables = [];
        $defaultPlugins = $this->getFactory()->getDefaultVariableBuilderPlugin();

        foreach ($defaultPlugins as $plugin) {
            $dataLayerVariables[] = $plugin->addVariable($page, $params);
        }

        return array_merge([], ...$dataLayerVariables);
    }

    /**
     * @return string
     */
    protected function getDataLayerTemplateName(): string
    {
        return '@GoogleTagManager/partials/data-layer.twig';
    }
}
