<?php

class Announcement
{
    private string $title;
    private string $imageUrl;
    private string $description;
    private string $location;

    public function __construct(string $title, string $imageUrl, string $description, $location)
    {
        $this->title = $title;
        $this->imageUrl = $imageUrl;
        $this->description = $description;
        $this->location = $location;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Announcement
    {
        $this->title = $title;
        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): Announcement
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Announcement
    {
        $this->description = $description;
        return $this;
    }

    public function getLcation()
    {
        return $this->location;
    }

    public function setLocation($location): Announcement
    {
        $this->location = $location;
        return $this;
    }


}