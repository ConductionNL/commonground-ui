<?php

// src/Controller/DefaultController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
	/**
	 * @Route("/")
	 * @Template
	 */
	public function indexAction(Request $request)
	{
		return [];
	}
	
	/**
	 * @Route("/login")
	 * @Template
	 */
	public function loginAction(Request $request, EntityManagerInterface $em)
	{
		return [];
	}
	
	
	/**
	 * @Route("/logout")
	 * @Template
	 */
	public function logoutAction(Request $request, EntityManagerInterface $em)
	{
		return [];
	}
	
	/**
	 * @Route("/{slug}")
	 * @Template
	 */
	public function viewAction(Request $request, $slug)
	{
		return [];
	}
	
}
