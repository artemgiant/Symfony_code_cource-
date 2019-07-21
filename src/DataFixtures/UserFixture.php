<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->createMany(10,"main_users",function ($i){
            $user = new User();
            $user->setEmail(sprintf('user%d@test.com',$i));
            $user->setFirstName($this->faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword($user,'test'));
            if($this->faker->boolean){
                $user->setTwitterUsername($this->faker->userName);
            }
            return $user;

        });
        $this->createMany(3,"main_admin",function ($i){
            $user = new User();
            $user->setEmail(sprintf('admin%d@test.com',$i));
            $user->setFirstName($this->faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword($user,'test'));
            $user->setRoles(['ROLE_ADMIN']);
            return $user;

        });

        $manager->flush();
    }
}
