<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoursRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;

class CoursController extends AbstractController
{
    /**
     * @Route("/", name="allcours")
     */
    public function allCours(CoursRepository $coursrepo, CategorieRepository $categorierepo)
    {
        $product = $coursrepo->findBy(['visibilite' => 1]);
        $categories = $categorierepo->findAll();
        foreach ($product as $key => $value) {
            $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }
        foreach ($categories as $key => $value) {
            $value->setImgC(base64_encode(stream_get_contents($value->getImgC())));
        }

        return $this->render('cours/allCours.html.twig', [
            'produits' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/cours/{slug}", name="findByCategory")
     */
    public function findByCategory($slug, CoursRepository $coursrepo): Response
    {
        $product = $coursrepo->findOneBy(['slug' => $slug]);

        //  return new Response('Check out this great product: '.$product->getDescription());
        return $this->render('cours/detail.html.twig', [
        'cours' => $product,
    ]);
    }
}
