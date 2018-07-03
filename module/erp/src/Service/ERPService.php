<?php
namespace ERP\Service;

use Application\Service\AbstractService;
use Doctrine\ORM\EntityManager;
class ERPService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'ERP\Entity\erp';
        parent::__construct($em);
    }
}