<?php

declare(strict_types=1);

namespace Freento\PerformanceSuite\Model;

use Freento\PerformanceSuite\Api\Data\ModuleInterface;
use Magento\Framework\Module\PackageInfo;

class Module implements ModuleInterface
{
    /**
     * @var string
     */
    private string $availableVersion;

    /**
     * @var string
     */
    private string $shortDescription;

    /**
     * @var string
     */
    private string $link;

    /**
     * @var string
     */
    private string $currentVersion;

    /**
     * @param PackageInfo $packageInfo
     * @param string $composerName
     */
    public function __construct(private readonly PackageInfo $packageInfo, private readonly string $composerName)
    {
    }

    /**
     * @inheritDoc
     */
    public function getComposerName(): string
    {
        return $this->composerName;
    }

    /**
     * @inheritDoc
     */
    public function getAvailableVersion(): string
    {
        return $this->availableVersion;
    }

    /**
     * @inheritDoc
     */
    public function setAvailableVersion(string $availableVersion): void
    {
        $this->availableVersion = $availableVersion;
    }

    /**
     * @inheritDoc
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @inheritDoc
     */
    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @inheritDoc
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @inheritDoc
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentVersion(): string
    {
        if (!empty($this->currentVersion)) {
            return $this->currentVersion;
        }

        $moduleName = $this->packageInfo->getModuleName($this->composerName);
        $version = $this->packageInfo->getVersion($moduleName);
        $this->currentVersion = $version;
        return $this->currentVersion;
    }
}
