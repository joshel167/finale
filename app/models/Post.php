<?php


class Post
{
    public $postId, $heading, $body, $userId;
    public $table = 'posts';

    public function __construct(
        string $heading = null,
        string $body = null,
        int $userId = null

    )
    {
        $heading ? $this->heading = $heading : false;
        $body ? $this->body = $body : false;
        $userId ? $this->userId = $userId : false;
    }

    public function find(int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
        $query = "select * from posts where postId =:id";
        $stmt = Singleton::getInstance()->getPDO()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        var_dump($result);
        if ($result) {
            $this->postId = intval($result->postId);
            $this->heading = $result->heading;
            $this->body = $result->body;
            $this->userId = intval($result->userId);
        }
    }
}