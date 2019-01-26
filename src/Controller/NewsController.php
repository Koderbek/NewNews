<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news")
 */
class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news_index", methods={"GET"})
     */
    public function index(): Response
    {
        $url = "https://news.yandex.ru/politics.rss";
        $content = file_get_contents($url);

        $items = new \SimpleXMLElement($content);
        $items = $items->channel->item;

        foreach ($items as $item){
            $item->description = str_replace('&quot;', '', $item->description);
        }

        return $this->render('news/index.html.twig', [
            'items' => $items,
        ]);
    }

//    /**
//     * @Route("/new", name="news_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $news = new News();
//        $form = $this->createForm(NewsType::class, $news);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($news);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('news_index');
//        }
//
//        return $this->render('news/new.html.twig', [
//            'news' => $news,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="news_show", methods={"GET"}, requirements={"id"="\d+"})
//     */
//    public function show(News $news): Response
//    {
//        return $this->render('news/show.html.twig', [
//            'news' => $news,
//        ]);
//    }
//
//    /**
//     * @Route("/{id}/edit", name="news_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, News $news): Response
//    {
//        $form = $this->createForm(NewsType::class, $news);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('news_index', [
//                'id' => $news->getId(),
//            ]);
//        }
//
//        return $this->render('news/edit.html.twig', [
//            'news' => $news,
//            'form' => $form->createView(),
//        ]);
//    }
}
