<?php
namespace Trafegus\Repository;

use Doctrine\ORM\EntityRepository;

class VeiculoRepository extends EntityRepository {
    public function getLikeVeiculo($parametro) {
        $result = null;
        if (!empty($parametro)) {
            $qb = $this->createQueryBuilder('u')
                    ->select('u')
                    ->where('u.placa LIKE :placa');
            $qb->setParameter('placa', "%$parametro%");
            $query = $qb->getQuery();
            $result = $query->getResult();
          return $result;
        }
    }  
}
