<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

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
        
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(10);
        
        return new ViewModel(array('data' => $paginator, 'page' => $page));
    }
    
    public function inserirAction(){
        if(is_string($this->form)){
            $form = new $this->form;
        }else{
            $form = $this->form;
        }
        $request = $this->getRequest();
        
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                $service = $this->getServiceLocator()->get($this->service);
                
                if($service->save($request->getPost()->toArray())){
                    $this->flashMessenger()->addSuccessMessage('Cadastrado com sucesso!');
                }else{
                    $this->flashMessenger()->addErrorMessage('Não foi possível cadastrar!');
                }
                
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        if($this->flashMessenger()->hasSuccessMessage()){
            return new ViewModel (array(
                'form' => $form,
                'success' => $this->flashMessenger()->getSuccessMessages()
            ));
        }
        if($this->flashMessenger()->hasErrorMessages()){
            return new ViewModel (array(
                'form' => $form,
                'success' => $this->flashMessenger()->getErrorMessages()
            ));
        }
        $this->flashMessenger()->clearMessages();
        
        return new ViewModel(array('form' => $form));
    }
    
    public function editarAction(){
        if(is_string($this->form)){
            $form = new $this->form;
        }else{
            $form = $this->form;
        }
        $request = $this->getRequest();
        $param = $this->params()->fromRoute('id', 0);
        
        $repository = $this->getEm()->getRepository($this->entity)->find($param);
        
        if($repository){
            $array = array();
            foreach ($repository->toArray() as $key => $value){
                if($value instanceof \DateTime){
                    $array[$key] = $value->format('Y-m-d');
                }else{
                    $array[$key] = $value;
                }
            }
            
            $form->setData($array);
            
            if($request->isPost()){
                $form->setData($request->getPost());
                if($form->isValid()){
                    $service = $this->getServiceLocator()->get($this->service);
                    $data = $request->getPost()->toArray();
                    $data['id'] = $param;
                    if($service->save($data)){
                        $this->flashMessenger()->addSuccessMessage('Atualizado com sucesso!');
                    }else{
                        $this->flashMessenger()->addErrorMessage('Não foi possível Atualizar!');
                    }

                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
                }
            }
        }else{
            $this->flashMessenger()->addInfoMessage('Registro não encontrado!');
            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
        }
        if($this->flashMessenger()->hasSuccessMessage()){
            return new ViewModel (array(
                'form' => $form,
                'success' => $this->flashMessenger()->getSuccessMessages(),
                'id' => $param
            ));
        }
        if($this->flashMessenger()->hasErrorMessages()){
            return new ViewModel (array(
                'form' => $form,
                'success' => $this->flashMessenger()->getErrorMessages(),
                'id' => $param
            ));
        }
        if($this->flashMessenger()->hasInfoMessages()){
            return new ViewModel (array(
                'form' => $form,
                'warning' => $this->flashMessenger()->getInfoMessages(),
                'id' => $param
            ));
        }
        $this->flashMessenger()->clearMessages();
        
        return new ViewModel(array('form' => $form, 'id' => $param));
    }
    
    public function excluirAction(){
        $service = $this->getServiceLocator()->get($this->service);
        $id = $this->params()->fromRoute('id', 0);
        
        if($service->remove(array('id' => $id))){
            $this->flashMessenger()->addSuccessMessage('Registro removido com sucesso!');
        }else{
            $this->flashMessenger()->addErrorMessage('Não foi possível remover o registro.!');
        }
        
        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
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
