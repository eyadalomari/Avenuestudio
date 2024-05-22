<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservations;
use App\Models\Types;
use App\Models\Statuses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservations::with(['status', 'type'])
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('CMS.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;

        $statuses = Statuses::leftJoin('statuses_labels', function ($join) use ($language_id) {
            $join->on('statuses.status_id', '=', 'statuses_labels.status_id')
                ->where('statuses_labels.language_id', '=', $language_id);
        })
            ->select('types.*', 'types_labels.*');
        $types = Types::leftJoin('types_labels', function ($join) use ($language_id) {
            $join->on('types.type_id', '=', 'types_labels.type_id')
                ->where('types_labels.language_id', '=', $language_id);
        })
            ->select('types.*', 'types_labels.*');

        $users = User::all();

        return view('CMS.reservations.create', compact('types', 'statuses', 'users'));
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $dateConflict = Reservations::where(function ($query) use ($request) {
            $query->where('status_id', 1)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                        ->orWhere(function ($query) use ($request) {
                            $query->where('start_date', '<=', $request->start_date)
                                ->where('end_date', '>=', $request->end_date);
                        });
                });

            if ($request->has('reservation_id')) {
                $query->where('reservation_id', '!=', $request->get('reservation_id'));
            }
        })->first();

        if ($dateConflict) {
            return redirect()->back()->withErrors([
                'overlap' => 'Time period overlaps with an existing reservation for ' . $dateConflict->name . ' (' . $dateConflict->mobile . ') from ' . dateTimeFormatter($dateConflict->start_date) . ' to ' . dateTimeFormatter($dateConflict->end_date)
            ])->withInput();
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
                'start_date' => $request->get('start_date'),
                'end_date' => $request->get('end_date'),
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
                'start_date'  => $request->get('start_date'),
                'end_date'  => $request->get('end_date'),
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

        return view('CMS.reservations.view', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;

        $statuses = Statuses::join('statuses_labels as sl', function ($join) use ($language_id) {
            $join->on('statuses.status_id', '=', 'sl.status_id')
                 ->where('sl.language_id', '=', $language_id);
        })
        ->get();
    

        $types = types::join('types_labels as tl', function ($join) use ($language_id) {
            $join->on('types.type_id', '=', 'tl.type_id')
                 ->where('tl.language_id', '=', $language_id);
        })
        ->get();

        $users = User::all();

        $reservation = Reservations::with(['status', 'type'])->findOrFail($id);

        return view('CMS.reservations.create', compact('types', 'statuses', 'users', 'reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
