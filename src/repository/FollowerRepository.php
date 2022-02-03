<?php

require_once 'Repository.php';

class FollowerRepository extends Repository
{
    public function getFollowsOfUser($userId)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ann.id, ann.title, ann.description, ann.range_id, ann.images, ann.location, u.login, u.name, u.surname, u.profile_image
            FROM announcements ann 
            JOIN users u ON ann.user_id = u.id
            JOIN followers f ON ann.id = f.announcement_id
            WHERE f.user_id = :userId
        ');

        $stmt->bindParam(":userId",$userId,PDO::PARAM_INT);
        $stmt->execute();
        $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($announcements == false){
            return null;
        }

        $anns = [];
        foreach($announcements as $project)
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

        return $anns;
    }

    public function getFollowersOfAnnouncement($annId)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM followers JOIN users ON id = user_id
            WHERE ann_id = :annId
        ');

        $stmt->bindParam(":annId",$annId,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addFollower($annId, $userId)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO followers (user_id,announcement_id) VALUES (:userId, :annId)
        ');
        $stmt->bindParam(":userId",$userId,PDO::PARAM_INT);
        $stmt->bindParam(":annId",$annId,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function removeFollower($annId, $userId)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM followers 
            WHERE announcement_id = :annId AND user_id = :userId
        ');

        $stmt->bindParam(":annId",$annId,PDO::PARAM_INT);
        $stmt->bindParam(":userId",$userId,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function isUserFollowing(int $userId, int $annId): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT f.user_id
            FROM followers f
            JOIN announcements ann
            ON f.announcement_id = ann.id
            WHERE :id = ann.id AND :follower = f.user_id
        ');
        $stmt->bindParam(":id", $annId, PDO::PARAM_INT);
        $stmt->bindParam(":follower", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $follower = $stmt->fetch(PDO::FETCH_ASSOC);
        if(is_array($follower))
            return true;
        return isset($follower["id"]);
    }
}