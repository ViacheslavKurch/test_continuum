<?php

namespace App\Model;

class User
{
    /** @var integer */
    private $id;

    /** @var string */
    private $email;

    /** @var string */
    private $passwordHash;

    /**
     * User constructor.
     * @param string $email
     * @param string $passwordHash
     */
    public function __construct(string $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}