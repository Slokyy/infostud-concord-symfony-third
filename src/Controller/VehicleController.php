<?php

  namespace App\Controller;

  use App\Entity\Driver;
  use App\Entity\Vehicle;
  use App\Form\VehicleType;
  use App\Repository\DriverRepository;
  use App\Repository\VehicleRepository;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  #[Route('/vehicles', name: 'vehicles-')]
  class VehicleController extends AbstractController
  {
    #[Route('/', name: 'all')]
    public function index(VehicleRepository $vehicleRepository, Request $request): Response
    {
      $vehicle = new Vehicle();
      $form = $this->createForm(VehicleType::class, $vehicle);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
      {
        $form->getData();
        $vehicleRepository->add($vehicle);

        return $this->redirectToRoute($request->get('_route'), $request->query->all());
      }

      $vehicles = $vehicleRepository->findAll();
      return $this->render("vehicles/vehicles.html.twig", [
        'vehicles' => $vehicles,
        'form' => $form->createView()
      ]);
    }



    #[Route('/history/{id}', name: 'history')]
    public function showVehicleDriverHistory($id, DriverRepository $driverRepository, VehicleRepository $vehicleRepository)
    {
      $vehicle = $vehicleRepository->find($id);
      if ($vehicle->getReservations() !== null) {
        $vehicleReservations = $vehicle->getReservations();
      } else {
        $vehicleReservations = "No Reservations";
      }
      $drivers = $driverRepository->findAll();

      return $this->render('vehicles/history.html.twig', [
        'drivers' => $drivers,
        'vehicle' => $vehicle,
        'vehicleReservations' => $vehicleReservations
      ]);
    }
  }
