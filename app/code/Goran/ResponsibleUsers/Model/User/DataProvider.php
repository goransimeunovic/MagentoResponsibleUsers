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

namespace Goran\ResponsibleUsers\Model\User;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /** @var array */
    private $loadedData;

    /**
     * @param \Goran\ResponsibleUsers\Model\ResourceModel\User\CollectionFactory $userCollectionFactory
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        \Goran\ResponsibleUsers\Model\ResourceModel\User\CollectionFactory $userCollectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ){
        $this->collection = $userCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var \Goran\ResponsibleUsers\Model\User $user */
        foreach ($items as $user) {
            $this->loadedData[$user->getId()] = $user->getData();
        }

        return $this->loadedData;
    }

}
