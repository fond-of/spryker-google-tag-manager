<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Twig;

use Generated\Shared\Transfer\GoogleTagManagerTransfer;
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
     * @param Environment $twig
     * @param string $page
     * @param array $twigVariableBag
     * @return string
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function renderDataLayer(Environment $twig, string $page, array $twigVariableBag): string
    {
        if (!$this->getConfig()->isEnabled() || !$this->getConfig()->getContainerID()) {
            return '';
        }

        $dataLayerVariables = [];

        foreach ($this->getFactory()->getTwigParameterBagExpanderPlugins() as $twigVariableBagExpanderPlugin) {
            if ($twigVariableBagExpanderPlugin->isApplicable($twigVariableBag)) {
                $twigVariableBag = $twigVariableBagExpanderPlugin->expand($twigVariableBag);
            }
        }

        foreach ($this->getFactory()->getDataLayerExpanderPlugins() as $type => $dataLayerExpanderPlugin) {
            if ($dataLayerExpanderPlugin->isApplicable($page, $twigVariableBag) === true) {
                $dataLayerVariables = $dataLayerExpanderPlugin->expand($page, $twigVariableBag, $dataLayerVariables);
            }
        }

        return $twig->render($this->getDataLayerTemplateName(), [
            'data' => $dataLayerVariables,
        ]);
    }

    /**
     * @return string
     */
    protected function getDataLayerTemplateName(): string
    {
        return '@GoogleTagManager/partials/data-layer.twig';
    }
}
