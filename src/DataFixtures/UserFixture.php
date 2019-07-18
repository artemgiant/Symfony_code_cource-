<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->createMany(10,"main_users",function ($i){
            $user = new User();
            $user->setEmail(sprintf('user%d@test.com',$i));
            $user->setFirstName($this->faker->firstName);

            return $user;

        });

        $manager->flush();
    }
}
