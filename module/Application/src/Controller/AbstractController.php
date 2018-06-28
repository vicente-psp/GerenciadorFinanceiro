<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


/**
 * Description of AbstractController
 *
 * @author Vicente
 */
abstract class AbstractController extends AbstractActionController{
    
    protected $em;
    protected $entity;
    protected $controller;
    protected $route;
    protected $service;
    protected $form;
    
    abstract function __construct();
    
    /**
     * @return array|void
     */
    public function indexAction() {
        $list = $this->getEm()->getRepository($this->entity)->findAll();
        
        return new ViewModel(array('data' => $list));
    }
    
    public function inserirAction(){
        
    }
    
    public function editarAction(){
        
    }
    
    public function excluirAction(){
        
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm(){
        if($this->em == null){
            $this->em = $this->getEvent()->getApplication()->getServiceManager()->get(\Doctrine\ORM\EntityManager::class);
        }
        return $this->em;
    }
    
}
