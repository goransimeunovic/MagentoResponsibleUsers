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

class Save extends \Magento\Backend\App\Action
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
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Goran\ResponsibleUsers\Model\User $model */
            $model = $this->repository->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model = $this->repository->get($id);
            }

            if (empty($data['id'])) {
                unset($data['id']);
            }

            try {
                $this->repository->save($model);

                $this->messageManager->addSuccessMessage(__('The user is now saved'));
                $this->_objectManager->create('Magento\Backend\Model\Session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit',
                      ['id' => $model->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->_objectManager->create('Magento\Backend\Model\Session')->setFormData($data);
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->_objectManager->create('Magento\Backend\Model\Session')->setFormData($data);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, 'Something went wrong while saving the user. ' . $e->getMessage());
            }
        }

        return $resultRedirect->setPath('*/*/edit',
          ['id' => $this->getRequest()->getParam('id')]);
    }

}
