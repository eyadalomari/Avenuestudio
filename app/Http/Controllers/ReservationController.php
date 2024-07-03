<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use App\Repositories\ReservationRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;

class ReservationController extends AdminController
{
    private $reservationRepository;
    private $statusRepository;
    private $typeRepository;
    private $userRepository;

    public function __construct(
        ReservationRepository $reservationRepository,
        StatusRepository $statusRepository,
        TypeRepository $typeRepository,
        UserRepository $userRepository
    ) {
        parent::__construct();
        $this->reservationRepository = $reservationRepository;
        $this->statusRepository = $statusRepository;
        $this->typeRepository = $typeRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['keyword', 'status_id', 'type_id', 'photographer', 'from_date', 'to_date']);
        $reservations = $this->reservationRepository->list($filters);

        $statuses = $this->statusRepository->getAllStatuses();
        $types = $this->typeRepository->getAllTypes();
        $users = $this->userRepository->getUsersByRole('photographer');

        return view('cms/reservations/index', compact('reservations', 'statuses', 'types', 'users'));
    }

    public function create()
    {
        $statuses = $this->statusRepository->getAllStatuses();
        $types = $this->typeRepository->getAllTypes();
        $users = $this->userRepository->getUsersByRole('photographer');

        return view('cms/reservations/create', compact('types', 'statuses', 'users'));
    }

    public function store(ReservationRequest $request)
    {
        $overlap = $this->reservationRepository->isTimeOverlap();
        if ($overlap) {
            return redirect()->back()->withErrors(['overlap' => 'Time overlap detected with an existing reservation (#' . $overlap->id . ')'])->withInput();
        }

        $this->reservationRepository->store();

        return redirect(avenue_route('reservations.index'))->with('success', 'Reservation saved successfully.');
    }

    public function show(string $id)
    {
        $reservation = $this->reservationRepository->findById($id);

        return view('cms/reservations/view', compact('reservation'));
    }

    public function edit(string $id)
    {
        $statuses = $this->statusRepository->getAllStatuses();
        $types = $this->typeRepository->getAllTypes();
        $users = $this->userRepository->getUsersByRole('photographer');

        $reservation = $this->reservationRepository->findById($id);

        if (isset($reservation) && $reservation->status->code != 'active') {
            return redirect(avenue_route('reservations.index'));
        }

        return view('cms/reservations/create', compact('types', 'statuses', 'users', 'reservation'));
    }
}
