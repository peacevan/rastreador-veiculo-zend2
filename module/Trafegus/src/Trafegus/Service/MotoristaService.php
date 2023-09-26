<?php

namespace Trafegus\Service;

use Doctrine\ORM\EntityManager;
use Zend\Hydrator;
use AbstractService;

class MotoristaService extends AbstractService {

     protected $entity;

    public function __construct($entityManager) {
        
        $this->entity =$entityManager;
    }

    public function inserir($data, $entity) {
        $retorno = false;
        try {
            $retorno = true;
            $this->em = $this->getEM();
            $entity = new $this->entity($data);
            $this->em->persist($entity);
            $this->em->flush();
        } catch (Exception $ex) {
            $this->em->getConnection()->rollback();
            $retorno = false;
        }
        return $retorno;
    }

    public function editar($data, $entity, $id) {
        $retorno = false;
        try {
            $retorno = true;
            $this->em = $this->getEM();
            $this->em->getConnection()->beginTransaction();
            $entity = $this->em->getReference($entity, $id); //referencia
            (new Hydrator\ClassMethods())->hydrate($data, $entity); //transforma data-request (array em objeto)
            $this->em->persist($entity);
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (\Exception $ex) {
            $this->em->getConnection()->rollback();
            $retorno = false;
        }
        return $retorno;
    }

    public function Deletar($parametro, $entity) {
        try {
            if (!empty($parametro)) {
                $em = $this->getEM();
                $retorno = true;
                $Ugr = $em->find($entity, $parametro);
                $em->remove($Ugr);
                $em->flush();
            }
        } catch (\Exception $ex) {
            $retorno = false;
        }
        return $retorno;
    }
     
   

}
