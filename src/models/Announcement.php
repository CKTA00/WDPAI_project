<?php

class Announcement
{
    private string $title;
    private string $imageUrl;
    private string $description;
    private int $range;

    public function __construct(string $title, string $imageUrl, string $description, int $range)
    {
        $this->title = $title;
        $this->imageUrl = $imageUrl;
        $this->description = $description;
        $this->range = $range;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
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
        switch ($range){
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