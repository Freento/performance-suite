<?php

declare(strict_types=1);

namespace Freento\PerformanceSuite\Controller\Adminhtml\ModuleList;

use Freento\PerformanceSuite\Api\ModulesInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Json;

class Get extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Freento_PerformanceSuite::fps_dashboard';

    /**
     * @param ModulesInterface $modules
     * @param Context $context
     */
    public function __construct(private readonly ModulesInterface $modules, Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * @return Json
     */
    public function execute(): Json
    {
        /**
         * @var Json $jsonResult
         */
        $jsonResult = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);

        $modules = $this->modules->getList();
        $data = [];
        foreach ($modules as $module) {
            $data[] = [
                'composer_name' => $module->getComposerName(),
                'installed_version' => $module->getCurrentVersion(),
                'available_version' => $module->getAvailableVersion(),
                'description' => $module->getShortDescription(),
                'link' => $module->getLink(),
            ];
        }
        $jsonResult->setData($data);
        return $jsonResult;
    }
}
