<?php
namespace App\Github;

class UserActivities
{
    private $api;
    private $user;
    private $eventFactory;

    public function __construct(ApiClient $api, string $user, ActivityFactory $activityFactory)
    {
        $this->api = $api;
        $this->user = $user;
        $this->activityFactory = $activityFactory;
    }

    public function getActivities(array $options = [])
    {
        $response = $this->api->handleCall('/users/'.$this->user.'/events', ['per_page' => 6]);
        $data = $this->api->handleResponse($response);

        return $this->activityFactory->createActivityCollection($data);
    }
}
