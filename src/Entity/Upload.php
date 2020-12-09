<?php

namespace App\Entity;

use App\Repository\UploadRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UploadRepository::class)
 */
class Upload
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TelechergeFichier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelechergeFichier()
    {
        return $this->TelechergeFichier;
    }

    public function setTelechergeFichier($TelechergeFichier)
    {
        $this->TelechergeFichier = $TelechergeFichier;

        return $this;
    }
}
