<?php

namespace Civix\CoreBundle\Entity\Poll\Question;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use JMS\Serializer\Annotation as Serializer;
use Civix\CoreBundle\Model\Group\GroupSectionInterface;

/**
 * Group petition entity.
 *
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("all")
 */
class GroupPetition extends Petition implements GroupSectionInterface
{
    use \Civix\CoreBundle\Model\Group\GroupSectionTrait;

    /**
     * @ORM\ManyToOne(targetEntity="\Civix\CoreBundle\Entity\Group")
     * @JoinColumn(name="group_id", onDelete="CASCADE")
     * @Serializer\Expose()
     * @Serializer\Groups({"api-poll", "api-leader-poll"})
     */
    private $user;

    public function getType()
    {
        return 'group_petition';
    }

    /**
     * Set user.
     *
     * @param \Civix\CoreBundle\Entity\Group $user
     *
     * @return Group
     */
    public function setUser(\Civix\CoreBundle\Entity\Group $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Civix\CoreBundle\Entity\Group
     */
    public function getUser()
    {
        return $this->user;
    }
}
