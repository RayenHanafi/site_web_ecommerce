<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Google_Client;

class GoogleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/connect/google', name: 'connect_google', methods: ['POST'])]
    public function connectGoogle(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $credential = $content['credential'] ?? null;

        if (!$credential) {
            return new JsonResponse(['error' => 'No credential provided'], 400);
        }

        // Initialize Google Client
        $client = new Google_Client(['client_id' => $_ENV['GOOGLE_CLIENT_ID']]);

        try {
            // Verify the token
            $payload = $client->verifyIdToken($credential);

            if ($payload) {
                $email = $payload['email'];
                $name = $payload['name'];
                $googleId = $payload['sub'];

                // Check if user exists
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

                if (!$user) {
                    // Create new user
                    $user = new User();
                    $user->setEmail($email);
                    $user->setUsername($name);
                    $user->setGoogleId($googleId);
                    $user->setPassword(''); // Set a random password or handle it according to your needs
                    
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                }

                // Log the user in
                $token = new UsernamePasswordToken($user, 'main', $user->getRoles());
                $this->container->get('security.token_storage')->setToken($token);

                return new JsonResponse([
                    'success' => true,
                    'redirect' => $this->generateUrl('home')
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Authentication failed'], 401);
        }

        return new JsonResponse(['error' => 'Invalid token'], 401);
    }
} 