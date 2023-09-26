<?php

namespace Trafegus\Form;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;
use Doctrine\ORM\EntityRepository;
use Zend\Form\Element;
use Doctrine\ORM\EntityManager;
use Zend\Form\Element\Text;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Button;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;

class VeiculoForm extends Form {

    protected $entityManager;
    public function __construct($em) {
        //dando nome ao form
        parent::__construct('Veiculo');
        $this->entityManager =  $em ;
   
          $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'col-lg-12 form-horizontal',
            'role' => 'form'
        ));
      
        //ocultando o id
        $id = new Hidden('id');
        $id->setAttributes(array('id' => 'id'));
        //razão social
        $placa = new Text('placa');
        $placa->setLabel('Placa')
                ->setAttributes(array(
                    'id' => 'placa',
                    'class' => 'form-control',
                    'maxlength' => '6',
                    'num_cols' => '6',
                    'placeholder' => 'Informar  a placa',
                    'required' => 'required',
                    'style' => 'width:400px;'
        ));
        $renavam = new Text('renavam');
        $renavam->setLabel('Renavam')
                ->setAttributes(array(
                    'id' => 'renavam',
                    'class' => 'documento form-control',
                    'maxlength' => '11',
                    'num_cols' => '5',
                    'placeholder' => 'Informar o Renavam',
                    'required' => 'required',
                    'style' => 'width:400px;',
        
        ));
        //nodelo   
        $modelo = new Text('modelo');
        $modelo->setLabel('modelo:')
                ->setAttributes(array(
                    'id' => 'modelo',
                    'class' => 'form-control',
                    'maxlength' => '20',
                    'num_cols' => '5',
                    'placeholder' => 'Informar o modelo',
                    'required' => 'required',
                    'style' => 'width:400px;'
        ));
         //nodelo   
         $marca = new Text('marca');
         $marca->setLabel('Marca:')
                 ->setAttributes(array(
                     'id' => 'marca',
                     'class' => 'form-control marca',
                     'maxlength' => '20',
                     'num_cols' => '5',
                     'placeholder' => 'Informar a Marca',
                     'required' => 'required',
                     'style' => 'width:400px;'
         ));
        $ano = new Text('ano');
        $ano->setLabel('Ano:')
                ->setAttributes(array(
                    'id' => 'ano',
                    'class' => 'form-control ano',
                    'maxlength' => '80',
                    'num_cols' => '3',
                    'style' => 'width:400px;',
                    'required' => 'required',
        ));
        $cor = new Text('cor');
        $cor->setLabel('Cor:')
                ->setAttributes(array(
                    'id' => 'cor',
                    'class' => 'form-control cor',
                    'maxlength' => '80',
                    'num_cols' => '3',
                    'style' => 'width:400px;',
                    'required' => 'required',
        ));
        $this->add($id);
        $this->add($placa);
        $this->add($renavam);
        $this->add($modelo);
        $this->add($marca);
        $this->add($ano);
        $this->add($cor);
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
            ),
        ));

    }
    
 
}
