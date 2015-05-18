<?php

namespace Odiseo\Bundle\UserBundle\Controller\Frontend;

use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;

class SecurityController extends BaseSecurityController
{
    public function loginModalAction()
    {
        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->container->get('templating')->renderResponse('OdiseoUserBundle:Frontend/Security:loginModal.html.twig', array(
            'csrf_token' => $csrfToken,
        ));
    }
    
    protected function renderLogin(array $data)
    {
    	$template = sprintf('OdiseoUserBundle:Frontend/Security:login.html.%s', $this->container->getParameter('fos_user.template.engine'));
    
    	return $this->container->get('templating')->renderResponse($template, $data);
    }
}
