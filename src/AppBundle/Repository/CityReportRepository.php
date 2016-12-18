<?php namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CityReportRepository extends EntityRepository
{

    public function locate($name, $year, $month)
    {
        return $this->createQueryBuilder('r')
            ->select('*')
            ->from('city_report', 'r')
//            ->getFirstResult();
            ->getQuery()->getDQL();

//        return $this->createNamedQuery()
//            ->select('r')
//            ->from('AppBundle:CityReport', 'r')
//            ->innerJoin('AppBundle:City', 'c', Join::ON, 'r.city_id = c.id')
//            ->where("c.name = $name")
//            ->andWhere("r.year = $year")
//            ->andWhere("r.month = $month")
//            ->getQuery();

//        return $this->getEntityManager()
//            ->createQuery("
//                SELECT r
//                FROM AppBundle:CityReport r
//                INNER JOIN AppBundle:City c
//                WHERE
//                  c.name = $name AND
//                  r.year = $year AND
//                  r.month = $month
//            ")->getQ();
    }

}