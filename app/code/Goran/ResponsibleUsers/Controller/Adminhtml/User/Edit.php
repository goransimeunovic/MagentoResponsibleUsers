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
namespace Goran\ResponsibleUsers\Controller\Adminhtml\User;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Goran_ResponsibleUsers::save';

    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;

    /** @var \Magento\Framework\Registry */
    protected $registry;

    /** @var \Goran\ResponsibleUsers\Api\UserRepositoryInterface */
    protected $repository;

    /**
     * Action constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param \Goran\ResponsibleUsers\Model\UserRepository $repository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Goran\ResponsibleUsers\Model\UserRepository $repository
    ) {
        $this->repository        = $repository;
        $this->registry          = $registry;
        $this->resultPageFactory = $resultPageFactory;

        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id    = $this->getRequest()->getParam('id');
        $model = $this->repository->create();

        if ($id) {
            $model = $this->repository->get($id);

            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This user no longer exists'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }

            $this->registry->register('current_user', $model);
        }

        $data = $this->_getSession()->getPageData(true);

        if (!empty($data)) {
            $model->addData($data);
        }

        $resultPage = $this->initAction();
        $resultPage->getConfig()->getTitle()->prepend(
            $model->getId() ? ('User  ID: ' . $model->getId()) : __('New User')
        );

        return $resultPage;
    }

    /**
     * Init page.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    private function initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu('Goran_ResponsibleUsers::responsible_users');
        $resultPage->addBreadcrumb(__('Edit User'), __('Edit User'));

        return $resultPage;
    }

}
