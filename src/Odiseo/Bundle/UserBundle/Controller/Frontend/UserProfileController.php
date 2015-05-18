<?php

namespace Odiseo\Bundle\UserBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ProfileController as BaseProfileController;

class UserProfileController extends BaseProfileController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->container->get('templating')->renderResponse('OdiseoUserBundle:Frontend/Profile:show.html.'.$this->container->getParameter('fos_user.template.engine'), array('user' => $user));
    }
}
