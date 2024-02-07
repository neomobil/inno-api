<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $roles = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: 'users')]
    private Collection $courses;

    #[ORM\OneToMany(mappedBy: 'courseUser', targetEntity: UserCourseStatus::class, orphanRemoval: true)]
    private Collection $userCourseStatuses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->userCourseStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): static
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        $this->courses->removeElement($course);

        return $this;
    }

    /**
     * @return Collection<int, UserCourseStatus>
     */
    public function getUserCourseStatus(): Collection
    {
        return $this->userCourseStatuses;
    }

    public function addCUserCourseStatus(UserCourseStatus $userCourseStatus): static
    {
        if (!$this->userCourseStatuses->contains($userCourseStatus)) {
            $this->userCourseStatuses->add($userCourseStatus);
        }

        return $this;
    }

    public function removeUserCourseStatus(UserCourseStatus $userCourseStatus): static
    {
        $this->userCourseStatuses->removeElement($userCourseStatus);

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
            $userCourseStatus->setCourseUser($this);
        }

        return $this;
    }
}
