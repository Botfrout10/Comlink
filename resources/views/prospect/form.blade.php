@extends('layouts.pagesapp', ['class' => 'bg-gradient-primary'])


@section('css')
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
                                        <li class="breadcrumb-item"><a href="#">Prospect Info</a>
                                        </li>
                                        {{-- <li class="breadcrumb-item"><a href="#">Prospect</a></li> --}}
                                    </ol>
                                </nav>
                            @else
                                <h6 class="h2 text-white d-inline-block mb-0">Workspace</h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i
                                                    class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Prospect</a></li>
                                        <li class="breadcrumb-item"><a href="#">Edit Prospect</a></li>
                                    </ol>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="container">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Success! </strong>{{ session('status') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('er'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('er') }}<br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @if (auth()->user()->admin)
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Prospect Management</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="#" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h6 class="heading-small text-muted mb-4">Prospect information</h6>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-Organisation">Organisation</label>
                                        <input type="text" name="organisation" id="input-Organisation"
                                            class="form-control form-control-alternative"
                                            value="{{ __($pros->organisation) }}" autofocus="" disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-nom_pros">Nom du
                                            prospect</label>
                                        <input type="text" name="nom_pros" id="input-nom_pros"
                                            class="form-control form-control-alternative" value="{{ __($pros->nom) }}"
                                            disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-prenom_pros">Prenom du
                                            prospect</label>
                                        <input type="text" name="prenom_pros" id="input-prenom_pros"
                                            class="form-control form-control-alternative" value="{{ __($pros->prenom) }}"
                                            disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <input type="text" name="address" id="input-Address"
                                            class="form-control form-control-alternative" value="{{ __($pros->address) }}"
                                            disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="email" name="email" id="input-email"
                                            class="form-control form-control-alternative" value="{{ __($pros->email) }}"
                                            disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-tel">Telephone</label>
                                        <input type="tel" name="tel" id="input-tel"
                                            class="form-control form-control-alternative" value="{{ __($pros->tel) }}"
                                            disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-remarque">Remarque</label>
                                        <input type="text" name="remarque" id="input-remarque"
                                            class="form-control form-control-alternative"
                                            value="{{ __($pros->remarque) }}" disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-date_pcontact">Date premier
                                            contact</label>
                                        <input type="datetime-locale" name="date_pcontact" id="input-date_pcontact"
                                            class="form-control form-control-alternative"
                                            value="{{ __($pros->date_premier_contact) }}" disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-source_pros">Source de
                                            prospect</label>
                                        <input type="text" name="source_pros" id="input-source_pros"
                                            class="form-control form-control-alternative"
                                            value="{{ __($pros->source_prospect) }}" disabled readonly>
                                    </div>
                                    {{-- <div class="form-group">
                                            <label class="form-control-label" for="input-name">Profile photo</label>
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input " id="input-picture"
                                                    accept="image/*">
                                                <label class="custom-file-label text-truncate" for="input-picture">Select
                                                    profile
                                                    photo</label>
                                            </div>
                                        </div> --}}
                                    {{-- <div class="form-group">
                                            <label class="form-control-label" for="input-role">Admin concerned</label>
                                            <select name="admin_id" id="input-role" class="form-control" required="">
                                                <option value="">-</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Prospect Actions</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status_act">Statut actuel</label>
                                    <select class="form-control form-control-alternative" name="status_act" id="status_act"
                                        disabled readonly>
                                        <option value="{{ $pros->status_act }}" selected hidden>
                                            {{ strtoupper($pros->status_act) }}</option>
                                    </select>
                                </div>
                                @php
                                    if ($actions) {
                                        $i = 1;
                                        foreach ($actions as $action) {
                                            echo '<div class="form-group">
                                                                            <label class="form-control-label" for="input-action1">Action ' .
                                                $i .
                                                '</label>
                                                                            <input type="text" name="action" id="input-action1" class="form-control form-control-alternative"
                                                                                value="' .
                                                                    $action->action .
                                                                    '" disabled readonly>
                                                                        </div>';
                                            $i++;
                                        }
                                    }
                                @endphp

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Prospect Management</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ route('prospect.index') }}" class="btn btn-sm btn-primary">Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="#" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <h6 class="heading-small text-muted mb-4">Prospect information</h6>
                                    <div class="pl-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-Organisation">Organisation</label>
                                            <input type="text" name="organisation" id="input-Organisation"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->organisation) }}" autofocus="" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-nom_pros">Nom du prospect</label>
                                            <input type="text" name="nom_pros" id="input-nom_pros"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->nom) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-prenom_pros">Prenom du
                                                prospect</label>
                                            <input type="text" name="prenom_pros" id="input-prenom_pros"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->prenom) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Address</label>
                                            <input type="text" name="address" id="input-Address"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->address) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email</label>
                                            <input type="email" name="email" id="input-email"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->email) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-tel">Telephone</label>
                                            <input type="tel" name="tel" id="input-tel"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->tel) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-remarque">Remarque</label>
                                            <input type="text" name="remarque" id="input-remarque"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->remarque) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-date_pcontact">Date premier
                                                contact</label>
                                            <input type="datetime-locale" name="date_pcontact" id="input-date_pcontact"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->date_premier_contact) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-source_pros">Source de
                                                prospect</label>
                                            <input type="text" name="source_pros" id="input-source_pros"
                                                class="form-control form-control-alternative"
                                                value="{{ __($pros->source_prospect) }}" disabled readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_act">Statut actuel</label>
                                            <select class="form-control form-control-alternative" name="status_act"
                                                id="status_act" disabled readonly>
                                                <option value="{{ $pros->status_act }}" selected hidden>
                                                    {{ strtoupper($pros->status_act) }}</option>
                                            </select>
                                        </div>
                                        @php
                                            if ($actions) {
                                                $i = 1;
                                                foreach ($actions as $action) {
                                                    echo '<div class="form-group">
                                                                                                <label class="form-control-label" for="input-action1">Action ' .
                                                        $i .
                                                        '</label>
                                                                                                <input type="text" name="action" id="input-action1" class="form-control form-control-alternative"
                                                                                                value="' .
                                                                $action->action .
                                                                '" disabled readonly>
                                                                                                </div>';
                                                    $i++;
                                                }
                                            }
                                        @endphp
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h3 class="mb-0">Prospect Management</h3>
                                            </div>
                                            <div class="col text-right">
                                                <a href="{{ route('calender') }}" class="btn btn-default btn-sm"
                                                    data-fancybox data-type="iframe" data-preload="false" data-width="640"
                                                    data-height="600">
                                                    <i class="ni ni-calendar-grid-58 text"></i>
                                                    <span class="text">Confirmed RDV</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('prospect.update_form', $pros->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <h6 class="heading-small text-muted mb-4">Prospect information</h6>
                                            <div class="pl-lg-4">
                                                <div class="form-group">
                                                    <label for="statut_act">Statut actuel</label>
                                                    <select class="form-control form-control-alternative"
                                                        onchange="statut_toogle()" name="status_act" id="statut_act" required>
                                                        <option value="Relance">
                                                            {{ strtoupper('Relance') }}</option>
                                                        <option value="RDV">
                                                            {{ strtoupper('RDV') }}</option>
                                                        <option value="pas interesse">
                                                            {{ strtoupper('pas interesse') }}
                                                        </option>
                                                        <option value="aucune reponse">
                                                            {{ strtoupper('aucune reponse') }}
                                                        </option>
                                                        <option value="" selected hidden></option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-action">Next
                                                        action</label>
                                                    <input class="form-control form-control-alternative" name="next_act"
                                                        type="text" id="input-action" required>
                                                </div>
                                                {{-- rdv_stat --}}
                                                <div class="d-none">
                                                    <label for="statut_act">Statut actuel</label>
                                                    <select class="form-control form-control-alternative" name="status_rdv" id="rdv_stat" required>
                                                        <option value="En attente" selected>
                                                            {{ strtoupper('en attente') }}</option>
                                                        <option value="envoie du devis">
                                                            {{ strtoupper('envoie du devis') }}</option>
                                                        <option value="projet en cours">
                                                            {{ strtoupper('projet en cours') }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" id="savebtn"
                                                        class="btn btn-success mt-4">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="col-8">
                                            <h3 class="mb-0">Script d'Appel</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if (isset($script_appel))
                                            <textarea class="form-control form-control-alternative" id="" cols="30" rows="10" style="resize: none;" disabled
                                                readonly>{{ $script_appel }}</textarea>
                                        @else
                                            <div class="alert alert-danger fade show" role="alert">
                                                <span class="alert-text"><strong>Danger!</strong> Script d'Appel
                                                    n'existe pas!</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function statut_toogle() {
            var select = document.getElementById("statut_act");
            var sa = select.options[select.selectedIndex].value;
            var na = document.getElementById("input-action");
            if (sa == "Relance") {
                na.setAttribute('type', "datetime-local");
            }
            if (sa == "RDV") {
                na.setAttribute('type', "datetime-local");
            }
            if (sa == "pas interesse") {
                na.setAttribute('type', "text");
            }
            if (sa == "aucune reponse") {
                na.setAttribute('type', "text");
            }
        }
        // function rdv_toogle() {
        //     var select2 = document.getElementById("statut_act");
        //     var sa1 = select2.options[select2.selectedIndex].value;
        //     var na1 = document.getElementById("status_rdv");
        //     console.log(select2);
        //     if (sa1 == "RDV") {
        //         console.log(1);
        //         na1.setAttribute('class', null);
        //     }
        // }
        // document.getElementById("statut_act").onchange=rdv_toogle();
    </script>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/clipboard/dist/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
@endpush
