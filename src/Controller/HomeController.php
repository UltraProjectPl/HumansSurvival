<?php

namespace App\Controller;

use App\Repository\HumanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private HumanRepository $humanRepository;

    public function __construct(HumanRepository $humanRepository)
    {
        $this->humanRepository = $humanRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $humans = $this->humanRepository->findAll();

        return $this->render('home/all_human.html.twig', [
            'humans' => $humans,
        ]);
    }
}
