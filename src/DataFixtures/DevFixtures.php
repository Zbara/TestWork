<?php

namespace App\DataFixtures;

use App\Entity\Dev;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpKernel\KernelInterface;


class DevFixtures extends Fixture
{
    protected $projectDir;

    public function __construct(KernelInterface $kernel)
    {
        $this->projectDir = $kernel->getProjectDir();
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 5; $i++){
            $image = $faker->imageUrl(400,600); //fake image address
            $filename = time().mt_rand(0,1000).'.jpg'; //new file name for thumb
            $thumbPath = $this->projectDir  . '/public/photo/thumb/'.$filename; //real path for new thumb
            $imagePath = $this->projectDir  . '/public/photo/'.$filename; //real path for new image

            Image::make($image)->save($imagePath); //save new image
            Image::make($imagePath)->fit(50,75)->save($thumbPath); //save new thumb

            $dev = new Dev();
            $dev->setName($faker->name(32));
            $dev->setPosition($faker->jobTitle);
            $dev->setCreatedAt($faker->dateTime($max = 'now'));
            $dev->setEditTime($faker->dateTime($max = 'now'));
            $dev->setSalary(mt_rand(100*100,80000*100)/100);
            $dev->setPhoto( $filename );
            $dev->setChief(mt_rand(1,1000));

            $manager->persist($dev);
        }

        $manager->flush();
    }
}
