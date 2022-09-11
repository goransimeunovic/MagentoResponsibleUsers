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

namespace Goran\ResponsibleUsers\Model\ResourceModel\ResponsibleUser;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    /**
     * @var ContextInterface
     */
    private $context;

    public function __construct(
        ContextInterface $context,
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable,
        $resourceModel,
        $identifierName,
        $connectionName
    ){
        $this->context = $context;
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel,
            $identifierName,
            $connectionName
        );
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        $user_id = $this->context->getRequestParam("id");

        $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
        fwrite($myfile, print_r($user_id,true));
        fclose($myfile);

        if ($user_id) {
            $this->addFieldToFilter("responsible_user", $user_id);
        }
        return $this;
    }
}
