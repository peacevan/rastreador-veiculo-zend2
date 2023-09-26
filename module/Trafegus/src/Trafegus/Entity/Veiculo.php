<?php

namespace Trafegus\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Veiculo
 *
 * @ORM\Table(name="veiculo")
 * @ORM\Entity
 */
class Veiculo implements InputFilterAwareInterface
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

   
    /**
     * @var string
     *
     * @ORM\Column(name="placa", type="string", length=7, nullable=false)
     */
    private $placa;

    /**
     * @var string
     *
     * @ORM\Column(name="renavam", type="string", length=30, nullable=false)
     */
    private $renavam;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=20, nullable=false)
     */
    private $modelo;

     /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=20, nullable=false)
     */
    private $marca;
   
     /**
     * @var integer
     *
     * @ORM\Column(name="ano", type="integer", length=4, nullable=false)
     */
    private $ano;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", length=4, nullable=false)
     */
    private $latitude;

     /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", length=4, nullable=false)
     */
    private $longitude;


     /**
     * @var string
     *
     * @ORM\Column(name="cor", type="string", length=20, nullable=false)
     */
    private $cor;
   
   protected $inputFilter;  

//**************************************************************************************************
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

     /**
     * Set id
     *
     * @param string id
     * @return Veiculo
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

   


     /**
     * Get placa
     *
     * @return string 
     */
    public function getPlaca() {
        return $this->placa;
    }

    /**
     * Set placa
     *
     * @param string $placa
     * @return placa
     */
    public function setPlaca($placa) {
        $this->placa = $placa;
        return $this;
    }


     /**
     * Get renavam
     *
     * @return string 
     */
    public function getRenavam(){
        return $this->renavam;
    }

    /**
     * Set renavam
     *
     * @param string $renavam
     * @return Veiculo
     */
    public function setRenavam($renavam) {
        $this->renavam = $renavam;
        return $this;
    }

    /**
     * Get Modelo
     *
     * @return string 
     */
    public function getModelo() {
        return $this->modelo;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Veiculo
     */
    public function setModelo($modelo) {
        $this->modelo = $modelo;
        return $this;
    }

    
    /**
     * Get Marca
     *
     * @return string 
     */
    public function getMarca() {
        return $this->marca;
    }

    /**
     * Set marca
     *
     * @param string $marca
     * @return Veiculo
     */
    public function setMarca($marca) {
        $this->marca = $marca;
        return $this;
    }
    
    /**
     * Get ano
     *
     * @return string 
     */
    public function getAno() {
        return $this->ano;
    }

    /**
     * Set ano
     *
     * @param string $ano
     * @return Veiculo
     */
    public function setAno($ano) {
        $this->ano = $ano;
        return $this;
    }

     
    /**
     * Get cor
     *
     * @return string 
     */
    public function getCor() {
        return $this->cor;
    }

    /**
     * Set cor
     *
     * @param string $cor
     * @return Veiculo
     */
    public function setCor($cor) {
        $this->cor = $cor;
        return $this;
    }
        /**
     * Get cor
     *
     * @return string 
     */
    public function getLogitude() {
        return $this->longitude;
    }

    /**
     * Set cor
     *
     * @param string $cor
     * @return Veiculo
     */
    public function setLogitude($longitude) {
        $this->longitude = $longitude;
        return $this;
    }

        /**
     * Get cor
     *
     * @return string 
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set cor
     *
     * @param string $latitude
     * @return Veiculo
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
        return $this;
    }



       
    /**
    * Get input filter
    *
    * @return InputFilterInterface
    */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'nome',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
       /**
    * Set input method
    *
    * @param InputFilterInterface $inputFilter
    */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

      /**
    * Exchange array - used in ZF2 form
    *
    * @param array $data An array of data
    */
    public function exchangeArray($data)
    {
      //  $this->id = (isset($data['id']))? $data['id'] : null;
     //   $this->name = (isset($data['name']))? $data['name'] : null;
    }

    /**
    * Get an array copy of object
    *
    * @return array
    */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

  }
