<?php

namespace Trafegus\Repository;

use Doctrine\ORM\EntityRepository;

class MotoristaRepository extends EntityRepository {
    public function getLikeMotorista($parametro) {

        $result = null;
        if (!empty($parametro)) {
            $qb = $this->createQueryBuilder('u')
                    ->select('u')
                    ->where('u.nome LIKE :nome');
            $qb->setParameter('nome', "%$parametro%");
            $query = $qb->getQuery();
            $result = $query->getResult();
          return $result;
        }
    }  
}
