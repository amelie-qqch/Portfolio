<?php
namespace App\Controller;

use App\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends AbstractController
{
    /**
     * @return Response obj Type
     */
    public function getType($id): Response
    {
        return $this->getDoctrine()->getRepository(Type::class)->find($id);

    }
}