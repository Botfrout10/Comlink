@extends('layouts.pagesapp', ['class' => 'bg-gradient-primary'])


@section('content')
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-gradient-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            @if (auth()->user()->admin)
                                <h6 class="h2 text-white d-inline-block mb-0">Management</h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                                    class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Prospect</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Table de Prospect</a></li>
                                    </ol>
                                </nav>
                            @else
                                <h6 class="h2 text-white d-inline-block mb-0">Workspace</h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Prospect</a></li>
                                        <li class="breadcrumb-item"><a href="#">Table de Prospect</a></li>
                                    </ol>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            @if (!auth()->user()->admin)
                <div class="alert text-white bg-gradient-warning alert-dismissible fade show" role="alert" id="rdv_alert">
                    <span class="alert-text"><strong>Your rdv for today {{ date('Y-m-d') }}</strong></span>
                    <hr>
                    <p>
                    <ol>
                        @foreach ($pros as $pro)
                            @if ($pro->status_act === 'RDV' && date('Y-m-d', strtotime(substr($pro->action->last()->action, 0, -6))) == date('Y-m-d'))
                                <li>{{ $pro->organisation }} at: <span
                                        class="dispaly-1">{{ substr($pro->action->last()->action, -5) }}</span></li>
                            @endif
                        @endforeach
                    </ol>
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
            @endif
            <div class="row">
                <div class="container">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="rdv_alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Success! </strong>{{ session('status') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('er'))
                        <div class="alert alert-danger alert-dissmissible fade show" role="alert">
                            {{ session('er') }}<br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Prospects</h3>
                                </div>
                                {{-- <div class="col-4 text-right">
                                    <a href="{{  }}" class="btn btn-sm btn-primary">Back to
                                        list</a>
                                </div> --}}
                            </div>
                        </div>
                        @if (auth()->user()->admin)
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-buttons">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Societe</th>
                                            <th scope="col">Etat d'appel</th>
                                            <th scope="col">Date d'appel</th>
                                            <th scope="col">Date Relance</th>
                                            <th scope="col">Compteur d'appel</th>
                                            <th scope="col">Alert</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comm->prospect as $pros)
                                            @php
                                                $act = $pros->action;

                                            @endphp
                                            <tr>
                                                <td>{{ $pros->organisation }}</td>
                                                <td>{{ $pros->status_act }}</td>
                                                @if (isset($act->last()->date_edit))
                                                    <td>{{ $act->last()->date_edit }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if ($pros->status_act === 'RDV' || $pros->status_act === 'Relance')
                                                    @if (isset($act->last()->action))
                                                        <td>{{ $act->last()->action }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                @else
                                                    <td></td>
                                                @endif
                                                {{-- @if ($prospect->action)
                                                @foreach ($prospect->action as $action)
                                                    <td>{{ $action->action }}</td>
                                                @endforeach
                                            @else
                                                <td>Pas encore de relance</td>
                                            @endif --}}
                                                <td>{{ $pros->count_appel }}</td>
                                                <td>
                                                    @php
                                                        $alert = 0;
                                                        if ($pro->status_act === 'RDV' && date('Y-m-d', strtotime(substr($pro->action->last()->action, 0, -6))) == date('Y-m-d')) {
                                                            $alert = 1;
                                                        }
                                                    @endphp
                                                    @if ($alert)
                                                        <span class="text-danger">alert</span>
                                                    @else
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('prospect.show', $pros->id) }}" class="mx-1"
                                                        data-bs-toggle="tooltip" data-bs-original-title="show pros">
                                                        <i class="ni ni-badge" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('prospect.destroy', [$pros->id]) }}" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                        <i class="fas fa-trash text-default" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Societe</th>
                                            <th scope="col">Etat d'appel</th>
                                            <th scope="col">Date d'appel</th>
                                            <th scope="col">Date Relance</th>
                                            <th scope="col">Compteur d'appel</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pros as $prospect)
                                            @php
                                                $act = $prospect->action;
                                                // dd($act->last()->date_edit);
                                            @endphp
                                            <tr>
                                                <td>{{ $prospect->organisation }}</td>
                                                <td>{{ $prospect->status_act }}</td>
                                                @if (isset($act->last()->date_edit))
                                                    <td>{{ $act->last()->date_edit }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if ($prospect->status_act === 'RDV' || $prospect->status_act === 'Relance')
                                                    @if (isset($act->last()->action))
                                                        <td>{{ $act->last()->action }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                @else
                                                    <td></td>
                                                @endif
                                                {{-- @if ($prospect->action)
                                                @foreach ($prospect->action as $action)
                                                    <td>{{ $action->action }}</td>
                                                @endforeach
                                            @else
                                                <td>Pas encore de relance</td>
                                            @endif --}}
                                                <td>{{ $prospect->count_appel }}</td>
                                                <td>
                                                    <a href="{{ route('prospect.show', $prospect->id) }}"
                                                        class="mx-1" data-bs-toggle="tooltip"
                                                        data-bs-original-title="show pros">
                                                        <i class="ni ni-badge" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var a = document.getElementById("rv_check"); //rv_check
            var x = document.getElementById("collapseExample"); //collapseExample
            var y = document.getElementById("collapseExample1"); //collapseExample1
            if (a.checked) {
                x.style.display = "block";
                y.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "none";
            }
        }
    </script>
@endsection
