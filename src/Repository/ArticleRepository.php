<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param array $filters
     * @return Article[]
     */
    public function search(array $filters = [])
    {
        // constructeur de requête SQL
        // "a" est l'alias de l'entité Article
        $builder = $this->createQueryBuilder('a');

        // tri par date de publication décroissant
        $builder->orderBy('a.publicationDate', 'DESC');

        if (!empty($filters['title'])) {
            $builder
                // ajoute un élément à la clause WHERE
                ->andWhere('a.title LIKE :title')
                // bindValue du marqueur :title
                ->setParameter('title', '%' . $filters['title'] . '%')
            ;
        }

        if (!empty($filters['category'])) {
            $builder
                ->andWhere('a.category = :category')
                ->setParameter('category', $filters['category'])
            ;
        }

        if (!empty($filters['start_date'])) {
            $builder
                ->andWhere('a.publicationDate >= :start_date')
                ->setParameter('start_date', $filters['start_date'])
            ;
        }

        if (!empty($filters['end_date'])) {
            $builder
                ->andWhere('a.publicationDate <= :end_date')
                ->setParameter('end_date', $filters['end_date'])
            ;
        }

        // objet Query généré
        $query = $builder->getQuery();

        // retourne un tableau d'objets Article
        return $query->getResult();
    }
}
