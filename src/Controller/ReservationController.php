<?php

  namespace App\Controller;

  use App\Entity\Reservation;
  use App\Repository\DriverRepository;
  use App\Repository\ReservationRepository;
  use App\Repository\VehicleRepository;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  #[Route('/reservation', name: 'reservations-')]
  class ReservationController extends AbstractController
  {
    #[Route('/', name: 'all')]
    public function index(ReservationRepository $reservationRepository): Response
    {
      $reservations = $reservationRepository->findAll();
//        dd($reservations);
      return $this->render('reservations/reservation.html.twig',
        [
          'reservations' => $reservations
        ]);
    }

  }


