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
namespace Goran\ResponsibleUsers\Block\Adminhtml\User\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        $userId = $this->getId();
        $data       = [];
        if ($userId) {
            $data = [
              'label' => __('Delete'),
              'class' => 'delete',
              'id' => 'user-edit-delete-button',
              'data_attribute' => [
                'url' => $this->getDeleteUrl()
              ],
              'on_click' => 'deleteConfirm(\'' . __(
                  'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
              'sort_order' => 10,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getId()]);
    }
}
