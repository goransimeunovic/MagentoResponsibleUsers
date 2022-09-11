<?php
/**
 *
 * Goran_ResponsibleUsers Magento 2 extension
 *
 * NOTICE OF LICENSE
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @category Goran
 * @package Goran_ResponsibleUsers
 * @copyright Copyright (c) 2022 Goran
 * @license http://www.magento.com
 * @author Goran Simeunovic
 */
namespace Goran\ResponsibleUsers\Helper\Departments;

use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const DEPARTMENTS = 'departments/departments_list/department';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    private $storeManager;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serialize;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Serialize\Serializer\Json $serialize
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Serialize\Serializer\Json $serialize)
    {
        $this->storeManager = $storeManager;
        $this->serialize = $serialize;
        parent::__construct($context);
    }

    /**
     * Get store ID
     *
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreid()
    {
        return $this->storeManager->getStore()->getId();
    }


    /**
     * Get departments
     *
     * @return array|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDepartments()
    {
        $departmentsConfig = $this->scopeConfig->getValue(self::DEPARTMENTS,ScopeInterface::SCOPE_STORE,$this->getStoreid());

        if($departmentsConfig == '' || $departmentsConfig == null)
            return null;

        $unserializedata = $this->serialize->unserialize($departmentsConfig);

        $departmentsArray = array();
        foreach($unserializedata as $key => $row)
        {
            $departmentsArray[$key] = $row['department_name'];
        }

        return $departmentsArray;
    }
}
