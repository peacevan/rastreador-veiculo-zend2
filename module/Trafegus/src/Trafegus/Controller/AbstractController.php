<?php

namespace Trafegus\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;

/* Controller incomun a todos basta herdar */

class AbstractController extends AbstractActionController {

    public $entityManager;
    public $container;

    public function __construct($container, $entityManager) {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    public function phpInfo($info) {
        $firephp = $this->container->get('Zend\Log\FirePhp');
        return $firephp->info($info);
    }

    public function getEM($entity = null) {
       
        if ($entity === null) {
           
            return $this->entityManager;
        } else {
           
            $em = $this->entityManager;
 
            return $em->getRepository($entity);
        }
       
    }

    public function getEmRef($entity, $id) {
        return $this->getEM()->getReference($entity, $id);
    }

    /**
     * Define em qual servico o sistema irá se conectar (padrao doctrine ou dbFactory)
     * @return String
     */
    public function getModulo() {

        $retorno = "Doctrine\ORM\EntityManager";
        if (!empty($this->modulo)) {
            $currentModule = explode('\\', $this->modulo);
            $retorno = "Base\Service\DbFactory\\$currentModule[0]";
        }
        return $retorno;
    }

    /**
     * Insere um msg no objeto "FlashMessenger"
     * @param string $texto O texto
     * @param String $tipo O tipo ('sussccess','error','warning','message')
     */
    protected function setMessage($texto, $tipo = 'message') {
        $fmsg = new FlashMessenger;
        $fmsg->addMessage($texto, $tipo);
    }

    protected function getMessages() {
        $fmsg = new FlashMessenger;
        return $fmsg->getMessages();
    }

    /**
     * Método que gera mensagem de erro.
     * @return string
     */
    public function getMensagemErro($form) {
        $keys = array_keys($form->getMessages());
        $elements = $form->getElements();

        $invalidos = [];
        $mensagem = "Dados inválidos. Verifique os seguintes campos: ";
        foreach ($keys as $k) {

            if ('csrf' != $k) {
                $invalidos[] = '<strong>'.$elements[$k]->getLabel().'</strong>';
            }
        }

        $mensagem .= implode(', ', $invalidos);
        if(count($invalidos) > 1){
            $mensagem .= '.';
            $lastCommaPos = strrpos($mensagem, ',');
            $mensagem = substr_replace($mensagem, ' e ', $lastCommaPos, 2);
        }
        return $mensagem;
    }

}
