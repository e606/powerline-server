<?php

namespace Civix\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Civix\CoreBundle\Entity\Group;
use Civix\CoreBundle\Entity\DeferredInvites;

/**
 * DeferredInvitesRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DeferredInvitesRepository extends EntityRepository
{
    public function getEmails(Group $group, $emails)
    {
        $queryBuilder = $this->getEntityManager()
               ->createQueryBuilder();
        $expr = $queryBuilder->expr();

        $data = $queryBuilder
               ->select('i.email')
               ->from('CivixCoreBundle:DeferredInvites', 'i')
               ->where('i.group = :group')
               ->andWhere('i.email in (:emails)')
               ->andWhere($expr->not($expr->exists(
                   'SELECT u.id FROM CivixCoreBundle:User u WHERE u.email in (:emails)'
               )))
               ->setParameter('group', $group)
               ->setParameter('emails', $emails)
               ->getQuery()
               ->getResult();

        return array_map(
            function ($data) {
                return $data['email'];
            },
            $data
        );
    }

    public function checkEmail($email)
    {
        return $this->createQueryBuilder('i')
                ->where('i.email = :email')
                ->andWhere('i.status = :status')
                ->setParameter('email', $email)
                ->setParameter('status', DeferredInvites::STATUS_ACTIVE)
                ->getQuery()
                ->getResult();
    }

    public function getInvitesCount(Group $group)
    {
        $defferedInvitesCount = $this->getEntityManager()
            ->createQuery('SELECT count(di) FROM CivixCoreBundle:DeferredInvites di WHERE di.group = :group')
            ->setParameter('group', $group)
            ->getSingleScalarResult()
        ;

        return $defferedInvitesCount;
    }
}
