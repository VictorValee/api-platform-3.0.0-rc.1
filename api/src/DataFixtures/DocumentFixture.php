<?php

namespace App\DataFixtures;

use App\Entity\Document;
use App\Entity\DocumentType;
use App\Entity\Hackathon;
use App\Repository\DocumentTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class DocumentFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $documentRepository = $manager->getRepository(DocumentType::class);
        $hackathonRepository = $manager->getRepository(Hackathon::class);

        $hackathons = $hackathonRepository->findAll();
        $types = $documentRepository->findAll();

        for ($i=0; $i < 50; $i++) {
            //find a random Hackathons
            $hackathon = $hackathons[array_rand($hackathons)];
            $document = new Document();
            $document->setName('Document ' . $i);
            $document->setFile('file' . $i);
            $document->setType($types[rand(0, count($types) - 1)]);
            $document->setHackathon($hackathon);
            $manager->persist($document);
            $hackathon->addDocument($document);
            $manager->persist($hackathon);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeFixture::class,
            HackathonFixture::class,
        ];
    }
}
