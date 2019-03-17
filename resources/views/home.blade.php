@extends('layouts.app')

@section('content')
   <div class="row">
        @if (session('status')) {{-- Nodig voor bepaalde handelingen zoals het resetten van een wachtwoord --}}
            <div class="col-12">
                <div class="alert alert-success">
                    <small>{{ session('status') }}</small>
                </div>
            </div>
        @endif

        <dashboard-widgets :users="$users"></dashboard-widgets>

       <div class="col-12 mb-4"> {{-- Lease overview table --}}
           <div class="card shadow-sm border-0 card-body">
               <h6 class="border-bottom broder-gray pb-1 mb-3">
                   <span class="text-sgv-brown">Nieuwe aanvragen</span>

                   <a href="" class="float-right small text-sgv-green-dark text-decoration-none">
                       <i class="fe fe-calendar mr-1"></i> Volledig overzicht
                   </a>
               </h6>
           </div>
       </div> {{-- /// End lease table --}}

       <div class="col-12">
           <div class="card card-body shadow-sm border-0">
               <h6 class="border-bottom broder-gray pb-1 mb-3">
                   <span class="text-sgv-brown">Mijn helpdesk tickets</span>

                   <a href="" class="float-right small text-sgv-green-dark text-decoration-none">
                       <i class="fe fe-info mr-1"></i> Volledig overzicht
                   </a>
               </h6>
           </div>
       </div>
    </div>        

@endsection
