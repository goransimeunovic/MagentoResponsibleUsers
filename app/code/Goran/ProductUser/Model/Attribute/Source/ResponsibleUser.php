<?php
/**
 *
 * Goran_ProductUser Magento 2 extension
 *
 * NOTICE OF LICENSE
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @category Goran
 * @package Goran_ProductUser
 * @copyright Copyright (c) 2022 Goran
 * @license http://www.magento.com
 * @author Goran Simeunovic
 */

namespace Goran\ProductUser\Model\Attribute\Source;

use Goran\ResponsibleUsers\Model\ResourceModel\User\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ResponsibleUser extends AbstractSource
{
    /**
     * @var CollectionFactory
     */
    private $collection;

    /**
     * @param CollectionFactory $userCollectionFactory
     */
    public function __construct(
        CollectionFactory $userCollectionFactory,
    ){
        $this->collection = $userCollectionFactory->create();
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        $items = $this->collection->getItems();

        /** @var \Goran\ResponsibleUsers\Model\User $user */

        if (!$this->_options) {
            foreach ($items as $user) {
                $this->_options[] = [
                    'value' => $user->getId(),
                    'label' => $user->getLastname() . ' ' . $user->getFirstname()
                ];
            }
        }

        return $this->_options;
    }

}
