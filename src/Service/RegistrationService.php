<?php
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService
{
private $passwordHasher;
private $entityManager;

public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
{
$this->passwordHasher = $passwordHasher;
$this->entityManager = $entityManager;
}

public function register(User $user, string $plainPassword): void
{
    // Hash the password
    $user->setPassword(
        $this->passwordHasher->hashPassword($user, $plainPassword)
    );

    // Set default role (very important!)
    $user->setRoles(['ROLE_USER']);

    // Save to database
    $this->entityManager->persist($user);
    $this->entityManager->flush();
}

}
