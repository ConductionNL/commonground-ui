<?php

// src/Controller/DefaultController.php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/organization")
 */
class OrganizationController extends AbstractController
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
     * @Route("/{slug}")
     * @Template
     */
    public function viewAction(Request $request, $slug)
    {
        return [];
    }
}
