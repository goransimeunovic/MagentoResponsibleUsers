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

use Magento\Framework\App\ResponseInterface;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Goran_ResponsibleUsers::delete';

    /** @var \Goran\ResponsibleUsers\Api\UserRepositoryInterface */
    protected $repository;

    /**
     * Action constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Goran\ResponsibleUsers\Model\UserRepository $repository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Goran\ResponsibleUsers\Model\UserRepository $repository
    ) {
        $this->repository        = $repository;

        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $this->repository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('User was deleted successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('We cannot delete this user at the moment: %1', $e->getMessage()));
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        return $resultRedirect->setPath('*/*/index');
    }

}
