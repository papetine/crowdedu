<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CoursRepository;
use App\Form\ProjetType;
use App\Entity\Projet;
use App\Entity\Cours;

class PanierController extends AbstractController
{
    const SUCCESS = 'success';
    const PANIER= 'panier';
    const PRODUITS = 'produits';
    /**
     * @Route("/panier", name="page_panier")
     */
    public function panier(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if(!$session->has(self::PANIER)){$session->set(self::PANIER,array());}
         $panier = $session->get(self::PANIER);
         $produits = $entityManager->getRepository(Cours::class)->findArray(array_keys($panier));
         foreach ($produits as $value) {
            $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }
        return $this->render('panier/panier.html.twig', [
            'produits'=>$produits,self::PANIER => $session->get(self::PANIER),
        ]);
    }   
    /**
     * @Route("/ajout_panier/{id}", name="page_ajouterPanier")
     */
    public function ajoutPanier($id,Request $request ,CoursRepository $repcours)
    {
       $array = $repcours->find($id);
        $session = $request->getSession();
        if (!$session->has(self::PANIER)) { $session->set(self::PANIER,array($array));}
        $panier = $session->get(self::PANIER);
        
        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) {$panier[$id] = $request->query->get('qte');}
            $this->get('session')->getFlashBag()->add(self::SUCCESS,'Quantité modifié avec succès');
        }
            if ($request->query->get('qte') != null){
                $panier[$id] = $this->getRequest()->query->get('qte');
            }
            
                $panier[$id] = 1;
            
            $this->get('session')->getFlashBag()->add(self::SUCCESS,'Article ajouté avec succès');
        
        $session->set(self::PANIER,$panier);
        return $this->redirectToRoute('page_panier');
    }
    /**
     * @Route("/menu", name="page_menu")
     */
    public function menu(Request $request, Cours $produits = null)
    {
        
        $session = $request->getSession();
        if (!$session->has(self::PANIER)){
            $produits = 0;
        }
            $produits = count($session->get(self::PANIER));
        
        return $this->render('panier/index.html.twig', array(self::PRODUITS => $produits));
    }
    /**
     * @Route("/valider", name="valider_commande",methods="GET")
     *  @IsGranted("ROLE_USER")
     */
    public function validerCommande()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $produits = $entityManager->getRepository(Cours::class)->findArray(array_keys($panier));
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class,$projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projet->setDate(new \DateTime('now'));
            $projet->setUser($user);
            $projet->setCour($produits);
            $entityManager->persist($projet);
            $entityManager->flush();
        }
        return $this->render('panier/finaliser_commande.html.twig',['form' => $form->createView()]);
    }
    /**
     * @Route("/supprimer/{id}", name="page_supprimerPanier")
     */
    public function supprimerAction($id)
    {

        $session= new Session();

        $panier = $session->get(self::PANIER);
        
        if (array($id, $panier)) {
            unset($panier[$id]);
            $session->set(self::PANIER,$panier);
        
            $session->getFlashBag()->add(self::SUCCESS, " Article supprimé avec succès ");
        }
        return $this->redirectToRoute('page_panier');
    }

}
