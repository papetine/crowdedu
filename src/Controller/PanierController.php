<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CoursRepository;

class PanierController extends AbstractController
{
    const SUCCESS = 'success';
    const PANIER= 'panier';
    /**
     * @Route("/panier", name="page_panier")
     */
    public function panier(Request $request, CoursRepository $courscaterepo)
    {
        $session = $request->getSession();
        if(!$session->has(self::PANIER)){$session->set(self::PANIER,array());}
         $panier = $session->get(self::PANIER);
         $produits = $courscaterepo->findArray(array_keys($panier));
        return $this->render('panier/index.html.twig', [
            'produit'=>$produits,self::PANIER => $panier,
        ]);
    }
    /**
     * @Route("/ajout_panier/{id}", name="page_ajouterPanier")
     */
    public function ajoutPanier($id,Request $request)
    {
        $session = $request->getSession();
        if(!$session->has(self::PANIER))
        {
            $session->set(self::PANIER,array());
            $session->getFlashBag()->add(self::SUCCESS ,"Ajout panier avec success");
        }
        $panier = $session->get(self::PANIER);
        if(array_key_exists($id, $panier))
        {
            if($request->query->get('qte') != null){
                $panier[$id] = $request->query->get('qte');
                $session->getFlashBag()->add(self::SUCCESS, " Quantité modifié avec succès");
            }
        }
            if($request->query->get('qte') != null){
                $panier[$id]=1;
                $session->getFlashBag()->add(self::SUCCESS, " Article ajouté avec succès");
            }
        
        $session->set(self::PANIER,$panier);
        dump($session);
        // return $this->redirectToRoute('page_panier');
    }
}
