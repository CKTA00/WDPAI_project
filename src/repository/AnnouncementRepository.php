<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class AnnouncementRepository extends Repository
{
    public function getAnnouncements(string $userLogin): ?Array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ann.id, ann.title, ann.description, ann.range_id, ann.images, ann.location
            FROM announcements ann JOIN users u
            ON u.id = ann.user_id
            WHERE :login = u.login
        ');
        $stmt->bindParam(":login", $userLogin, PDO::PARAM_STR);
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($projects == false){
            return null;
        }

        $anns = [];
        foreach($projects as $project)
        {
            $ann = new Announcement(
                $project['title'],
                $project['description'],
                $project['images'],
                $project['location'],
                $project['range_id']
            );
            $ann->setId($project['id']);
            $anns[] = $ann;
        }

        return $anns;
    }

    public function getAnnouncementById(int $id): ?Announcement
    {

        $project = $this->getRawAnnouncementById($id);

        if($project == false){
            return null;
        }
        $ann = new Announcement(
            $project['title'],
            $project['description'],
            $project['images'],
            $project['location'],
            $project['range_id']
        );
        $ann->setId($id);
        return $ann;
    }

    public function getRawAnnouncementById(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ann.title, ann.description, ann.range_id, ann.images, ann.location
            FROM announcements ann
            WHERE :id = ann.id
        ');
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRawAnnouncementDetailsById(int $annId)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM announcements ann
            JOIN users u
            ON u.id = ann.user_id
            WHERE :id = ann.id
        ');
        $stmt->bindParam(":id", $annId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addAnnouncement(Announcement $announcement, string $ownerId): int
    {
        $stmt = $this->database->connect()->prepare('
            WITH i AS(
            INSERT INTO announcements (user_id, title, description, range_id, images, location)
            VALUES (?, ?, ?, ?, ?, ?) RETURNING id
            ) SELECT i.id FROM i
        '); // WITH selects id of added row
        $stmt->execute(
            [
                $ownerId,
                $announcement->getTitle(),
                $announcement->getDescription(),
                $announcement->getRange(),
                $announcement->getImages(),
                $announcement->getLocation()
            ]
        );
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $id["id"];
    }

    public function editAnnouncement(int $id, Announcement $announcement, int $ownerId)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.announcements 
            SET title = :title, description = :description,
                range_id = :range_id, images = :images, location = :location
            WHERE id = :id AND user_id = :owner_id
        ');
        $title = $announcement->getTitle();
        $description = $announcement->getDescription();
        $range = $announcement->getRange();
        $images = $announcement->getImages();
        $location = $announcement->getLocation();
        $stmt->bindParam(":title",$title,PDO::PARAM_STR);
        $stmt->bindParam(":description",$description,PDO::PARAM_STR);
        $stmt->bindParam(":range_id",$range,PDO::PARAM_INT);
        $stmt->bindParam(":images",$images,PDO::PARAM_STR);
        $stmt->bindParam(":location",$location,PDO::PARAM_STR);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->bindParam(":owner_id",$ownerId,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteAnnouncement(int $id, int $ownerId)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM announcements 
            WHERE id = :id AND user_id = :owner_id
        ');

        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->bindParam(":owner_id",$ownerId,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAnnouncementsByDistance(string $userLocation, $maxDistance=2000.0): ?Array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ann.id, ann.title, ann.description, ann.range_id, ann.images, ann.location, u.login, u.name, u.surname, u.profile_image
            FROM announcements ann JOIN users u ON ann.user_id = u.id
        ');
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($projects == false){
            return null;
        }

        $anns = [];
        foreach($projects as $project)
        {
            $owner = new User(
                "_",
                $project['login'],
                $project['name'],
                $project['surname'],
                "_",
                $project['profile_image']
            );
            $ann = new Announcement(
                $project['title'],
                $project['description'],
                $project['images'],
                $project['location'],
                $project['range_id']
            );
            $ann->setId($project['id']);
            $ann->setOwner($owner);
            $anns[] = $ann;
        }

        // TODO: calculate distance to each one from user and show only nearest

        return $anns;
    }
}