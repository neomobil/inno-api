<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CourseStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseStatusRepository::class)]
#[ApiResource]
class CourseStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'courseStatus', targetEntity: UserCourseStatus::class)]
    private Collection $userCourseStatuses;

    public function __construct()
    {
        $this->userCourseStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, UserCourseStatus>
     */
    public function getUserCourseStatuses(): Collection
    {
        return $this->userCourseStatuses;
    }

    public function addUserCourseStatus(UserCourseStatus $userCourseStatus): static
    {
        if (!$this->userCourseStatuses->contains($userCourseStatus)) {
            $this->userCourseStatuses->add($userCourseStatus);
            $userCourseStatus->setCourseStatus($this);
        }

        return $this;
    }

    public function removeUserCourseStatus(UserCourseStatus $userCourseStatus): static
    {
        if ($this->userCourseStatuses->removeElement($userCourseStatus)) {
            // set the owning side to null (unless already changed)
            if ($userCourseStatus->getCourseStatus() === $this) {
                $userCourseStatus->setCourseStatus(null);
            }
        }

        return $this;
    }
}
