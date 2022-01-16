<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class AnnouncementRepository extends Repository
{
    public function getAnnouncements(string $userId): ?Array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ann.id, ann.title, ann.description, ann.range_id, ann.images, ann.location
            FROM announcements ann JOIN users u
            ON u.id = ann.user_id
            WHERE :user_id = ann.user_id
        ');
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
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

    public function addAnnouncement(Announcement $announcement): int
    {
        $stmt = $this->database->connect()->prepare('
            WITH i AS(
            INSERT INTO announcements (user_id, title, description, range_id, images, location)
            VALUES (?, ?, ?, ?, ?, ?) RETURNING id
            ) SELECT i.id FROM i
        '); // WITH selects id of added row

        $userId = 3; //TODO: Fetch from session

        $stmt->execute(
            [
                $userId,
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
}