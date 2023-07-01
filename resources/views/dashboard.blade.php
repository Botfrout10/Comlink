@extends('layouts.pagesapp', ['class' => 'bg-gradient-primary'])

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/panzoom.css">
    <style>
        .fancybox-slide--iframe .fancybox-content {
            max-width: 80%;
            max-height: 80%;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    @include('layouts.headers.cards')

    @if (auth()->user()->admin)
        @if (!$comms->first())
        @else
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col-xl mb-5 mb-xl-0">
                        <div class="card shadow">
                            <div class="card-header bg-transparent mb-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-dark ls-1 mb-1">Overview</h6>
                                        <h2 class="text-dark mb-0">Stats des commerciaux</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart-appel-comms" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl mb-5 mb-xl-0">
                        <div class="card bg-gradient shadow">
                            <div class="card-header bg-transparent mb-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="text-dark mb-0">Meilleurs nombres durant la derniere semaines</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 mb-5 mb-xl-0">
                                        <div class="card bg-gradient shadow">
                                            <div class="card-header bg-transparent mb-0">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        @php
                                                            $cn_appel = $comms->first()->nbr_appel;
                                                            foreach ($comms as $comm) {
                                                                if ($comm->nbr_appel > $cn_appel) {
                                                                    $cn_appel = $comm->nbr_appel;
                                                                }
                                                            }
                                                            $comm_appel = $comms->where('nbr_appel', $cn_appel)->first();
                                                        @endphp
                                                        <h2 class="text-dark mb-0">Selon nbr des appels:
                                                            <span class="text-primary fw-bold">
                                                                {{ $comm_appel->name }}
                                                            </span>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="chart-comms-appel" style="height: 300px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5 mb-xl-0">
                                        <div class="card bg-gradient shadow">
                                            <div class="card-header bg-transparent mb-0">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        @php
                                                            $cn_rdv = $comms->first()->nbr_rdv;
                                                            foreach ($comms as $comm) {
                                                                if ($comm->nbr_rdv > $cn_rdv) {
                                                                    $cn_rdv = $comm->nbr_rdv;
                                                                }
                                                            }
                                                            $comm_rdv = $comms->where('nbr_rdv', $cn_rdv)->first();
                                                        @endphp
                                                        <h2 class="text-dark mb-0">Selon nbr des RDVs :
                                                            <span class="text-primary fw-bold">
                                                                {{ $comm_rdv->name }}
                                                            </span>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div id="chart-comms-rdv" style="height: 300px; width: 100%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-12 mb-5 mb-xl-0">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0">Commerciaux</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">N° d'appel</th>
                                            <th scope="col">N° de RDV</th>
                                            <th scope="col">% RDV/Appel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comms as $comm)
                                            <tr>
                                                <td>{{ $comm->name }}</td>
                                                <td>
                                                    @if ($comm->nbr_appel != 0)
                                                        {{ $comm->nbr_appel }}
                                                    @else
                                                        Aucune appel effectue
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($comm->nbr_rdv != 0)
                                                        {{ $comm->nbr_rdv }}
                                                    @else
                                                        Aucun RDV accroche
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($comm->nbr_appel != 0)
                                                        {{ number_format(($comm->nbr_rdv / $comm->nbr_appel) * 100, 2) }}
                                                    @else
                                                        Aucune appel effectue
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card bg-gradient shadow">
                        <div class="card-header bg-transparent mb-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-dark ls-1 mb-1">Selon semaine</h6>
                                    <h2 class="text-dark mb-0">Nbr des appels {{ $comm->name }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart-comm-appel" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card bg-gradient shadow">
                        <div class="card-header bg-transparent mb-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-dark ls-1 mb-1">Selon semaine</h6>
                                    <h2 class="text-dark mb-0">Nbr des RDVs {{ $comm->name }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart-comm-rdv" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    {{-- Script for charts --}}
    @if (auth()->user()->admin)
        <script>
            const chart = new Chartisan({
                el: '#chart-appel-comms',
                url: "@chart('nbr_appel_commercial')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip(),
            });
            const chart1 = new Chartisan({
                el: '#chart-comms-appel',
                url: "@chart('nbr_rdv_commercial')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .datasets([{
                        type: 'line',
                        smooth: true,
                        fill: false
                    }, 'bar'])
                    .tooltip()
                    .axis({
                        xAxis: [{
                            type: 'category',
                            axisLine: {
                                show: true,
                            },
                        }, ],
                    }),
            });
            const chart2 = new Chartisan({
                el: '#chart-comms-rdv',
                url: "@chart('nbr_rdv_comm')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .datasets([{
                        type: 'line',
                        smooth: true,
                        fill: false
                    }, 'bar'])
                    .tooltip()
                    .axis({
                        xAxis: [{
                            type: 'category',
                            axisLine: {
                                show: true,
                            },
                        }, ],
                    }),
            });
        </script>
    @else
        <script>
            const chart = new Chartisan({
                el: '#chart-comm-appel',
                url: "@chart('nbr_rdv_commercial')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .datasets([{
                        type: 'line',
                        smooth: true,
                        fill: false
                    }, 'bar'])
                    .tooltip()
                    .axis({
                        xAxis: [{
                            type: 'category',
                            axisLine: {
                                show: true,
                            },
                        }, ],
                    }),
            });
            const chart1 = new Chartisan({
                el: '#chart-comm-rdv',
                url: "@chart('nbr_rdv_comm')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .datasets([{
                        type: 'line',
                        smooth: true,
                        fill: false
                    }, 'bar'])
                    .tooltip()
                    .axis({
                        xAxis: [{
                            type: 'category',
                            axisLine: {
                                show: true,
                            },
                        }, ],
                    }),
            });
        </script>
    @endif
@endpush
