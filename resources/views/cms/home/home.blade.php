@extends('cms.dashboard')

@section('content')
<div class="container">
   <div class="row">
       @forelse ($reservations as $reservation)
           <div class="col-md-4 mb-4">
               <div class="card" style="width: 18rem;">
                   <div class="card-body">
                       <h5 class="card-title">{{ $reservation->name }}</h5>
                       <h6 class="card-text">{{ $reservation->mobile }}</h6>
                       <p class="card-text">{{ timeFormatter($reservation->start) }} - {{ timeFormatter($reservation->end) }}</p>
                       <p class="card-text">{{ $reservation->thePhotographer->name }}</p>
                       <a href="#" class="btn btn-primary"
                           onclick="window.location.href='{{ avenue_route('reservations.show', ['reservation' => $reservation->id]) }}'">Go
                           to Details</a>
                   </div>
               </div>
           </div>
       @empty
           <div class="col-12">
               <h1>There are no Reservations for Today</h1>
           </div>
       @endforelse
   </div>
</div>
@endsection
