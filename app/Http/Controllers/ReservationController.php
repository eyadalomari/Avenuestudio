<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\TypesLabel;
use App\Models\StatusesLabel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['keyword', 'status_id', 'type_id', 'photographer', 'from_date', 'to_date']);

        $reservations = Reservations::list($filters);

        /* ===================================================================== //
        $reservations = Reservations::with([
            'type' => function ($query) {
                $query->with(['labels' => function ($query2) {
                    $language_id = app()->getLocale() == 'en' ? 1 : 2;
                    $query2->where('language_id', $language_id);
                }]);
            },

            'status' => function ($query) {
                $query->with(['labels' => function ($query2) {
                    $language_id = app()->getLocale() == 'en' ? 1 : 2;
                    $query2->where('language_id', $language_id);
                }]);
            },

        ])->paginate(config('constants.PAGINATION'));
        // ===================================================================== */
        
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $statuses = StatusesLabel::where('language_id', $language_id)->get();
        $types = TypesLabel::where('language_id', $language_id)->get();
        $users = User::getUsersWithRole('photographer');

        return view('cms.reservations.index', compact('reservations', 'statuses', 'types', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $statuses = StatusesLabel::where('language_id', $language_id)->get();
        $types = TypesLabel::where('language_id', $language_id)->get();
        $users = User::getUsersWithRole('photographer');

        return view('cms.reservations.create', compact('types', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'mobile' => 'required|string|max:25',
            'type_id' => 'required|integer',
            'location_type' => 'required|in:indoor,outdoor',
            'price' => 'required|numeric',
            'price_remaining' => 'required|numeric',
            'photographer' => 'required|integer',
            'status_id' => 'required|integer',
            'has_video' => 'required|boolean',
            'date' => 'required|date',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:time_start',
            'note' => 'nullable|string',
        ]);

        $overlap = $this->isTimeOverlap($request->date, $request->start, $request->end, $request->reservation_id);
        if ($overlap) {
            return redirect()->back()->withErrors(['overlap' => 'Time overlap detected with an existing reservation.' . $overlap->reservation_id])->withInput();
        }



        if ($request->has('reservation_id')) {
            $reservation = Reservations::findOrFail($request->reservation_id);
            $reservation->update([
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'type_id' => $request->get('type_id'),
                'location_type' => $request->get('location_type'),
                'price' => $request->get('price'),
                'price_remaining' => $request->get('price_remaining'),
                'photographer' => $request->get('photographer'),
                'status_id' => $request->get('status_id'),
                'has_video' => $request->get('has_video'),
                'date' => $request->get('date'),
                'start' => $request->get('start'),
                'end_date' => $request->get('end'),
                'note' => $request->get('note'),
                'updated_by' => Auth::user()->user_id,
            ]);
        } else {
            Reservations::create([
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'type_id' => $request->get('type_id'),
                'location_type' => $request->get('location_type'),
                'price' => $request->get('price'),
                'price_remaining' => $request->get('price_remaining'),
                'photographer' => $request->get('photographer'),
                'status_id'  => $request->get('status_id'),
                'has_video'  => $request->get('has_video'),
                'date'  => $request->get('date'),
                'start'  => $request->get('start'),
                'end'  => $request->get('end'),
                'note'  => $request->get('note'),
                'added_by'  => Auth::user()->user_id,
                'updated_by'  => Auth::user()->user_id,
            ]);
        }
        return redirect(avenue_route('reservations.index'))->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservations::with(['status', 'type'])->findOrFail($id);

        return view('cms.reservations.view', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $statuses = StatusesLabel::where('language_id', $language_id)->get();
        $types = TypesLabel::where('language_id', $language_id)->get();
        $users = User::getUsersWithRole('photographer');

        $reservation = Reservations::with(['status', 'type'])->findOrFail($id);

        return view('cms.reservations.create', compact('types', 'statuses', 'users', 'reservation'));
    }

    private function isTimeOverlap($date, $start, $end, $ReservationId = null)
    {
        $query = Reservations::where('date', $date)->where(function ($query) use ($start, $end) {
            $query->where(function ($query) use ($start, $end) {
                $query->where('start', '<=', $start)->where('end', '>', $start);
            })->orWhere(function ($query) use ($start, $end) {
                $query->where('start', '<', $end)->where('end', '>=', $end);
            })->orWhere(function ($query) use ($start, $end) {
                $query->where('start', '>=', $start)->where('end', '<=', $end);
            });
        });
    
        if ($ReservationId) {
            $query->where('reservation_id', '!=', $ReservationId);
        }
    
        return $query->first();
    }
    
}
