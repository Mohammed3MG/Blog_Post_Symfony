<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Blogs;
use App\Form\BlogPostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/blog')]
class BlogController extends AbstractController
{

    #[Route('/')]
    public function index(): Response
    {
//      $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        return $this->render('blog/index.html.twig', [
            'foo'=>'bar',
            'user' => $user,
        ]);
    }

    #[Route('/create')]
public function create(Request $request, EntityManagerInterface $entityManager, \Symfony\Bundle\SecurityBundle\Security $security ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $blogs=new Blogs();
        $form = $this->createForm(BlogPostType::class, $blogs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $security->getUser();

            dd($user);
            $blogs->setBlogUser($user);
            $entityManager->persist($blogs);
            $entityManager->flush();

            return $this->redirectToRoute('app_blog_index');
        }

        return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
