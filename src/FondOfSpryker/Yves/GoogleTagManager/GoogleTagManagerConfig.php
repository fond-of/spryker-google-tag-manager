<?php

namespace FondOfSpryker\Yves\GoogleTagManager;

use FondOfSpryker\Shared\GoogleTagManager\GoogleTagManagerConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class GoogleTagManagerConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getContainerId(): string
    {
        return $this->get(GoogleTagManagerConstants::CONTAINER_ID, 'GTM-XXXXXX');
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->get(GoogleTagManagerConstants::ENABLED, false);
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->get(GoogleTagManagerConstants::PROTOCOL, 'http');
    }
}
