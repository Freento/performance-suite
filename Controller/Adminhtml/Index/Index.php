<?php

declare(strict_types=1);

namespace Freento\PerformanceSuite\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;

class Index extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Freento_PerformanceSuite::fps_dashboard';

    /**
     * All reports page
     *
     * @return Page
     */
    public function execute(): Page
    {
        /**
         * @var \Magento\Backend\Model\View\Result\Page $page
         */
        $page = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $page->setActiveMenu('Freento_PerformanceSuite::fps_dashboard');
        $page->getConfig()->getTitle()->prepend((string)__('Freento Performance Suite'));

        return $page;
    }
}
