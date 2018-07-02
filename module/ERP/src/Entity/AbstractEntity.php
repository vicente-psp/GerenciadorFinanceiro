<?php
namespace Application\Entity;

use Zend\Hydrator\ClassMethods;

/**
 * Description of AbstractEntity
 *
 * @author Vicente
 */
abstract class AbstractEntity {
    
    /**
     * @param array $options
     */
    public function __construct(Array $options = array()){
        $hydrator = new ClassMethods();
        $hydrator->extract($options ,$this);
    }
    
    /**
     * @return array
     */
    public function toArray(){
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }
}
