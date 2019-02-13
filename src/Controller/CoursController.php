<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoursRepository;
use App\Repository\CategorieRepository;


class CoursController extends AbstractController
{
    /**
     * @Route("/", name="cours")
     * 
     */
    public function allCours(CoursRepository $coursrepo,CategorieRepository $cateRepo)
    {
        $product = $coursrepo->findBy(['visibilite'=>1]);
        $categories = $cateRepo->findAll();
        foreach ($product as $value) {
            $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }

        return $this->render('cours/allCours.html.twig', [
            'produits' => $product,'categories'=>$categories,
        ]);
    }
    /**
     * @Route("/cour/{slug}", name="cour")
     * 
     */
    public function findOneCour($slug,CoursRepository $coursOnerepo)
    {
        $courID = $coursOnerepo->findOneBy(['slug'=> $slug]);
        $courID->setImage(base64_encode(stream_get_contents($courID->getImage())));
        return $this->render('cours/detailcour.html.twig', [
            'cour' => $courID,
        ]);
    }
     /**
     * @Route("/courCategorie/{$id}", name="courCategorie")
     * 
     */
    public function findOneCoursCategorie($categorie,CoursRepository $courscaterepo)

    {
        $categoriesCours = $courscaterepo->findOneBy(['categorie'=> $categorie]);
        return $this->render('cours/courBycategorie.html.twig', [
            'courbycate' => $categoriesCours, ]);
    }
}
