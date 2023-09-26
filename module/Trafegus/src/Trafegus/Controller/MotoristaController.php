<?php

namespace Trafegus\Controller;

use Application\Controller\EntityUsingController;
use Trafegus\Entity\Motorista;
use Trafegus\Form\MotoristaForm;
use Zend\Json\Json;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Exception;
class MotoristaController extends EntityUsingController
{
    /**
     *
     *
     */
    public function indexAction()
    {
    
       
        $em = $this->getEntityManager();
    
        $motoristas = $em->getRepository("Trafegus\Entity\Motorista")->findBy(array(), array('nome' => 'ASC'));
        return new ViewModel(array('motorista' => $motoristas));
    }
    public function editAction()
    {
        $motorista = null;
        if ($this->params('id') > 0) {
          
          $motorista = $this->getEntityManager()->getRepository('Trafegus\Entity\Motorista')->find($this->params('id'));
          $motorista->setId($this->params('id'));
        }else{
            $motorista = new Motorista;
           
        }
        $form = new MotoristaForm($this->getEntityManager());
        $form->setHydrator(new DoctrineEntity($this->getEntityManager(),'Trafegus\entity\Motorista'));
        $form->bind($motorista);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $motorista->setNome($data['nome']);
            $motorista->setRg($data['rg']);
            $motorista->setCpf($data['cpf']);
            $motorista->setTelefone($data['telefone']);

            $Veiculo = $this->getEntityManager()->getRepository('Trafegus\Entity\Veiculo')->find($data['veiculo']);
            $motorista->setIdVeiculo($Veiculo);
            //$form->setInputFilter($motorista->getInputFilter());
           // if ($form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($motorista);
            $em->flush();
            $this->flashMessenger()->addSuccessMessage('Motorista salvo com sucesso');
            return $this->redirect()->toRoute('motorista');
            //}else{
            //    $this->flashMessenger()->addSuccessMessage('formulário  invalido');

            //}
        }
        return new ViewModel(array(
            'motorista' => $motorista,
            'form' => $form,
        ));
    }
    public function addAction()
    {
        return $this->editAction();
    }
    public function deleteAction()
    {
        $motorista = $this->getEntityManager()->getRepository('Trafegus\Entity\Motorista')->find($this->params('id'));
        if ($motorista) {
            $em = $this->getEntityManager();
            $em->remove($motorista);
            $em->flush();
            $this->flashMessenger()->addSuccessMessage('motorista deletado com sucesso');
        }
        return $this->redirect()->toRoute('motorista');
    }
    public function getGridMotoristaAction()
    {
        $page = $this->params()->fromPost('page', 1);
        $rows = $this->params()->fromPost('rows', 50);
        $filterRules = json_decode($this->params()->fromPost('filterRules', '[]'));
        $em = $this->getEntityManager();
        $motoristas = $em->getRepository('Trafegus\Entity\Motorista')->findBy(array(), array('nome' => 'ASC'));
        $paginator = new Paginator(new ArrayAdapter($motoristas));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage($rows);
        if (0 == $paginator->getAdapter()->count()) {
            $grid["rows"] = array();
        } else {
            //monta a grid
            $grid = $this->getGridMotorista($paginator, $page, $rows);
        }
        $grid["total"] = $paginator->getAdapter()->count();
        return $this->getResponse()->setContent(Json::encode($grid));
    }
    public function getGridMotorista($paginator = null, $page = null, $rows = null)
    {
        $i = 0;
        $grid = null;
        if (!empty($paginator)) {
            foreach ($paginator as $valores) {
                $idMotorista= $valores->getId();
                $class = 'class_excluir_' .  $valores->getId();
                $grid["rows"][$i]['id'] = "#";
                $grid["rows"][$i]['nome'] = $valores->getNome();
                $grid["rows"][$i]['cpf'] = $valores->getCpf();
                $grid["rows"][$i]['rg'] = $valores->getRg();
                $grid["rows"][$i]['telefone'] = $valores->getTelefone();
              
                $grid["rows"][$i]['opcao'] = null;
              
                $grid["rows"][$i]['opcao'] .= '<span style="padding-left: 10px"><a title="Editar Cadastro" href="/public/motorista/edit/' . $id . '"><i class="btn btn-primary" style="color:white;cursor:pointer ">edit</i></a></span>';
                $grid["rows"][$i]['opcao'] .= '<span style="padding-left: 10px"><a title="deletar Cadastro" href="/public/motorista/delete/' . $id . '"><i  class="btn btn-danger" style="color:white;cursor:pointer ">del</i></a></span>';
                $i++;
            }
        }
        return $grid;
    }

}
