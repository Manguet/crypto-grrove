<?php

namespace App\Controller\Security;

use App\Form\UserForm;
use App\Interfaces\Authentication\WaxAccountInterface;
use App\Services\File\FileUploader;
use App\Traits\File\FileUploaderTrait;
use App\Traits\Option\MusicActivatedTrait;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    use FileUploaderTrait;
    use MusicActivatedTrait;

    public function __construct(private WaxAccountInterface $waxAccount, private EntityManagerInterface $entityManager,
                                private FileUploader $fileUploader) {}

    #[Route('/register', name: 'register')]
    public function register(Request $request): JsonResponse
    {
        if (empty($userAccount = $this->waxAccount->checkUserAccount($request))) {
            return new JsonResponse('No data send from Wallet', 400);
        }

        if ($this->waxAccount->getUserAccount($userAccount))
        {
            return new JsonResponse('success', 200);
        }

        $this->waxAccount->createNewAccount($userAccount);

        return new JsonResponse('success', 200);
    }


    /**
     * @throws NonUniqueResultException
     */
    #[Route('/login', name: 'login')]
    public function login(Request $request): Response
    {
        $user = $this->waxAccount->connectUserByWaxWallet(
            $this->waxAccount->checkUserAccount($request)
        );

        $this->addFlash(
            'notice',
            'Welcome ' . $user->getPseudo()
        );

        return $this->redirectToRoute('index_homepage');
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute('index');
    }

    #[Route('/space', name: 'space')]
    public function space(Request $request, HttpClientInterface $client): Response|AccessDeniedException
    {
        if (!$user = $this->getUser()) {
            return $this->createAccessDeniedException();
        }

        $form = $this->createForm(UserForm::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->insertFilePath($user, 'avatarName');
            $this->entityManager->flush();

            return $this->redirectToRoute('user_space');
        }

        return $this->render('my-space.html.twig', [
            'form'           => $form->createView(),
            'user'           => $user,
            'musicActivated' => $this->isMusicActivated($this->getUser())
        ]);
    }
}