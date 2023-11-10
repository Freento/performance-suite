<?php

declare(strict_types=1);

namespace Freento\PerformanceSuite\Model\Api;

use Freento\PerformanceSuite\Api\Data\ModuleInterfaceFactory;
use Freento\PerformanceSuite\Api\ModulesInterface;
use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\Serialize\Serializer\Json;

class Modules implements ModulesInterface
{
    private const URL = 'https://freento.com/rest/V1/performance-suite/modules';

    /**
     * @var CurlFactory
     */
    private CurlFactory $curlFactory;

    /**
     * @var Json
     */
    private Json $json;

    /**
     * @var ModuleInterfaceFactory
     */
    private ModuleInterfaceFactory $moduleInterfaceFactory;

    /**
     * @param CurlFactory $curlFactory
     * @param Json $json
     * @param ModuleInterfaceFactory $moduleInterfaceFactory
     */
    public function __construct(CurlFactory $curlFactory, Json $json, ModuleInterfaceFactory $moduleInterfaceFactory)
    {
        $this->curlFactory = $curlFactory;
        $this->json = $json;
        $this->moduleInterfaceFactory = $moduleInterfaceFactory;
    }

    /**
     * @inheritDoc
     */
    public function getList(): array
    {
        $curl = $this->curlFactory->create();
        $curl->get($this::URL);
        $modulesInfo = $this->json->unserialize($curl->getBody());
        if (!is_array($modulesInfo)) {
            return [];
        }

        $modulesList = [];
        foreach ($modulesInfo as $module) {
            $composerName = $module['composer_name'] ?? '';
            if (!$composerName) {
                continue;
            }

            $moduleObject = $this->moduleInterfaceFactory->create(['composerName' => $composerName]);
            $moduleObject->setAvailableVersion($module['available_version'] ?? '');
            $moduleObject->setShortDescription($module['short_description'] ?? '');
            $moduleObject->setLink($module['link'] ?? '');
            $modulesList[] = $moduleObject;
        }

        return $modulesList;
    }
}
