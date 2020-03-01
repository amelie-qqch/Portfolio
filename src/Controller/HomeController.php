<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @return Response
     * TODO enlever l'injection de repository
     */
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findLatest();

        return $this->render('pages/home.html.twig',
            [
                'articles'    =>  $articles
            ]);
    }




}