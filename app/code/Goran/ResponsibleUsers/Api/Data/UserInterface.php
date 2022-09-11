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
namespace Goran\ResponsibleUsers\Api\Data;

interface UserInterface
{
    const USER_ID = 'user_id';
    const FIRSTNAME = 'firstname';
    const LASTNAME = 'lastname';
    const CREATED_AT = 'created_at';

    /**
     * Get id.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get user firstname.
     *
     * @return string|null
     */
    public function getFirstname();

    /**
     * Get user lastname.
     *
     * @return string|null
     */
    public function getLastname();

    /**
     * Set group ID.
     *
     * @param int $id
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface
     */
    public function setId($id);

    /**
     * Set group title.
     *
     * @param string $firstname
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface
     */
    public function setFirstname(string $firstname);

    /**
     * Set group title.
     *
     * @param string $lastname
     * @return \Goran\ResponsibleUsers\Api\Data\UserInterface
     */
    public function setLastname(string $lastname);

}
