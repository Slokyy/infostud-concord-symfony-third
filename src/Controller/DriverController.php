<?php

  namespace App\Controller;

  use App\Entity\Driver;
  use App\Entity\Reservation;
  use App\Form\DriverType;
  use App\Form\ReservationType;
  use App\Repository\DriverRepository;
  use App\Repository\ReservationRepository;
  use App\Repository\VehicleRepository;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  #[Route('/', name: 'drivers-')]
  class DriverController extends AbstractController
  {
    #[Route('/', name: 'all')]
    public function index(DriverRepository $driverRepository, Request $request): Response
    {
      $drivers = $driverRepository->findAll();

      $driver = new Driver();
      $form = $this->createForm(DriverType::class, $driver);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
      {
        $form->getData();
        $driverRepository->add($driver);

        return $this->redirectToRoute($request->get('_route'), $request->query->all());
      }


      foreach($drivers as $driver) {
        $latestDriverVehicle = $driverRepository->findLatestReservedVehicle($driver->getId());
        if($latestDriverVehicle->getReservations()[0] !== null)
        {
          $vehicle = $latestDriverVehicle->getReservations()[0]->getVehicle();
          $vehicleBrand = $vehicle->getBrand();
          $vehicleModel = $vehicle->getModel();
          $vehicleFullModel = $vehicleBrand . " " . $vehicleModel;
          $driver->lastVehicle = $vehicleFullModel;

        } else {
          $driver->lastVehicle = "No reservation history";
        }

      }

      return $this->render('base.html.twig',[
        'drivers' => $drivers,
        'form' => $form->createView()
      ]);
    }

    #[Route('/driver/show/{id}', name: 'find')]
    public function findDriver($id, DriverRepository $driverRepository, VehicleRepository $vehicleRepository, ReservationRepository $reservationRepository, Request $request): Response
    {
      $driver = $driverRepository->find($id);

      $vehicles = $vehicleRepository->findAll();

      $reservation = new Reservation();
      $form = $this->createForm(ReservationType::class, $reservation);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()) {
        $form->getData();
        $reservation->setDriver($driver);
        $reservationRepository->add($reservation);

        return $this->redirectToRoute('drivers-all',[]);
      }
      return $this->render('drivers/profile.html.twig',[
        'driver' => $driver,
        'vehicles' => $vehicles,
        'form' => $form->createView()
      ]);
    }

    #[Route('/driver/history/{id}', name: 'history')]
    public function showDriverVehicleHistory($id, DriverRepository $driverRepository, VehicleRepository $vehicleRepository)
    {
      $driver = $driverRepository->find($id);

      if($driver->getReservations() !== null) {
        $driverReservations = $driver->getReservations();
      } else {
        $driverReservations = "No reservations";
      }
      $vehicles = $vehicleRepository->findAll();

      return $this->render('drivers/history.html.twig',[
        'driver' => $driver,
        'driverReservations' => $driverReservations,
        'vehicles' => $vehicles
      ]);
    }

  }
