<?php


namespace Trafegus\Controller;

use Application\Controller\EntityUsingController;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;
use Trafegus\entity\Veiculo;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Trafegus\Form\VeiculoForm;

class VeiculoController extends EntityUsingController
{
    /**
    * Index action
    *
    */
    public function indexAction()
    {
        $em = $this->getEntityManager();
        
        //refatorar chmando  o VeiculoService
        $veiculo = $em->getRepository('Trafegus\entity\Veiculo')->findBy(array(), array('placa' => 'ASC'));
        return new ViewModel(array('veiculo' => $veiculo));
    }

    /**
    * Edit action
    *
    */
    public function editAction()
    {
        $veiculo =null; 

        if ($this->params('id') > 0) {
           
           
            $veiculo = $this->getEntityManager()->getRepository('Trafegus\entity\Veiculo')->find($this->params('id'));
            $veiculo->setId($this->params('id'));
        }else{
            $veiculo = new Veiculo;
          
        }
       
        $form = new VeiculoForm($this->getEntityManager());
        $form->setHydrator(new DoctrineEntity($this->getEntityManager(),'Trafegus\entity\Veiculo'));
        $form->bind($veiculo);
       
       
        $request = $this->getRequest();
        if ($request->isPost()) {

            //refatorar chmando  o VeiculoService
            // $form->setInputFilter($veiculo->getInputFilter());
            // $form->setData($request->getPost());
            $data = $request->getPost()->toArray();
            $veiculo->setPlaca($data['placa']);
            $veiculo->setRenavam($data['renavam']);
            $veiculo->setModelo($data['modelo']);
            $veiculo->setMarca($data['marca']);
            $veiculo->setAno($data['ano']);
            $veiculo->setCor($data['cor']);
            // if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($veiculo);
                $em->flush();
                $this->flashMessenger()->addSuccessMessage('Veiculo Salvo com sucesso.');
                return $this->redirect()->toRoute('veiculo');
          //  }
        }
        
        return new ViewModel(array(
            'veiculo' => $veiculo,
            'form' => $form
        ));
    }

    /**
    * Add action
    *
    */
    public function addAction()
    {
        return $this->editAction();
    }

    /**
    * Delete action
    *
    */
    public function deleteAction()
    {
        $veiculo = $this->getEntityManager()->getRepository('Trafegus\entity\Veiculo')->find($this->params('id'));
        if ($veiculo) {
            //refatorar chamando veiculoService
            $em = $this->getEntityManager();
            $em->remove($veiculo);
            $em->flush();
            $this->flashMessenger()->addSuccessMessage('Veiculo Deleted');
        }
        return $this->redirect()->toRoute('veiculo');
    }

    public function getGridVeiculoAction()
    {
        $page = $this->params()->fromPost('page', 1);
        $rows = $this->params()->fromPost('rows', 50);
        $filterRules = json_decode($this->params()->fromPost('filterRules', '[]'));
        $em = $this->getEntityManager();
        $veiculo = $em->getRepository('Trafegus\Entity\Veiculo')->findBy(array(), array('placa' => 'ASC'));
        $paginator = new Paginator(new ArrayAdapter($veiculo));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage($rows);
        if (0 == $paginator->getAdapter()->count()) {
            $grid["rows"] = array();
        } else {
            //monta a grid
           $grid = $this->getGridVeiculo($paginator, $page, $rows);
        }
        $grid["total"] = $paginator->getAdapter()->count();
        return $this->getResponse()->setContent(Json::encode($grid));
    }
    public function getGridVeiculo($paginator = null, $page = null, $rows = null)
    {
        $i = 0;
        $grid = null;
        if (!empty($paginator)) {
            foreach ($paginator as $valores) {
                $id= $valores->getId();
                $class = 'class_excluir_' .  $valores->getId();
                $grid["rows"][$i]['id'] = "#";
                $grid["rows"][$i]['placa'] = $valores->getPlaca();
                $grid["rows"][$i]['renavam'] = $valores->getRenavam();
                $grid["rows"][$i]['modelo'] = $valores->getModelo();
                $grid["rows"][$i]['marca'] = $valores->getMarca();
                $grid["rows"][$i]['ano'] = $valores->getAno();
                $grid["rows"][$i]['cor'] = $valores->getCor();
                $grid["rows"][$i]['opcao'] = null;
                $grid["rows"][$i]['opcao'] .= '<span style="padding-left: 10px"><a title="Editar Cadastro" href="/public/veiculo/edit/' . $id . '"><i class="btn btn-primary" style="color:white;cursor:pointer ">edit</i></a></span>';
                $grid["rows"][$i]['opcao'] .= '<span style="padding-left: 10px"><a title="deletar Cadastro" href="/public/veiculo/delete/' . $id . '"><i  class="btn btn-danger" style="color:white;cursor:pointer ">del</i></a></span>';
                $i++;
            }
        }
        return $grid;
    }
    function getCoordenadaVeiculoAction() {
        $em = $this->getEntityManager();
         $veiculo = $em->getRepository('Trafegus\entity\Veiculo')->findBy(array(), array('placa' => 'ASC'));
         foreach ($veiculo as $key => $value){
          $resultList[]=$veiculo[$key]->getArrayCopy();  
         }
         return $this->getResponse()->setContent(Json::encode($resultList));
    }
}
