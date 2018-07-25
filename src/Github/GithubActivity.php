<?php
namespace App\Github;

class GithubActivity
{
    private $type;
    private $name;
    private $commit;
    private $message;
    private $url;
    private $ref;
    private $pullRequestAction;
    private $createdAt;
    private $avatarUrl;

    public function __construct(
        string $type,
        string $name,
        string $commit = null,
        string $message = null,
        $url = null,
        string $ref = null,
        string $pullRequestAction = null,
        string $createdAt,
        string $avatarUrl
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->commit = $commit;
        $this->message = $message;
        $this->url = $url;
        $this->ref = $ref;
        $this->pullRequestAction = $pullRequestAction;
        $this->createdAt = $createdAt;
        $this->avatarUrl = $avatarUrl;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCommit()
    {
        return $this->commit;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function getPullRequestAction()
    {
        return $this->pullRequestAction;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
}
