<?php

namespace App\Controller;

use App\Entity\DayInformation;
use App\Entity\News;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//include 'phpQuery/phpQuery.php';

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
        $information = $user->getInformation();
        if($information == null){
            $information = new DayInformation();
            $information->setUser($user);
            $this->getDoctrine()->getManager()->persist($information);
        }

        if ($information->getUsd() == null || $information->getEur() == null) {
            $cbrURL = "https://www.cbr-xml-daily.ru/daily_json.js";
            $courseJSON = file_get_contents($cbrURL);
            $courses = json_decode($courseJSON);
            $usd = $courses->Valute->USD->Value;
            $eur = $courses->Valute->EUR->Value;

            $information->setUsd($usd);
            $information->setEur($eur);
            $this->getDoctrine()->getManager()->flush();
        }

        $categories = $user->getNewsCategories();
        $allItems = [];

        foreach ($categories as $category){
            $categoryName = $category->getEnglishName();

            $url = "https://news.yandex.ru/". $categoryName .".rss";
            $content = file_get_contents($url);

            $items = new \SimpleXMLElement($content);
            $items = $items->channel->item;

            foreach ($items as $item){
                $item->description = html_entity_decode($item->description);
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
            $item->description = html_entity_decode($item->description);
            $link = $item->link;
        }

        return $this->render('news/index.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @Route("/show-original/{link}", name="show_original", methods={"GET"})
     */
    public function showOriginal(Request $request): Response
    {
        $link = $request->get('link');
        $link = urldecode($link);

        $html = file_get_contents($link);
        $page = \phpQuery::newDocument($html);
        $href = $page->find('.doc__content')->find('a')->attr('href');

        return $this->redirect($href);
    }
}
