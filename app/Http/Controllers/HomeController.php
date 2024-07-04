<?php

namespace App\Http\Controllers;

use App\Repositories\ReservationRepository;
use App\Repositories\StatusRepository;
use Carbon\Carbon;

class HomeController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $reservationRepository;
    private $statusRepository;

    public function __construct(
        ReservationRepository $reservationRepository,
        StatusRepository $statusRepository
    ) {
        $this->reservationRepository = $reservationRepository;
        $this->statusRepository = $statusRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $filters = [
            'status_id' => $this->statusRepository->findBycode('active')->id,
            'from_date' => date('Y-m-d'),
            'to_date' => date('Y-m-d')
        ];
        
        $reservations = $this->reservationRepository->list($filters, false);

        return view('cms/home/home', compact('reservations'));
    }
}
