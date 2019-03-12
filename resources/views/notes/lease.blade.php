@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Verhuur kalender</h1>

        <div class="page-subtitle">
            Informatie overzicht
        </div>

            <div class="page-options d-flex">
                <a href="{{ route('calendar.index') }}" class="btn tw-rounded btn-sgv-green">
                    <i class="fe mr-1 fe-calendar"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    

           <div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

@endsection