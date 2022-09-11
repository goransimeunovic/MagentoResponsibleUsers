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

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Ranges
 */
class Departments extends AbstractFieldArray
{
    /**
     * @var Templete
     */
    private $templeteRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('department_name', ['label' => __('Department Name'), 'class' => 'required-entry']);
        $this->addColumn('is_external', [
            'label' => __('Is External'),
            'renderer' => $this->getTempleteRenderer()
        ]);

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }


    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $templete = $row->getTemplete();
        if ($templete !== null) {
            $options['option_' . $this->getTempleteRenderer()->calcOptionHash($templete)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

    /**
     *
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws LocalizedException
     */
    private function getTempleteRenderer()
    {
        if (!$this->templeteRenderer) {
            $this->templeteRenderer = $this->getLayout()->createBlock(
                DynamicColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->templeteRenderer;
    }
}
