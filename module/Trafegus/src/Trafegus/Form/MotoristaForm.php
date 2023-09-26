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
use Trafegus\Filter\FornecedorFilter;

class MotoristaForm extends Form {

    protected $entityManager;

    public function __construct( $em) {
        //dando nome ao form
        parent::__construct('Motorista');
        $this->entityManager =  $em ;
   
          $this->setAttributes(array(
            'method' => 'POST',
            'class' => 'col-lg-12 form-horizontal',
            'role' => 'form'
        ));
        //ocultando o id
        $idMotorista = new Hidden('id');
        $idMotorista->setAttributes(array('id' => 'id'));
        $idVeiculo =array(
            'name' => 'veiculo',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'empty_option' => 'selecione um veiculo',
                'label' => 'veiculo',
                'object_manager' => $em,
                'target_class' => 'Trafegus\Entity\Veiculo',
                'property' => 'placa'
            ),
            'attributes' => array(
              'required' => true,
              'style' => 'width:410px;',
            )
        );  

        //razão social
        $nome = new Text('nome');
        $nome->setLabel('Nome')
                ->setAttributes(array(
                    'id' => 'nome',
                    'class' => 'form-control',
                    'maxlength' => '200',
                    'num_cols' => '6',
                    'placeholder' => 'Informar  o nome',
                    'required' => 'required',
                    'style' => 'width:810px;'
        ));
        $cpf = new Text('cpf');
        $cpf->setLabel('CPF')
                ->setAttributes(array(
                    'id' => 'cpf',
                    'class' => 'documento form-control',
                    'maxlength' => '11',
                    'num_cols' => '5',
                    'placeholder' => 'Informar CPF',
                    'required' => 'required',
                    'style' => 'width:400px;',
                   // 'onblur'=>"javascript: validarCPF(this.value);",
                   // "onkeypress"=>"javascript: mascara(this, cpf_mask);"
        ));
        //rg   
        $rg = new Text('rg');
        $rg->setLabel('RG:')
                ->setAttributes(array(
                    'id' => 'RG',
                    'class' => 'form-control',
                    'maxlength' => '20',
                    'num_cols' => '5',
                    'placeholder' => 'Informar o RG',
                    'required' => 'required',
                    'style' => 'width:400px;'
        ));

        $telefone = new Text('telefone');
        $telefone->setLabel('Telefone:')
                ->setAttributes(array(
                    'id' => 'telefone',
                    'class' => 'form-control telefone',
                    'maxlength' => '80',
                    'num_cols' => '3',
                    'style' => 'width:400px;',
                    'required' => 'required',
        ));
        $this->add($idMotorista);
        $this->add($nome);
        $this->add($cpf);
        $this->add($rg);
        $this->add($telefone);
        $this->add($idVeiculo);
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
