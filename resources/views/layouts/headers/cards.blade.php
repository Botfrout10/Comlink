@if (auth()->user()->admin)
    @if ($comms->first() == null)
        <div class="container-fluid mt-7">
            <div class="row">
                <div class="col-xl mb-5 mb-xl-0">
                    <div class="alert alert-danger " role="alert">
                        <h4 class="alert-heading">ATTENTION</h4>
                        <p>You need to add commercials to your accounts, please check that you had commercials befor
                            doing
                            anythings.</p>
                        <hr>
                        <p class="mb-0 small">If you can't resolve this probleme please contact your IT manager.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="header bg-gradient-primary mb-6 pb-6 pt-4">
            <div class="container-fluid">
                <div class="header-body">
                    @php
                        $res = DB::select('SELECT name, SUM(nbr_rdv / nbr_appel) perc FROM commercials WHERE admin_id=? GROUP BY name ORDER BY perc DESC', [
                            $comms
                                ->first()
                                ->admin()
                                ->first()->id,
                        ]);
                        $best_comm = $res[0];
                        $worst_comm = $res[count($res) - 1];
                    @endphp
                    <div class="row-2 mb-2">
                        {{-- Modal button --}}
                        <button type="button" onload="" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#modal-notification">Notification</button>
                        {{-- modal --}}
                        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog"
                            aria-labelledby="modal-notification" aria-hidden="true">
                            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                <div class="modal-content bg-warning">

                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-notification">Notification
                                        </h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body pb-6">

                                        {{-- <div class="nav-wrapper">
                                                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Home</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Profile</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                                                <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                                                                <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.</p>
                                                            </div>
                                                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                                                <p class="description">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                                            </div>
                                                            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                                        </div>
                                                    </div>
                                                </div> --}}

                                        <div class="py-3 text-center">
                                            <i class="ni ni-bell-55 ni-3x"></i>
                                            <div class="row mt-5">
                                                <div class="col-6">
                                                    <h4 class="heading mt-4">THE BEST COMMERCIAL IS
                                                        {{ $best_comm->name }}
                                                    </h4>
                                                    <p>
                                                        {{ $best_comm->name }} reached a great
                                                        number.<br> <span class="fw-bold text-underline">RDV/Appel :
                                                            {{ number_format($best_comm->perc*100, 2) }}%
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    <h4 class="heading mt-4">THE Worst COMMERCIAL IS
                                                        {{ $worst_comm->name }}
                                                    </h4>
                                                    <p>
                                                        {{ $worst_comm->name }} did a bad job. <br>
                                                        <span class="fw-bold text-underline"> RDV/Appel :
                                                            {{ number_format($worst_comm->perc*100, 2) }}%</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- <div class="modal-footer">
                                                <button type="button" class="btn btn-white">Ok, Got
                                                    it</button>
                                                <button type="button" class="btn btn-link text-white ml-auto"
                                                    data-dismiss="modal">Close</button>
                                            </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-2 mb-2">
                        <a class="btn btn-default btn-sm" href="{{ route('calender') }}" data-fancybox
                            data-type="iframe" data-preload="false" data-width="640" data-height="480">
                            Tous les RDVs
                        </a>
                    </div>
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Appels</h5>
                                            <span class="h2 font-weight-bold mb-0">
                                                @php
                                                    $total_na = 0;
                                                    foreach ($comms as $comm) {
                                                        $total_na += $comm->nbr_appel;
                                                    }
                                                    echo $total_na;
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        @if ($weekly_na > 0)
                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                                {{ number_format($weekly_na, 2) }}%</span>
                                        @elseif ($weekly_na < 0)
                                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                                {{ number_format(-$weekly_na, 2) }}%</span>
                                        @elseif ($weekly_na == 0)
                                            <span class="text-gray mr-2">-
                                                {{ number_format($weekly_na, 2) }}%</span>
                                        @endif
                                        <span class="text-nowrap">Since yesterday</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">RDV</h5>
                                            <span class="h2 font-weight-bold mb-0">
                                                @php
                                                    if ($comms) {
                                                        $total_nr = 0;
                                                        foreach ($comms as $comm) {
                                                            $total_nr += $comm->nbr_rdv;
                                                        }
                                                        echo $total_nr;
                                                    } else {
                                                        echo 'N\'existe pas des Commerciaux';
                                                    }
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                                <i class="fas fa-chart-pie"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        @if ($weekly_nr > 0)
                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                                {{ number_format($weekly_nr, 2) }}%</span>
                                        @elseif ($weekly_nr < 0)
                                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                                {{ number_format(-$weekly_nr, 2) }}%</span>
                                        @elseif ($weekly_nr == 0)
                                            <span class="text-gray mr-2">-
                                                {{ number_format($weekly_nr, 2) }}%</span>
                                        @endif
                                        <span class="text-nowrap">Since yesterday</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">rdv/appel</h5>
                                            <span class="h2 font-weight-bold mb-0">
                                                @if ($total_na != 0)
                                                    {{ number_format(($total_nr / $total_na) * 100, 2) }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                                <i class="fas fa-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        @if ($weekly_nra > 0)
                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                                {{ number_format($weekly_nra, 2) }}%</span>
                                        @elseif ($weekly_nra < 0)
                                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                                {{ number_format(-$weekly_nra, 2) }}%</span>
                                        @elseif ($weekly_nra == 0)
                                            <span class="text-gray mr-2">-
                                                {{ number_format($weekly_nra, 2) }}%</span>
                                        @endif
                                        <span class="text-nowrap">Since yesterday</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">prospects</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $nbr_pros }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        @if ($weekly_np > 0)
                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                                {{ number_format($weekly_np, 2) }}%</span>
                                        @elseif ($weekly_np < 0)
                                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                                {{ number_format(-$weekly_np, 2) }}%</span>
                                        @elseif ($weekly_np == 0)
                                            <span class="text-gray mr-2">-
                                                {{ number_format($weekly_np, 2) }}%</span>
                                        @endif
                                        <span class="text-nowrap">Since yesterday</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="header bg-gradient-primary mb-6 pb-6 pt-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-2">
                        @php
                            $res = DB::select('SELECT name, SUM(nbr_rdv / nbr_appel) perc FROM commercials WHERE admin_id=? GROUP BY name ORDER BY perc DESC', [
                                $comm
                                    ->first()
                                    ->admin()
                                    ->first()->id,
                            ]);
                            $best_comm = $res[0];
                            $worst_comm = $res[count($res) - 1];
                            // dd($res);
                            // SELECT name, SUM(nbr_rdv / nbr_appel) total FROM commercials GROUP BY name ORDER BY total DESC;
                        @endphp
                        @if (auth()->user()->name == $best_comm->name)
                            {{-- Modal button --}}
                            <button type="button" onload="" class="btn btn-sm btn-success mb-3"
                                data-toggle="modal" data-target="#modal-notification-comm">Notification</button>
                            {{-- modal --}}
                            <div class="modal fade" id="modal-notification-comm" tabindex="-1" role="dialog"
                                aria-labelledby="modal-notification-comm" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content bg-success">

                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-notification">Notification</h6>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body pb-6">

                                            <div class="py-3 text-center">
                                                <i class="ni ni-bell-55 ni-3x"></i>
                                                <h4 class="heading mt-4">CONGRATULATION
                                                </h4>
                                                <p>
                                                    {{ $best_comm->name }} You are the best commercial.<br><span
                                                        class="fw-bold text-underline">RDV/Appel :
                                                        {{ number_format($best_comm->perc*100, 2) }}%</span>
                                                </p>

                                            </div>

                                        </div>

                                        {{-- <div class="modal-footer">
                                            <button type="button" class="btn btn-white">Ok, Got
                                                it</button>
                                            <button type="button" class="btn btn-link text-white ml-auto"
                                                data-dismiss="modal">Close</button>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        @elseif (auth()->user()->name == $worst_comm->name)
                            {{-- Modal button --}}
                            <button type="button" onload="" class="btn btn-sm btn-danger mb-3"
                                data-toggle="modal" data-target="#modal-notification-comm">Notification</button>
                            {{-- modal --}}
                            <div class="modal fade" id="modal-notification-comm" tabindex="-1" role="dialog"
                                aria-labelledby="modal-notification-comm" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                    <div class="modal-content bg-danger">

                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-notification">Notification</h6>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body pb-6">

                                            <div class="py-3 text-center">
                                                <i class="ni ni-bell-55 ni-3x"></i>
                                                <h4 class="heading mt-4">BE CAREFULL
                                                </h4>
                                                <p>
                                                    {{ $worst_comm->name }} You are the worst commercial. <br>
                                                    <span class="fw-bold text-underline"> RDV/Appel :
                                                        {{ number_format($worst_comm->perc*100, 2) }}%</span>
                                                </p>

                                            </div>

                                        </div>

                                        {{-- <div class="modal-footer">
                                            <button type="button" class="btn btn-white">Ok, Got
                                                it</button>
                                            <button type="button" class="btn btn-link text-white ml-auto"
                                                data-dismiss="modal">Close</button>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Apples</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if ($comm->nbr_appel != 0)
                                                {{ $comm->nbr_appel }}
                                            @else
                                                Aucune appel effectue
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    @if ($weekly_na > 0)
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                            {{ number_format($weekly_na, 2) }}%</span>
                                    @elseif ($weekly_na < 0)
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                            {{ number_format(-$weekly_na, 2) }}%</span>
                                    @elseif ($weekly_na == 0)
                                        <span class="text-gray mr-2">-
                                            {{ number_format($weekly_na, 2) }}%</span>
                                    @endif
                                    <span class="text-nowrap">Since yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        {{-- <a href="{{ route('calender') }}" data-fancybox data-type="iframe"
                                            data-preload="false" data-width="640" data-height="480">
                                            <h5 class="card-title text-uppercase text-muted mb-0"> <span
                                                    data-toggle="tooltip" data-placement="top" title="Show RDV">nbr
                                                    rdv</span></h5>
                                        </a> --}}
                                        <h5 class="card-title text-uppercase text-muted mb-0">RDV</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if ($comm->nbr_rdv != 0)
                                                {{ $comm->nbr_rdv }}
                                            @else
                                                Aucun RDV accroche
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    @if ($weekly_nr > 0)
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                            {{ number_format($weekly_nr, 2) }}%</span>
                                    @elseif ($weekly_nr < 0)
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                            {{ number_format(-$weekly_nr, 2) }}%</span>
                                    @elseif ($weekly_nr == 0)
                                        <span class="text-gray mr-2">-
                                            {{ number_format($weekly_nr, 2) }}%</span>
                                    @endif
                                    <span class="text-nowrap">Since yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">rdv/appel</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                            @if ($comm->nbr_appel != 0)
                                                {{ number_format(($comm->nbr_rdv / $comm->nbr_appel) * 100, 2) }}
                                            @else
                                                Aucune appel effectue
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    @if ($weekly_nra > 0)
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                            {{ number_format($weekly_nra, 2) }}%</span>
                                    @elseif ($weekly_nra < 0)
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                            {{ number_format(-$weekly_nra, 2) }}%</span>
                                    @elseif ($weekly_nra == 0)
                                        <span class="text-gray mr-2">-
                                            {{ number_format($weekly_nra, 2) }}%</span>
                                    @endif
                                    <span class="text-nowrap">Since yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0 bg-gradient">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">prospects</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $nbr_pros }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    @if ($weekly_np > 0)
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                            {{ number_format($weekly_np, 2) }}%</span>
                                    @elseif ($weekly_np < 0)
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i>
                                            {{ number_format(-$weekly_np, 2) }}%</span>
                                    @elseif ($weekly_np == 0)
                                        <span class="text-gray mr-2">-
                                            {{ number_format($weekly_np, 2) }}%</span>
                                    @endif
                                    <span class="text-nowrap">Since yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
