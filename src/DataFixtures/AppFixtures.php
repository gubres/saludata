<?php

namespace App\DataFixtures;

use DateTimeZone;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Crear usuario admin
        $adminUser = new User();
        $adminUser->setEmail('admin@mail.com');
        $adminUser->setNombre('Admin');
        $adminUser->setApellidos('User');
        $adminUser->setRoles(['ROLE_ADMIN']);

        // Hash de la contraseña
        $hashedPassword = $this->passwordHasher->hashPassword($adminUser, 'Admin123!');
        $adminUser->setPassword($hashedPassword);

        $adminUser->setEliminado(false);
        $adminUser->setIsActive(true);
        $adminUser->setCreadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));
        $adminUser->setActualizadoEn(new \DateTime('now', new DateTimeZone('Europe/Madrid')));

        // Persistir usuario
        $manager->persist($adminUser);
        $manager->flush();
    }
}
