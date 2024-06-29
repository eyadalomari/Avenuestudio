<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\TypeI18n;
use App\Models\Status;
use App\Models\StatusI18n;
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

        $reservations = Reservation::list($filters);

        /* ===================================================================== //
        $reservations = Reservation::with([
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
        $statuses = StatusI18n::where('language_id', $language_id)->get();
        $types = TypeI18n::where('language_id', $language_id)->get();
        $users = User::getUsersWithRole('photographer');

        return view('cms/reservations/index', compact('reservations', 'statuses', 'types', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $statuses = StatusI18n::where('language_id', $language_id)->get();
        $types = TypeI18n::where('language_id', $language_id)->get();
        $users = User::getUsersWithRole('photographer');

        return view('cms/reservations/create', compact('types', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $overlap = $this->isTimeOverlap($request->date, $request->start, $request->end, $request->id);
        if ($overlap) {
            return redirect()->back()->withErrors(['overlap' => 'Time overlap detected with an existing reservation (#' . $overlap->id . ')'])->withInput();
        }



        if ($request->has('id')) {
            $reservation = Reservation::findOrFail($request->id);
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
                'updated_by' => Auth::user()->id,
            ]);

            return redirect(avenue_route('reservations.index'))->with('success', 'Reservation updated successfully.');
        } else {
            Reservation::create([
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
                'added_by'  => Auth::user()->id,
                'updated_by'  => Auth::user()->id,
            ]);

            return redirect(avenue_route('reservations.index'))->with('success', 'Reservation created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with(['status', 'type'])->findOrFail($id);

        return view('cms/reservations/view', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $statuses = StatusI18n::where('language_id', $language_id)->get();
        $types = TypeI18n::where('language_id', $language_id)->get();
        $users = User::getUsersWithRole('photographer');

        $reservation = Reservation::with(['status', 'type'])->findOrFail($id);

        if (isset($reservation) && $reservation->status->code != 'active') {
            return redirect(avenue_route('reservations.index'));
        }

        return view('cms/reservations/create', compact('types', 'statuses', 'users', 'reservation'));
    }

    private function isTimeOverlap($date, $start, $end, $id = null)
    {
        $query = Reservation::where('date', $date)->where(function ($query) use ($start, $end) {
            $query->where(function ($query) use ($start, $end) {
                $query->where('start', '<=', $start)
                    ->where('end', '>', $start);
            })->orWhere(function ($query) use ($start, $end) {
                $query->where('start', '<', $end)
                    ->where('end', '>=', $end);
            })->orWhere(function ($query) use ($start, $end) {
                $query->where('start', '>=', $start)
                    ->where('end', '<=', $end);
            });
        });

        $active_status = Status::where('code', 'active')->firstOrFail()->id;
        $query->where('status_id', '=', $active_status);

        if (isset($id)) {
            $query->where('id', '!=', $id);
        }

        return $query->first();
    }
}
