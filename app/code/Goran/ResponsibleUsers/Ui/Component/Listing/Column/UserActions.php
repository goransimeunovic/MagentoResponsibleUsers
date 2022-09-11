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
namespace Goran\ResponsibleUsers\Ui\Component\Listing\Column;

class UserActions extends \Magento\Ui\Component\Listing\Columns\Column
{

    const URL_PATH_EDIT = 'responsibleusers/user/edit';
    const URL_PATH_DELETE = 'responsibleusers/user/delete';

    /** @var \Magento\Framework\UrlInterface */
    protected $urlBuilder;

    /** @var string */
    private $editUrl;

    /**
     * PostActions constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::URL_PATH_EDIT
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl    = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['user_id'])) {
                    $item[$name]['edit']   = [
                        'href'  => $this->urlBuilder->getUrl($this->editUrl, ['id' => $item['user_id']]),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href'    => $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['id' => $item['user_id']]),
                        'label'   => __('Delete'),
                        'confirm' => [
                            'title'   => __('Delete user "${$.$data.firstname}" "${$.$data.lastname}"'),
                            'message' => __('Are you sure you wan\'t to delete user "${$.$data.firstname}" "${$.$data.lastname}"?')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
