<?php
namespace App\Mutation;

use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use App\Entity\Skill;

final class SkillMutation implements MutationInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function resolve(string $title)
    {
        $skill = new Skill();
        $skill->setTitle($title);
        $skill->setTag($title);
        $skill->setLevel(2);
        $skill->setResume('');
        $skill->setImage('');

        $this->em->persist($skill);
        $this->em->flush();

        return $skill;
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewSkill',
        ];
    }
}
