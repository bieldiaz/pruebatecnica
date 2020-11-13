<?php

namespace App\Controller\Api;

use App\Form\Type\MachineFormType;
use App\Entity\Machine;
use App\Repository\MachineRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class MachinesController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/machines")
     * @Rest\View(serializerGroups={"machine"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(MachineRepository $machineRepository)
    {
        return $machineRepository->findAll();
    }

    /**
     * @Rest\Post(path="/machines")
     * @Rest\View(serializerGroups={"machine"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(EntityManagerInterface $em, Request $request)
    {
        $machine = new Machine();
        $form = $this->createForm(MachineFormType::class, $machine);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($machine);
            $em->flush();
            return $machine;
        }

        return $form;
    }
}
