<?php

namespace App\DataFixtures;

use App\Entity\Astrologers;
use App\Entity\AstrologersServices;
use App\Entity\Services;
use App\Repository\AstrologersRepository;
use App\Repository\ServicesRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const LOREM = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
     Excepturi quas rem rerum vel voluptates!
     Ab accusamus animi atque eaque eius fuga in incidunt laboriosam libero modi repudiandae sunt voluptatem,
     voluptates.';

    private const ASTROLOGERS = [
        'Люсі',
        'Бен',
        'Барбара',
        'Кевін',
        'Сюзі',
        'Емма'
    ];

    private const SERVICES = [
        'Натальна карта',
        'Детальний гороскоп',
        'Звіт сумісності',
        'Гороскоп на рік'
    ];

    private const DEFAULT_STATUS = true;

    private const DEFAULT_IMG = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTu9zuWJ0xU19Mgk0dNFnl2KIc8E9Ch0zhfCg&usqp=CAU';

    public function load(ObjectManager $manager): void
    {

        $dateNow = new DateTime;

        foreach (self::ASTROLOGERS as $astrologer) {
            $personalInfo = 'Im good astrologer, my name is - ' . $astrologer;
            $email = $astrologer . '@test.com';

            $astrologers = new Astrologers();
            $astrologers->setName($astrologer);
            $astrologers->setBio(self::LOREM);
            $astrologers->setPersonal($personalInfo);
            $astrologers->setEmail($email);
            $astrologers->setImage(self::DEFAULT_IMG);
            $astrologers->setStatus(self::DEFAULT_STATUS);
            $astrologers->setCreated($dateNow);
            $astrologers->setUpdated($dateNow);

            $manager->persist($astrologers);
        }

        foreach (self::SERVICES as $service) {
            $services = new Services();
            $services->setName($service);
            $services->setStatus(self::DEFAULT_STATUS);
            $services->setCreated($dateNow);
            $services->setUpdated($dateNow);

            $manager->persist($services);
        }


        $manager->flush();

        $astrologers = $manager->getRepository(Astrologers::class)->findAll();
        $services = $manager->getRepository(Services::class)->findAll();
        $servicesCount = count($services);

        $serviceIterator = 0;

        foreach ($astrologers as $astrologer) {
            $serviceBreaker = rand(1, $servicesCount);

            foreach($services as $service) {
                if ($serviceBreaker === $serviceIterator) break;

                $astrologersService = new AstrologersServices();
                $astrologersService->setAstrologer($astrologer);
                $astrologersService->setService($service);
                $astrologersService->setPrice(rand(10, 100));
                $astrologersService->setCreated($dateNow);
                $astrologersService->setUpdated($dateNow);

                $manager->persist($astrologersService);

                ++$serviceIterator;
            }

            $serviceIterator = 0;
        }


        $manager->flush();

    }
}
