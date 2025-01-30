@extends('cms.dashboard')

@section('content')
<div class="container">
   <div class="row align-items-center">
       @forelse ($reservations as $reservation)
           <div class="col-md-4 mb-4">
               <div class="card" style="width: 18rem;">
                   <div class="card-body">
                       <h5 class="card-title">{{ $reservation->name }}</h5>
                       <h6 class="card-subtitle mb-2 text-muted">{{ $reservation->mobile }}</h6>
                       <p class="card-text">{{ timeFormatter($reservation->start) }} - {{ timeFormatter($reservation->end) }}</p>
                       <p class="card-text">{{ $reservation->thePhotographer->name }}</p>
                       <a href="#" class="btn btn-primary"
                           onclick="window.location.href='{{ avenue_route('reservations.show', ['reservation' => $reservation->id]) }}'">
                           {{ __('common.details') }}</a>
                   </div>
               </div>
           </div>
       @empty
           <div class="col-12 d-flex justify-content-center align-items-center" style="height: 100vh;">
               <h1>{{ __('common.no_reservations_scheduled_for_today') }}</h1>
           </div>
       @endforelse
   </div>
</div>
@endsection
