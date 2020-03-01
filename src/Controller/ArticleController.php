<?php

namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{

    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ArticleRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
/*
        Création d'un objet en bd
        $article = new Article();
        $type=$this->getDoctrine()->getManager()->getRepository('App:Type')->find(6);
        $article->setTitre('A Propos')
            ->setType($type);
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
*/
/*
        $articles =$this->repository->findAll();
        $type=$this->getDoctrine()->getManager()->getRepository('App:Type')->findOneBy(['libelle'=>'Veille Techno']);
        $articles[1]->setType($type)
                    ->setTitre('La protection des données');
        dump($articles);
        $this->em->flush();
*/

        return $this->render('pages/article/article.html.twig',
            [
                'articles'=>'articles'
            ]);
    }


    public function indexAdmin():Response
    {
        return $this->render('admin/articles.html.twig');
    }

    /**
     * @param Article $article
     * @param string $slug
     * @return Response
     */
    public function article(Article $article, string $slug):Response
    {
        if($article->getSlug() !== $slug)
        {
            return $this->redirectToRoute('articles_enumeration',
                [
                    'id'    =>  $article->getId(),
                    'slug'  =>  $article->getSlug()
                ], 301);
        }
        return $this->render('pages/article/article.html.twig',
            [
                'article'       =>  $article,
                'current_menu'  =>  'article'// $this->getType ou un truc du genre
            ]);
    }




}