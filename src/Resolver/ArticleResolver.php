<?php
namespace App\Resolver;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class ArticleResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @return Article
     */
    public function userById(int $id): Article
    {
        return $this->articleRepository->find($id);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->articleRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'userById' => 'UserById',
            'findAll' => 'Users',
        ];
    }
}
