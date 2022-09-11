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

namespace Goran\ProductUser\Model\Attribute\Backend;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class ResponsibleUser extends AbstractBackend
{
    /**
     * @param Product $object
     * @throws LocalizedException
     * @return bool
     */
    public function validate($object)
    {
        return parent::validate($object);
    }
}
