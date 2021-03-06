<?php
namespace Civix\ApiBundle\EventListener;

use Civix\CoreBundle\Entity\Micropetitions\Petition;
use Civix\CoreBundle\Service\HTMLMetadataParser;
use Doctrine\ORM\Event\LifecycleEventArgs;
use GuzzleHttp\Client;

class PetitionMetadataListener
{
    const PATTERN = '@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.\,]*(\?\S+)?)?)*)@';

    /**
     * @var HTMLMetadataParser
     */
    private $parser;

    public function __construct(HTMLMetadataParser $parser)
    {
        $this->parser = $parser;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Petition || $entity->getType() !== Petition::TYPE_QUORUM) {
            return;
        }

        if (preg_match(self::PATTERN, $entity->getPetitionBody(), $matches)) {
            $client = new Client();
            $response = $client->get($matches[1]);
            $metadata = $this->parser->parse($response->getBody());
            if ($metadata->getTitle()) {
                $entity->setMetadata($metadata);
            }
        }
    }
}