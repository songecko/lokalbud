<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Odiseo\Bundle\LokalBuddyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use FOS\OAuthServerBundle\Model\ClientManagerInterface;
use Sylius\Component\Core\Model\UserInterface;
use OAuth2\OAuth2;
use Sylius\Bundle\ApiBundle\Model\Client;
use Sylius\Bundle\FixturesBundle\DataFixtures\DataFixture;

/**
 * Api fixtures.
 *
 * @author Michał Marcinkowski <michal.marcinkowski@lakion.com>
 */
class LoadApiData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        // create user with API role
        $user = $this->createUser(
            'api@example.com',
            'api',
            true,
            array('ROLE_API')
        );

        $manager->persist($user);
        $manager->flush();

        $clientManager = $this->getClientManager();

        /** @var Client $client */
        $client = $clientManager->createClient();
        $client->setRandomId('demo_client');
        $client->setSecret('secret_demo_client');
        $client->setAllowedGrantTypes(
            array(
                OAuth2::GRANT_TYPE_USER_CREDENTIALS,
                OAuth2::GRANT_TYPE_IMPLICIT,
                OAuth2::GRANT_TYPE_REFRESH_TOKEN,
                OAuth2::GRANT_TYPE_AUTH_CODE,
                OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS,
            )
        );
        $clientManager->updateClient($client);
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool   $enabled
     * @param array  $roles
     * @param string $currency
     *
     * @return UserInterface
     */
    protected function createUser($email, $password, $enabled = true, array $roles = array('ROLE_USER'), $currency = 'EUR')
    {
        /* @var $user UserInterface */
        $user = $this->getUserRepository()->createNew();
        $user->setFirstname($this->faker->firstName);
        $user->setLastname($this->faker->lastName);
        $user->setUsername($email);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setRoles($roles);
        $user->setCurrency($currency);
        $user->setEnabled($enabled);

        return $user;
    }

    /**
     * @return ClientManagerInterface
     */
    private function getClientManager()
    {
        return $this->container->get('fos_oauth_server.client_manager.default');
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
