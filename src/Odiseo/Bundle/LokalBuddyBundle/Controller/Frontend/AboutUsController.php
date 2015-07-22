<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutUsController extends Controller
{
    public function mainAction()
    {
    	return $this->render('OdiseoLokalBuddyBundle:Frontend/AboutUs:main.html.twig');
    }   
    public function termsAction()
    {
    	return $this->render('OdiseoLokalBuddyBundle:Frontend/AboutUs:terms.html.twig');
    }   
}