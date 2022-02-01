<?php

require_once 'Repository.php';

class FollowerRepository extends Repository
{
    public function getFollowsOfUser($userId)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM announcements ann JOIN followers f
            ON ann.id = f.announcement_id
            WHERE f.user_id = :userId
        ');

        $stmt->bindParam(":userId",$userId,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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