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

namespace Goran\ResponsibleUsers\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class UserRepository implements \Goran\ResponsibleUsers\Api\UserRepositoryInterface
{

    /** @var GroupFactory */
    protected $userFactory;

    /** @var ResourceModel\User */
    protected $userResourceModel;

    /** @var ResourceModel\User */
    protected $userCollectionFactory;

    /**
     * Repository constructor.
     *
     * @param \Goran\ResponsibleUsers\Model\UserFactory $userFactory
     * @param \Goran\ResponsibleUsers\Model\ResourceModel\User $userResourceModel
     * @param \Goran\ResponsibleUsers\Model\ResourceModel\User\CollectionFactory $userCollectionFactory
     */
    public function __construct(
        \Goran\ResponsibleUsers\Model\UserFactory $userFactory,
        \Goran\ResponsibleUsers\Model\ResourceModel\User $userResourceModel,
        \Goran\ResponsibleUsers\Model\ResourceModel\User\CollectionFactory $userCollectionFactory
    ) {
        $this->userFactory           = $userFactory;
        $this->userCollectionFactory = $userCollectionFactory;
        $this->userResourceModel     = $userResourceModel;
    }

    /**
     * Prepare new user model
     *
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function create()
    {
        return $this->userFactory->create();
    }

    /**
     * Save user entity
     *
     * @param \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Goran\ResponsibleUsers\Api\Data\UserInterface $user)
    {
        try {
            $this->userResourceModel->save($user);

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $user;
    }

    /**
     * Delete user by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id)
    {
        return $this->delete($this->get($id));
    }

    /**
     * Delete user entity.
     *
     * @param \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Goran\ResponsibleUsers\Api\Data\UserInterface $user)
    {
        try {
            $this->userResourceModel->delete($user);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Get user by ID.
     *
     * @param int $id
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @throws \Magento\Framework\Exception\NoSuchEntityException If $logId is not found
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id)
    {
        $user = $this->userFactory->create();
        $this->userResourceModel->load($user, $id);
        if (!$user->getId()) {
            throw new NoSuchEntityException(__('User with id "%1" does not exist.', $id));
        }

        return $user;
    }

    /**
     * Retrieve users.
     *
     * @return \Goran\ResponsibleUsers\Model\ResourceModel\User\Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList()
    {
        return $this->userCollectionFactory->create();
    }
}
