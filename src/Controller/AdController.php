<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Upload;
use App\Form\TelechergeType;
use App\Repository\AdRepository;
use App\Repository\UploadRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ad_index")
     */
    public function index(AdRepository $per)
    {
    	/*$per = $this->getDoctrine()->getRepository(Ad::class);*/
    	$personne = $per->findAll() ;
        return $this->render('ad/index.html.twig', [
            'personne' => $personne,
        ]);
    }


    /**
    *@Route("ads/newPers", name="new_ad")
    */
    public function new(Request $request){
        $ad = new Ad;

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($ad);
                    $manager->flush();

                    return $this->redirectToRoute('ad_index');
                }        
 
        return $this->render('ad/new.html.twig',
            ['form'=>$form->createView()]
    );
    }

     /**
    *@Route("/ads/{id}", name="get_id")
    *
    *return Response
    */
    public function getId($id, AdRepository $getId){
        $post = $getId->findOneById($id);
        return $this->render('ad/show.html.twig',['personne'=>$post]);
    }

    /**
    *@Route("/delete/{id}", name="delete_id")
    */
    public function deleteId(Ad $ad){
        $getId = $this->getDoctrine()->getManager();
        $getId->remove($ad);
        $getId->flush();
        return $this->redirectToRoute('ad_index');
   }


    /**
     * @Route("/{id}/edit", name="edit_id")
     */
    public function edit(Request $request, Ad $ad)
    {
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/trois", name="threeLast")
     */
    public function troisDernier(AdRepository $get3Last){
        $post = $get3Last->getThreeLast();
        return $this->render('ad/showThree.html.twig',['personne'=>$post]);
    }

    /**
     * @Route("/upload", name="uploadFile")
     */
    public function upload(Request $request){
        $upload = new Upload;

        $form = $this->createForm(TelechergeType::class, $upload);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                    $file = $upload->getTelechergeFichier();
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($this->getParameter('upload_directory'), $fileName);
                    $upload->setTelechergeFichier($fileName);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($upload);
                    $em->flush();
                    
                    return $this->redirectToRoute('ad_index');
                }        
 
        return $this->render('ad/telecharge.html.twig',
            ['form'=>$form->createView()]
    );
    }


    /**
     * @Route("/showFile", name="showFile")
     */
    public function showAllFile(UploadRepository $per){
        $personne = $per->findAll() ;
        return $this->render('ad/showFile.html.twig', [
            'personne' => $personne,
        ]);
    }


}
/*$ this -> addFlash ( 'notice' , 'Post Submitted Successfully!!!' );*/