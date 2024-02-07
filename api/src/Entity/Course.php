<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[ApiResource]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'courses')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: UserCourseStatus::class, orphanRemoval: true)]
    private Collection $userCourseStatuses;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->userCourseStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addCourse($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeCourse($this);
        }

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
            $userCourseStatus->setCourse($this);
        }

        return $this;
    }

    public function removeUserCourseStatus(UserCourseStatus $userCourseStatus): static
    {
        if ($this->userCourseStatuses->removeElement($userCourseStatus)) {
            // set the owning side to null (unless already changed)
            if ($userCourseStatus->getCourse() === $this) {
                $userCourseStatus->setCourse(null);
            }
        }

        return $this;
    }
}
