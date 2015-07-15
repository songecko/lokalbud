<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HowWorksController extends Controller
{
    public function mainAction()
    {
    	return $this->render('OdiseoLokalBuddyBundle:Frontend/HowWorks:main.html.twig');
    }   
}