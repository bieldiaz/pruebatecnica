<?php

namespace App\Controller;


use App\Entity\Machine;
use App\Repository\MachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MachineController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/", name="index")
     * 
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'MachineController',
        ]);
    }

    /**
     * @Route("/machines", name="machine_list")
     * 
     */
    public function list(Request $request, MachineRepository $machineRepository)
    {
        $response = new JsonResponse();
        $machines = $machineRepository->findAll();
        $machinesAsArray = [];
        foreach ($machines as $machine) {
            $machinesAsArray[] = [
                'id' => $machine->getId(),
                'brand' => $machine->getBrand(),
                'model' => $machine->getModel(),
                'manufacturer' => $machine->getManufacturer(),
                'price' => $machine->getPrice(),
                'images' => $machine->getImages()
            ];
        };
        $response->setData([
            'success' => true,
            'data' => $machinesAsArray
        ]);
        return $response;
    }

    /**
     * @Route("/machine/create", name="create_machine")
     * 
     */
    public function createBook(Request $request, EntityManagerInterface $em)
    {
        $machine = new Machine();
        $response = new JsonResponse();
        $brand = $request->get('brand', null);
        if (empty($brand)) {
            $response->setData([
                'success' => false,
                'error' => 'Title cannot be empty',
                'data' => null
            ]);
            return $response;
        };

        $machine->setBrand($brand);
        $em->persist($machine);
        $em->flush();
        $response->setData([
            'success' => true,
            'data' => [
                'id' => $machine->getId(),
                'brand' => $machine->getBrand()

            ]
        ]);

        return $response;
    }
}
