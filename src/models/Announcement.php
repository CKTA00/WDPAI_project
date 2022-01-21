<?php

require_once "User.php";

class Announcement
{
    private string $title;
    private string $description;
    private string $images;
    private string $location;
    private int $range;

    private int $id;
    private User $owner;

    public function __construct(
        string $title,
        string $description,
        string $images,
        string $location,
        int $range
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->images = $images;
        $this->location = $location;
        $this->range = $range;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $user): void
    {
        $this->owner = $user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getImages(): string
    {
        return $this->images;
    }

    public function setImages(string $images)
    {
        $this->images = $images;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getRange(): int
    {
        return $this->range;
    }

    public function setRange(int $range)
    {
        $this->title = $range;
    }

    public static function getRangeName($range): string
    {
        $ret="";
        switch ($range){ // TODO fetch this names from database
            case 1:
                $ret = "Small (300m)";
                break;
            case 2:
                $ret = "Medium (500m)";
                break;
            case 3:
                $ret = "Large (1km)";
                break;
            case 4:
                $ret = "Very Large (2km)";
                break;
        }
        return $ret;
    }
}