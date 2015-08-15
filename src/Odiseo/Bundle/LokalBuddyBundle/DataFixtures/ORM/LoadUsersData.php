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
use Odiseo\Bundle\UserBundle\Model\User;
use Symfony\Component\Finder\Finder;
use Odiseo\Bundle\LokalBuddyBundle\Entity\UserProfile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

        //Others users
        $othersUsers = array(
        	array(
        		'username' => 'user1',
        		'email' => 'usuarioA@example.com'        		
        	),
        	array(
        		'username' => 'user2',
        		'email' => 'usuarioB@example.com'
        	)
        );
        
        foreach ($othersUsers as $userData)
        {
        	$user = $this->createUser(
        		$userData['email'],
        		'123456',
        		true
        	);
        	$user->setUsername($userData['username']);
        	$this->addReference($userData['username'], $user);
        	$manager->persist($user);
        }
        
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
        
        //User profile
        $profile = new UserProfile();
        $profile->setPhone($this->faker->phoneNumber);
        
        //Profile picture
        $imageFinder = new Finder();        
        $imagesPath = __DIR__.'/../../Resources/fixtures/user';
        $pictures = iterator_to_array($imageFinder->files()->in($imagesPath), false);

        if($pictures && count($pictures) > 0)
        {
        	$img = $pictures[0];        	
        	$profile->setPictureFile(new UploadedFile($img->getRealPath(), $img->getFilename()));
        }
        
        $user->setMainProfile($profile);

        return $user;
    }
}
