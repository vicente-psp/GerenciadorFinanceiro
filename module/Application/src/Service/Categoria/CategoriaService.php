<?php

namespace Application\Service\Categoria;

use Application\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class CategoriaService extends AbstractService {

    public function __construct(EntityManager $em) {
        $this->entity = 'ERP\Entity\erp';
        parent::__construct($em);
    }

}
