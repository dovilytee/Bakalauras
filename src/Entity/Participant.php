<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]

class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @OMR\ManyToOne(targetEntity="User", inversedBy="participants")
     */
    private $user;

    /**
     * @OMR\ManyToOne(targetEntity="Conversation", inversedBy="participants")
     */
    private $conversation;

    public function getId(): ?int
    {
        return $this->id;
    }
}
