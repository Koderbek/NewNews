<?php

namespace App\Controller;

use App\Entity\NewsCategory;
use App\Form\NewsCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news-category")
 */
class NewsCategoryController extends AbstractController
{
    /**
     * @Route("/", name="news_category_index", methods={"GET"})
     */
    public function index(): Response
    {
        $newsCategories = $this->getDoctrine()
            ->getRepository(NewsCategory::class)
            ->findAll();

        return $this->render('news_category/index.html.twig', [
            'news_categories' => $newsCategories,
        ]);
    }

    /**
     * @Route("/new", name="news_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newsCategory = new NewsCategory();
        $form = $this->createForm(NewsCategoryType::class, $newsCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsCategory);
            $entityManager->flush();

            return $this->redirectToRoute('news_category_index');
        }

        return $this->render('news_category/new.html.twig', [
            'news_category' => $newsCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_category_show", methods={"GET"})
     */
    public function show(NewsCategory $newsCategory): Response
    {
        return $this->render('news_category/show.html.twig', [
            'news_category' => $newsCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="news_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NewsCategory $newsCategory): Response
    {
        $form = $this->createForm(NewsCategoryType::class, $newsCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_category_index', [
                'id' => $newsCategory->getId(),
            ]);
        }

        return $this->render('news_category/edit.html.twig', [
            'news_category' => $newsCategory,
            'form' => $form->createView(),
        ]);
    }
}
