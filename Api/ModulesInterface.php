<?php

declare(strict_types=1);

namespace Freento\PerformanceSuite\Api;

use Freento\PerformanceSuite\Api\Data\ModuleInterface;

interface ModulesInterface
{
    /**
     * Retrieves modules list via REST API
     *
     * @return ModuleInterface[]
     */
    public function getList(): array;
}
