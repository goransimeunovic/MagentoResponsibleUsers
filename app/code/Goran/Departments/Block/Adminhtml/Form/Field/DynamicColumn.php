<?php
/**
 *
 * Goran_Departments Magento 2 extension
 *
 * NOTICE OF LICENSE
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @category Goran
 * @package Goran_Departments
 * @copyright Copyright (c) 2022 Goran
 * @license http://www.magento.com
 * @author Goran Simeunovic
 */
namespace Goran\Departments\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class DynamicColumn extends Select
{
    /**
     * SetInputName function
     *
     * @param [type] $value
     * @return void
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * SetInputId function
     *
     * @param [type] $value
     * @return DynamicColumn
     */
    public function setInputId($value)
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    /**
     * GetSourceOptions function
     *
     * @return array
     */
    private function getSourceOptions()
    {
        return [
            ['label' => 'Yes', 'value' => '1'],
            ['label' => 'No', 'value' => '0'],
        ];
    }
}
