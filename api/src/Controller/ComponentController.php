<?php

// src/Controller/DefaultController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/component")
 */
class ComponentController extends AbstractController
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
	 * @Route("/quickadd")
	 * @Template
	 */
	public function quickaddAction(Request $request)
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
