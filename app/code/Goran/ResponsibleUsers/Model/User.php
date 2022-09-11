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

namespace Goran\ResponsibleUsers\Model;

use Goran\ResponsibleUsers\Api\Data\UserInterface;
use Magento\Framework\DataObject\IdentityInterface;

class User extends \Magento\Framework\Model\AbstractModel implements UserInterface, IdentityInterface
{
    const CACHE_TAG = 'goran_responsible_user_list';

    protected $_cacheTag = 'goran_responsible_user_list';

    protected $_eventPrefix = 'goran_responsible_user_list';

    /**
     * Slide constructor.
     *
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Goran\ResponsibleUsers\Model\ResourceModel\User');
    }


    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::USER_ID);
    }


    /**
     * @inheritDoc
     */
    public function getFirstname()
    {
        return $this->getData(self::FIRSTNAME);
    }

    /**
     * @inheritDoc
     */
    public function getLastname()
    {
        return $this->getData(self::LASTNAME);
    }


    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        return $this->setData(self::USER_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function setFirstname($firstname)
    {
        return $this->setData(self::FIRSTNAME, $firstname);
    }

    /**
     * @inheritDoc
     */
    public function setLastname($lastname)
    {
        return $this->setData(self::LASTNAME, $lastname);
    }


    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

}
