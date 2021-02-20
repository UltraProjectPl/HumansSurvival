<?php

namespace App\Controller;

use App\Entity\Human;
use App\Repository\HumanRepository;
use App\Service\AgeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private HumanRepository $humanRepository;

    private AgeService $ageService;

    public function __construct(HumanRepository $humanRepository, AgeService $ageService)
    {
        $this->humanRepository = $humanRepository;
        $this->ageService = $ageService;
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

    /**
     * @Route("/human/{id}", name="humanParent")
     */
    public function showParents(Human $human): Response
    {
        dump($this->ageService->getAllAncestors($human));

        return $this->json('success');
    }

    /**
     * @Route("/human/{id1}/{id2}", name="kinship")
     */
    public function isKinship(int $id1, int $id2): Response
    {
        $human1 = $this->humanRepository->find($id1);
        $human2 = $this->humanRepository->find($id2);

        dump($this->ageService->kinship($human1, $human2));

        return $this->json('success');
    }
}
