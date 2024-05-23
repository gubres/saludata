<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
        $adminUser->setEmail('admin@example.com');
        $adminUser->setNombre('Admin');
        $adminUser->setApellidos('User');
        $adminUser->setRoles(['ROLE_ADMIN']);

        // Hash de la contraseña
        $hashedPassword = $this->passwordHasher->hashPassword($adminUser, '123456');
        $adminUser->setPassword($hashedPassword);

        $adminUser->setEliminado(false);
        $adminUser->setIsActive(true);
        $adminUser->setCreadoEn(new \DateTime());
        $adminUser->setActualizadoEn(new \DateTime());

        // Persistir usuario
        $manager->persist($adminUser);
        $manager->flush();
    }
}
