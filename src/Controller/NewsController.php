<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
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
        $user = $this->getUser();
        $categories = $user->getNewsCategories();
        $allItems = [];

        foreach ($categories as $category){
            $categoryName = $category->getEnglishName();

            $url = "https://news.yandex.ru/". $categoryName .".rss";
            $content = file_get_contents($url);

            $items = new \SimpleXMLElement($content);
            $items = $items->channel->item;

            foreach ($items as $item){
                $item->description = str_replace('&quot;', '', $item->description);
                $allItems[] = $item;
            }

        }
        shuffle($allItems);

        return $this->render('news/index.html.twig', [
            'items' => $allItems,
        ]);
    }

    /**
     * @Route("/{category}", name="news_filter", methods={"GET"})
     */
    public function filter(Request $request): Response
    {
        $categoryName = $request->get('category');

        $url = "https://news.yandex.ru/". $categoryName .".rss";
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
}
