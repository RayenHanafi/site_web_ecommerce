<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RegistrationController extends AbstractController
{
private $registrationService;

public function __construct(RegistrationService $registrationService)
{
$this->registrationService = $registrationService;
}

#[Route('/register', name: 'app_register')]
public function register(Request $request, SessionInterface $session): Response
{
$user = new User();
$form = $this->createForm(RegistrationFormType::class, $user);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
try {
// Register the user
$this->registrationService->register($user, $form->get('password')->getData());

// Add a flash message
$this->addFlash('success', 'Registration successful! Please log in.');

return $this->redirectToRoute('app_login');
} catch (\Exception $e) {
$this->addFlash('error', 'Registration failed. Please try again.');
}
}

return $this->render('registration/register.html.twig', [
'registrationForm' => $form->createView(),
]);
}
}
