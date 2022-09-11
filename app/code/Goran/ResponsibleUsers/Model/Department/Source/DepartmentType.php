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

namespace Goran\ResponsibleUsers\Model\Department\Source;

use Goran\ResponsibleUsers\Helper\Departments\Data as HelperDepartments;

class DepartmentType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var HelperDepartments
     */
    private HelperDepartments $helperDepartments;

    /**
     * @param HelperDepartments $helperDepartment
     */
    public function __construct(
        HelperDepartments $helperDepartment
    ){
        $this->helperDepartments = $helperDepartment;
    }


    /**
     * Options for Department
     *
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function toOptionArray(): array
    {
        $availableDepartments = $this->helperDepartments->getDepartments();

        $options = [];

        foreach ($availableDepartments as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }

}
