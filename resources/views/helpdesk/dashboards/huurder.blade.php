@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Helpdesk</h1>
        
        <div class="page-subtitle">Stel hier je vraag omtrent het domein of verhuur</div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <helpdesk-sidenav></helpdesk-sidenav>
        </div>

        <div class="col-9">
            <div class="col-12"> {{-- Information content --}}
                @if (Auth::user()->hasRole('huurder'))
                    <div class="alert alert-info shadow-sm mb-4 alert-dismissible fade show"> {{-- Info notice --}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <p>
                            Om u een goede opvolging of assistentie aan te bieden hebben wij een helpdesk in het leven geroepen waarop u al uw vragen kunt stellen.
                            Naar aanloop van je verhuring of wanneer je aanwezig bent in onze lokalen. Zodat wij jouw snel al je problemen, opmerkingen of vragen kunnen beantwoorden.
                        </p>

                        <hr>

                        <p class="font-weight-bold mb-0">
                            <i class="fe fe-alert-circle mr-1"></i>
                            Voor dringende zaken tijdens een verhuring kunt u ons best telefonisch contacteren.
                        </p>
                    </div> {{-- End info notice --}}
                @endif

                <form method="POST" action="" class="card card-body mb-3 py-3 shadow-sm">
                    @csrf {{-- Form field protection --}}
                    <h6 class="border-bottom border-gray pb-1 mb-3">Ik heb een vraag of opmerking!</h6>

                    <div class="form-row">
                        <div class="col-8">
                            <input @input('titel') type="text" class="form-control @error('title', 'is-invalid')"id="inputTitel" placeholder="Titel *">
                            @error('titel')
                        </div>
                        <div class="col-4">
                            <select @input('category') class="form-control @error('category', 'is-invalid')">
                                @options($categories, 'category')
                            </select>

                            @error('category') {{-- Validation error view partial --}}
                        </div>
                    </div>
                </form>
            </div> {{-- /// EINDE informatie content --}}
        </div>
    </div>
@endsection