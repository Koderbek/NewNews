<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 28.07.2018
 * Time: 21:39
 */

namespace App\Controller;

use App\Entity\DayInformation;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // получить ошибку входа, если она есть
        $error = $authUtils->getLastAuthenticationError();
        // последнее имя пользователя, введенное пользователем
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     *
     * @Route("/logout/", name="logout")
     */
    public function logout()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $information = $em->getRepository(DayInformation::class)->findOneByUser($user->getId());
        $information->setUsd(null);
        $information->setEur(null);
        $information->setWeather(null);

        $em->flush();

        return $this->redirectToRoute('login');
    }
}