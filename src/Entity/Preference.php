<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreferenceRepository")
 */
class Preference
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="preference", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $lang;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sound;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $music;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(?string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getSound(): ?bool
    {
        return $this->sound;
    }

    public function setSound(?bool $sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    public function getMusic(): ?bool
    {
        return $this->music;
    }

    public function setMusic(?bool $music): self
    {
        $this->music = $music;

        return $this;
    }
}
