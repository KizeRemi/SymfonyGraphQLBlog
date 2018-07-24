<?php
namespace App\Resolver;

use App\Repository\SkillRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class SkillResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var SkillRepository
     */
    private $skillRepository;

    /**
     *
     * @param SkillRepository $skillRepository
     */
    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->skillRepository->findAll();
    }

    /**
     * @return array
     */
    public function getSkillsBylevel(int $level): array
    {
        return $this->skillRepository->findBy(['level' => $level]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'findAll' => 'Skills',
            'getSkillsByLevel' => 'getSkillsByLevel',
        ];
    }
}
