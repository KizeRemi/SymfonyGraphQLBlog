<?php
namespace App\Github;

class ActivityFactory
{
    private $fields = ['type', 'repo', 'payload', 'created_at'];
    private $activities = [];

    public function createActivity(array $data)
    {
        $commit = null;
        $message = null;
        $ref = null;
        $url = null;
        $pullRequestAction = null;

        if (empty($data)) {
            throw new \RuntimeException('data is empty');
        }

        foreach ($this->fields as $field) {
            if (empty($data[$field])) {
                throw new \RuntimeException('Field: '.$field.' is not found');
            }
        }

        if($data['type'] === 'PushEvent') {
            $message = $data['payload']['commits'][0]['message'];
            $url = $data['payload']['commits'][0]['url'];
            $ref = $data['payload']['ref'];
            $commit = substr($data['payload']['commits'][0]['sha'], 0, 7);
        }

        if($data['type'] === 'PullRequestEvent') {
            $url = $data['repo']['url'];
            $ref = $data['payload']['pull_request']['head']['ref'];
            $pullRequestAction = $data['payload']['action'];
        }

        if($data['type'] === 'CreateEvent') {
            $url = $data['repo']['url'];
            $ref = $data['payload']['ref'];
        }
    
        $this->activities[] = new GithubActivity(
            $data['type'],
            $data['repo']['name'],
            $commit,
            $message,
            $url,
            $ref,
            $pullRequestAction,
            $data['created_at'],
            $data['actor']['avatar_url']
        );
    }

    public function createActivityCollection(array $activities)
    {
        if (empty($activities)) {
            return $this->activities;
        }

        foreach($activities as $activity) {
            $this->createActivity($activity);
        }

        return $this->activities;
    }
}
