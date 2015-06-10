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
use Sylius\Bundle\FixturesBundle\DataFixtures\DataFixture;
use Sylius\Component\Core\Model\UserInterface;
use Odiseo\Bundle\UserBundle\Entity\User;

/**
 * User fixtures.
 *
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
class LoadUsersData extends DataFixture
{
    private $usernames = array();

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $rbacInitializer = $this->get('sylius.rbac.initializer');
        $rbacInitializer->initialize();

        $user = $this->createUser(
            'admin@lokalbuddy.com',
            '123456',
            true,
            array('ROLE_SYLIUS_ADMIN')
        );
        $user->setFirstname('LokalBuddy');
        $user->setLastname('Administrator');
        $user->addAuthorizationRole($this->get('sylius.repository.role')->findOneBy(array('code' => 'administrator')));

        $user->setUsername('admin');
        $user->setUsernameCanonical('admin');
        $manager->persist($user);
        $manager->flush();

        $this->setReference('Sylius.User-Administrator', $user);

        for ($i = 1; $i <= 200; $i++) {
            $username = $this->faker->username;

            while (isset($this->usernames[$username])) {
                $username = $this->faker->username;
            }

            $user = $this->createUser(
                $username.'@example.com',
                $username,
                $this->faker->boolean()
            );

            $user->setCreatedAt($this->faker->dateTimeThisMonth);

            $manager->persist($user);
            $this->usernames[$username] = true;

            $this->setReference('Sylius.User-'.$i, $user);
        }

        //Old
        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setUsernameCanonical('user1');
        $user1->setEmail('usuarioA@example.com');
        $user1->setEmailCanonical('usuarioA@example.com');
        $user1->setPlainPassword('123456');
        $user1->setEnabled(true);
        $this->addReference('user1', $user1);
        $manager->persist($user1);
        
        $user2 = new User();
        $user2->setUsername('user2');
        $user2->setUsernameCanonical('user2');
        $user2->setEmail('usuarioB@example.com');
        $user2->setEmailCanonical('usuarioB@example.com');
        $user2->setPlainPassword('123456');
        $user2->setEnabled(true);
        $this->addReference('user2', $user2);
        $manager->persist($user2);
         
        $user3 = new User();
        $user3->setUsername('buyer3');
        $user3->setUsernameCanonical('buyer3');
        $user3->setEmail('buyer3@example.com');
        $user3->setEmailCanonical('buyer3@example.com');
        $user3->setPlainPassword('123456');
        $user3->setEnabled(true);
        $this->addReference('buyer3', $user3);
        $manager->persist($user3);
         
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
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
    protected function createUser($email, $password, $enabled = true, array $roles = array('ROLE_USER'), $currency = 'USD')
    {
        /* @var $user UserInterface */
        $user = $this->getUserRepository()->createNew();
        $user->setFirstname($this->faker->firstName);
        $user->setLastname($this->faker->lastName);
        $user->setEmail($email);
        
        $pos = strrpos($email, '@');
        $username = $pos===false?$email:substr($email, 0, $pos);
        
        $user->setUsername($username);
        $user->setUsernameCanonical($username);
        $user->setPlainPassword($password);
        $user->setRoles($roles);
        $user->setCurrency($currency);
        $user->setEnabled($enabled);

        return $user;
    }
}
