<?php

namespace App\Models;

use DateTime;
use Exception;

class Post
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $text;

    /** @var DateTime */
    private $createdAt;

    /** @var DateTime */
    private $updatedAt;

    /**
     * Post constructor.
     * @param string $title
     * @param string $text
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(
        string $title,
        string $text,
        DateTime $createdAt,
        ?DateTime $updatedAt = null
    )
    {
        $this->title = $title;
        $this->text = $text;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param int $id
     * @throws Exception
     */
    public function setId(int $id): void
    {
        if (null !== $this->id) {
            throw new Exception();
        }

        $this->id = $id;
    }

    /**
     * @param string $title
     * @param string $text
     * @param DateTime|null $updatedAt
     * @throws Exception
     */
    public function update(
        string $title,
        string $text,
        ?DateTime $updatedAt = null
    ): void
    {
        $this->text = $text;
        $this->title = $title;
        $this->updatedAt = $updatedAt ?? new DateTime();
    }
}