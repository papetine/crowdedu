<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoursRepository;

class CoursController extends AbstractController
{
    /**
     * @Route("/cours", name="cours")
     */
    public function allCours(CoursRepository $coursrepo)
    {
        $product = $coursrepo->findAll();

        foreach ($product as $key => $value) {
            $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }

        return $this->render('cours/allCours.html.twig', [
            'produits' => $product,
        ]);
    }
}
