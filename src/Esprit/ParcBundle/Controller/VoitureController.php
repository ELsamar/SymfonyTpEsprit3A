<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 10/4/2018
 * Time: 9:49 AM
 */

namespace Esprit\ParcBundle\Controller;

use Esprit\ParcBundle\Entity\Voiture;
use Esprit\ParcBundle\Form\VoitureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VoitureController extends Controller
{
    public function affichageAction ($marque)
    {
        $voitures = array(
            array(
                "id"=>'1',
                "serie"=>"207",
                "marque"=>"BMW"
            ),
            array(
                "id"=>'2',
                "serie"=>"206",
                "marque"=>"Mercedes"
            )
        );
        return $this->render('@EspritParc/Voiture/affichage.html.twig',
            array(
                "marque"=> $marque,
                "voitures"=>$voitures
            ));
    }
    public function listAction  ($marques)
    {
        return $this->render('@EspritParc/Voiture/list.html.twig',
            array(
                "Marques"=>  $marques=array('BMW','Renault','Peugeot','Fiat')
            ));
    }
    public function detailsAction  (Request $request)
    {
        //recuperation desparametres envoyes:
        $id = $request ->get('id');
        $serie= $request -> get('serie');
        $marque=$request -> get('marque');
        return $this->render('@EspritParc/Voiture/details.html.twig',
            array(
                'id'=> $id,
                'serie'=> $serie,
                'marque'=> $marque
            ));
    }
    public function addAction(Request $request){
      $Voiture = new Voiture();
       $form = $this->createForm(VoitureType::class,$Voiture);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
            echo 'suite au click sur le bouton submit';
          $em = $this->getDoctrine()->getManager();
          $em->persist($Voiture);
          $em->flush();
          return $this->redirectToRoute( 'esprit_addVoiture');
      }


        return $this ->render('@EspritParc/Voiture/add.html.twig',array(
           "Form"=>$form->createView()

        ));
    }
    public function listvoitureAction()
    {
        //creer une instance de l'entiteer manager
        $em = $this -> getDoctrine()-> getManager();
        $voitures = $em -> getRepository("EspritParcBundle:Voiture")
            ->findAll(); //recuperer tout les modeles
        //$modeles de type tableau d'objet
        return $this->render('@EspritParc/Voiture/listvoiture.html.twig'
            ,array(
                "voitures"=> $voitures
            ));
    }
    public function suppVoitureAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $voiture = $em -> getRepository("EspritParcBundle:Voiture")->find($id);
        //$modele de type objet
        $em ->remove($voiture);
        $em ->flush();
        return $this->redirectToRoute('esprit_listVoiture');
    }

    public function updateVoitureAction(Request $request){
        $id = $request ->get('id');
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('EspritParcBundle:Voiture')
            ->find($id);
        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('esprit_listVoiture');
        }
        return $this->render('@EspritParc/Voiture/update.html.twig'
            ,array(
                "Form"=>$form->createView()
            ));
    }
    public function rechecheVoitureAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        //recuperer tt liste
        $voitures = $em->getRepository('EspritParcBundle:Voiture')
            ->findAll();
        //if est obligtoire puisque la methode au 1ere est get
        if ($request->isMethod('POST')){
            $serie = $request->get('serie');
            $marque =$request->get('marque');
         //la liste de voiture filtre
            $voitures = $em->getRepository('EspritParcBundle:Voiture')
                ->findBy(array(
                    'serie' => $serie,
                    'marque' => $marque
                ));
               // ->findBy(['serie' => $serie],['marque' => $marque]);
           // print_r($voitures);
            //var_dump($voitures);
        }
        return $this->render('@EspritParc/Voiture/rechecheVoiture.html.twig'
            ,array(
                "voitures"=>$voitures
            ));
    }
    public function findvoitureAction()
    {
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository("EspritParcBundle:Voiture")->findByDateVoiture();
        return($this->render("@EspritParc/Voiture/listvoiture.html.twig"
            , array(
                "voitures"=>$voiture
            )));

    }
    public function findByCountryAction()
    {
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository("EspritParcBundle:Voiture")->findByCountry();
        return($this->render("@EspritParc/Voiture/listvoiture.html.twig"
            , array(
                "voitures"=>$voiture
            )));

    }
    public function rechercherAjaxAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $voiture = $em->getRepository('EspritParcBundle:Voiture')
            ->findAll();
        if ($request -> isMethod('post')){
            $serie=$request->get('serie');
            $voiture = $em->getRepository("EspritParcBundle:Voiture")
                ->findBySerie($serie);
        }

        return $this->render("@EspritParc/Voiture/rechercher.html.twig"
        ,array(
                "voitures"=>$voiture
            ));
    }

}