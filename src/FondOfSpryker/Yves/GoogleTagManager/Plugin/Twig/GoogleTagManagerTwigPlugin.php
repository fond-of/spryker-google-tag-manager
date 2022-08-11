<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Plugin\Twig;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig\Environment;
use Twig\TwigFunction;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManager\GoogleTagManagerFactory getFactory()
 */
class GoogleTagManagerTwigPlugin extends AbstractPlugin implements TwigPluginInterface
{
    protected const TWIG_FUNCTION_GOOGLE_TAG_MANAGER = 'googleTagManager';
    protected const TWIG_FUNCTION_DATA_LAYER = 'dataLayer';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Twig\Environment $twig
     * @param \Spryker\Service\Container\ContainerInterface $container
     *
     * @return \Twig\Environment
     */
    public function extend(Environment $twig, ContainerInterface $container): Environment
    {
        $twig = $this->addTwigFunctions($twig);

        return $twig;
    }

    /**
     * @param \Twig\Environment $twig
     *
     * @return \Twig\Environment
     */
    protected function addTwigFunctions(Environment $twig): Environment
    {
        $twig->addFunction($this->createTwigFunctionGoogleTagManager($twig));
        $twig->addFunction($this->createTwigFunctionDataLayer($twig));

        return $twig;
    }

    /**
     * @param \Twig\Environment $twig
     *
     * @return \Twig\TwigFunction
     */
    protected function createTwigFunctionGoogleTagManager(Environment $twig): TwigFunction
    {
        return new TwigFunction(
            static::TWIG_FUNCTION_GOOGLE_TAG_MANAGER,
            function (Environment $twig, string $templateName) {
                return $this
                    ->getFactory()
                    ->createGoogleTagManagerTwigExtension()->renderGoogleTagManager($twig, $templateName);
            },
            [
                'needs_environment' => true,
                'is_safe' => ['html'],
            ]
        );
    }

    /**
     * @param \Twig\Environment $twig
     *
     * @return \Twig\TwigFunction
     */
    protected function createTwigFunctionDataLayer(Environment $twig): TwigFunction
    {
        return new TwigFunction(
            static::TWIG_FUNCTION_DATA_LAYER,
            function (Environment $twig, string $page, array $params) {
                return $this
                    ->getFactory()
                    ->createGoogleTagManagerTwigExtension()->renderDataLayer($twig, $page, $params);
            },
            [
                'needs_environment' => true,
                'is_safe' => ['html'],
            ]
        );
    }
}
