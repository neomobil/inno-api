<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserCourseStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCourseStatusRepository::class)]
#[ApiResource]
class UserCourseStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userCourseStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userCourseStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    #[ORM\ManyToOne(inversedBy: 'userCourseStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CourseStatus $courseStatus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseUser(): ?User
    {
        return $this->user;
    }

    public function setCourseUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getCourseStatus(): ?CourseStatus
    {
        return $this->courseStatus;
    }

    public function setCourseStatus(?CourseStatus $courseStatus): static
    {
        $this->courseStatus = $courseStatus;

        return $this;
    }
}
