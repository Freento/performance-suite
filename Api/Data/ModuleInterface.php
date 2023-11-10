<?php

declare(strict_types=1);

namespace Freento\PerformanceSuite\Api\Data;

interface ModuleInterface
{
    /**
     * Returns the name of composer package containing this module
     *
     * @return string
     */
    public function getComposerName(): string;

    /**
     * Returns the latest available version
     *
     * @return string
     */
    public function getAvailableVersion(): string;

    /**
     * Setss the latest available version
     *
     * @param string $availableVersion
     * @return void
     */
    public function setAvailableVersion(string $availableVersion): void;

    /**
     * Returns short description
     *
     * @return string
     */
    public function getShortDescription(): string;

    /**
     * Sets short description
     *
     * @param string $shortDescription
     * @return void
     */
    public function setShortDescription(string $shortDescription): void;

    /**
     * Returns link
     *
     * @return string
     */
    public function getLink(): string;

    /**
     * Sets link
     *
     * @param string $link
     * @return void
     */
    public function setLink(string $link): void;

    /**
     * Returns version of installed composer package
     *
     * @return string
     */
    public function getCurrentVersion(): string;
}
