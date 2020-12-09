<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController{

	/**
	*@Route("/hello/{prenom}", name="hellopage")
	*/
	public function hello($prenom=""){
		return $this->render(
			'hello.html.twig',
			['prenom'=>$prenom]
		);
	}

    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        return $this->render(
            'home.html.twig',
            ['title'=>'kez kez']
        );
    }
}

?>