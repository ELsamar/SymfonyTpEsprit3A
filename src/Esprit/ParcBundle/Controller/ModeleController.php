<?php

namespace Esprit\ParcBundle\Controller;

use Esprit\ParcBundle\Entity\Modele;
use Esprit\ParcBundle\Form\ModeleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ModeleController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function listAction()
    {
        //creer une instance de l'entiteer manager
        $em = $this -> getDoctrine()-> getManager();
        $modeles = $em -> getRepository("EspritParcBundle:Modele")
            ->findAll(); //recuperer tout les modeles
        //$modeles de type tableau d'objet
        return $this->render('@EspritParc/Modele/list.html.twig'
            ,array(
            "modeles"=> $modeles
        ));
    }
    public function supprimerAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $modele = $em -> getRepository("EspritParcBundle:Modele")->find($id);
        //$modele de type objet
        $em ->remove($modele);
        $em ->flush();
        return $this->redirectToRoute('esprit_listModele');
    }
    public function addAction(Request $request)
    {
        $Modele = new Modele();
        $form = $this->createForm( ModeleType::class,$Modele);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           // echo 'suite au click sur le bouton submit';
            $em = $this->getDoctrine()->getManager();
            $em->persist($Modele);
            $em->flush();
            return $this->redirectToRoute( 'esprit_listModele');
        }
        return $this->render('@EspritParc/Modele/add.html.twig'
            ,array(
                "Form"=>$form->createView()
            ));
    }
    public function updateAction(Request $request){
        $id = $request ->get('id');
        $em = $this->getDoctrine()->getManager();
        $Modele = $em->getRepository('EspritParcBundle:Modele')
        ->find($id);
        $form = $this->createForm(ModeleType::class,$Modele);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($Modele);
            $em->flush();
            return $this->redirectToRoute('esprit_listModele');
    }
        return $this->render('@EspritParc/Modele/update.html.twig'
            ,array(
                "Form"=>$form->createView()
            ));
    }
    public function add2Action(Request $request){
        $Modele = new Modele();
        //if est obligtoire puisque la methode au 1ere est get
        if ($request->isMethod('post')){
            $libelle = $request->get('libelle');
            $pays =$request->get('pays');
            $Modele->setLibelle($libelle);
            $Modele->setPays($pays);
            $em= $this->getDoctrine()->getManager();
            $em->persist($Modele);
            $em->flush();
            return $this->redirectToRoute('esprit_listModele');
        }
        return $this->render('@EspritParc/Modele/add2.html.twig');
    }

    public function findByPaysAction($pays)
    {

        //creer une instance de l'entiteer manager
        $em = $this -> getDoctrine()-> getManager();
        $modeles = $em -> getRepository("EspritParcBundle:Modele")
            ->findByPays($pays); //recuperer tout les modeles
        //$modeles de type tableau d'objet
        return $this->render('@EspritParc/Modele/list.html.twig'
            ,array(
                "modeles"=> $modeles
            ));
    }
    public function findByPays2Action($pays)
    {
        $em=$this->getDoctrine()->getManager();
        $modele=$em->getRepository("EspritParcBundle:Modele")->findByPaysParametre($pays);
        return($this->render("@EspritParc/Modele/list.html.twig"
        ,
            array(
                "modeles"=>$modele
            )));

    }
}

