<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Repository\CoursRepository;
use App\Repository\CategorieRepository;
use App\Entity\Cours;
use App\Entity\Categorie;

class CoursController extends AbstractController
{
    /**
     * @Route("/", name="cours")
     * 
     */
    public function allCours(CoursRepository $coursrepo,CategorieRepository $cateRepo)
    {
        $session= new Session();
        $product = $coursrepo->findBy(['visibilite'=>1]);
        $categories = $cateRepo->findAll();
        foreach ($product as $value) {
            $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }
        foreach ($categories as $value) {
            $value->setImgC(base64_encode(stream_get_contents($value->getImgC())));
        }
        if ($session->has('panier')) {
            $panier = $session->get('panier');
        }
            $panier=false;
        
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
     * @Route("/courCategorie/{categorie}", name="page_produitsByCategory")
     * 
     */
    public function findOneCoursCategorie(Categorie $categorie, CategorieRepository $cateRepo)
    {    
        $entityManager = $this->getDoctrine()->getManager();
        $categorielib = $cateRepo->find($categorie);
        $tousLesCategories = $cateRepo->findAll();
        $findcours = $entityManager->getRepository(Cours::class)->produitsByCategorie($categorie);
        foreach ($findcours as $value) {
        $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }
        return $this->render('cours/courBycategorie.html.twig', [
            'categorie' => $findcours,'categorielibelle'=> $categorielib,'categories'=>$tousLesCategories]);
    }
    /**
     * @Route("/showCommande/{slug}", name="show_commande",methods="GET")
     * 
     */
    public function finaliserCommande(Cours $cours)
    {

        return $this->render('cours/finaliser_commande.html.twig', [
           'cour'=>$cours ]);
    }
}
