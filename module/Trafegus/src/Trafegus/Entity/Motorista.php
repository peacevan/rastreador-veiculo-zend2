<?php

namespace Trafegus\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Motorista
 *
 * @ORM\Table(name="motorista")
 * @ORM\Entity
 */
class Motorista implements InputFilterAwareInterface
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
     *
     * @ORM\ManyToOne(targetEntity="Trafegus\Entity\Veiculo")
     * @ORM\JoinColumn(name="id_veiculo", referencedColumnName="id")
    */
    private $idVeiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=200, nullable=false)
     */
    private $nome;

    protected $inputFilter;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=11, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="rg", type="string", length=20, nullable=false)
     */
    private $rg;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=20, nullable=false)
     */
    private $telefone;

/**
 * Get id
 *
 * @return integer
 */
    public function getId()
    {
        return $this->id;
    }


        /**
     * Set nome
     *
     * @param integer $id
     * @return Motorista
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Motorista
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set idMotorista
     *
     * @param integer $cpf
     * @return Motorista
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }
    /**
     * Get rg
     *
     * @return string
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set rg
     *
     * @param string $rg
     * @return Motorista
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }

    /**
     * Get telefoneone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set rg
     *
     * @param string $telfone
     * @return Motorista
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * Get id veiculo
     *
     * @return string
     */
    public function getIdVeiculo()
    {
        return $this->idVeiculo;
    }

    /**
     * Set rg
     *
     * @param integer $veiculo
     * @return Motorista
     */
    public function setIdVeiculo($veiculo)
    {
        $this->idVeiculo = $veiculo;
        return $this;
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
     * Get input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {

        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    /**
     * Exchange array - used in ZF2 form
     *
     * @param array $data An array of data
     */
    public function exchangeArray($data)
    {
        $this->idMotorista = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
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
