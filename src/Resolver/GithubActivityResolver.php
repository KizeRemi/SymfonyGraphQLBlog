<?php
namespace App\Resolver;

use App\Github\ApiClient;
use App\Github\ActivityFactory;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class GithubActivityResolver implements ResolverInterface, AliasedInterface
{
    const GITHUB_USERNAME = 'KizeRemi';

    private $api;
    private $eventFactory;

    public function __construct(ApiClient $api, ActivityFactory $activityFactory)
    {
        $this->api = $api;
        $this->activityFactory = $activityFactory;
    }

    public function getGithubActivities()
    {
        $response = $this->api->handleCall('/users/'.self::GITHUB_USERNAME.'/events', ['per_page' => 6]);
        $data = $this->api->handleResponse($response);

        return $this->activityFactory->createActivityCollection($data);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'getGithubActivities' => 'getGithubActivities',
        ];
    }
}
