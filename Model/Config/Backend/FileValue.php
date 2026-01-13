<?php

declare(strict_types=1);

namespace Freento\PerformanceSuite\Model\Config\Backend;

use Freento\PerformanceSuite\Model\Config\File;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Value;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

/**
 * Class FileValue
 * Doesn't support scopes - so this type suitable only for global scope values
 * @namespace Freento\PerformanceSuite\Model\Config\Backend
 */
class FileValue extends Value
{
    /**
     * @param File $fileConfig
     * @param Context $context
     * @param Registry $registry
     * @param ScopeConfigInterface $config
     * @param TypeListInterface $cacheTypeList
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param mixed[] $data
     */
    public function __construct(
        private readonly File $fileConfig,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * @return FileValue
     * @throws FileSystemException
     */
    public function beforeSave(): FileValue
    {
        $value = $this->getValue();
        $this->fileConfig->setData($this->getPath(), $value);
        return parent::beforeSave();
    }

    /**
     * @return bool
     * @throws FileSystemException
     */
    public function isValueChanged(): bool
    {
        return $this->getValue() !== $this->fileConfig->getData($this->getPath());
    }

    /**
     * @return FileValue
     * @throws FileSystemException
     */
    public function afterLoad(): FileValue
    {
        $this->setValue($this->fileConfig->getData($this->getPath()));
        return parent::afterLoad();
    }
}
