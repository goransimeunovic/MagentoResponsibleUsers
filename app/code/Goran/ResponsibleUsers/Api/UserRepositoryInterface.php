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
namespace Goran\ResponsibleUsers\Api;

interface UserRepositoryInterface
{
    /**
     * Prepare new user model
     *
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function create();

    /**
     * Save user entity
     *
     * @param \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Goran\ResponsibleUsers\Api\Data\UserInterface $user);

    /**
     * Delete user by ID.
     *
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);

    /**
     * Delete user entity.
     *
     * @param \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Goran\ResponsibleUsers\Api\Data\UserInterface $user);

    /**
     * Get user by ID.
     *
     * @param int $id
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface $user
     * @throws \Magento\Framework\Exception\NoSuchEntityException If $logId is not found
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id);

    /**
     * Retrieve groups.
     *
     * @return \Goran\ResponsibleUsers\Model\ResourceModel\User\Collection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList();

}
