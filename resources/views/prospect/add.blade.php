@extends('layouts.pagesapp', ['class' => 'bg-gradient-primary'])

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                            <h6 class="h2 text-white d-inline-block mb-0">Management</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                                class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Prospect</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Ajout des prospects</a></li>
                                </ol>
                            </nav>
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
                            <span class="alert-text"><strong>Success!</strong>{{ session('status') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('er'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-text">{{ session('er') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->has('file'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text">{{ $errors->first('file') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Prospect Management</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#excelModal">
                                        Import From Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('prospect.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h6 class="heading-small text-muted mb-4">Prospect information</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-Organisation">Organisation</label>
                                        <input type="text" name="organisation" id="input-Organisation"
                                            class="form-control form-control-alternative" required="" autofocus="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-nom_pros">Nom du prospect</label>
                                        <input type="text" name="nom_pros" id="input-nom_pros"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-prenom_pros">Prenom du prospect</label>
                                        <input type="text" name="prenom_pros" id="input-prenom_pros"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <input type="text" name="address" id="input-Address"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="email" name="email" id="input-email"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-tel">Telephone</label>
                                        <input type="tel" name="tel" id="input-tel"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-remarque">Remarque</label>
                                        <input type="text" name="remarque" id="input-remarque"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-date_pcontact">Date premier
                                            contact</label>
                                        <input type="date" name="date_pcontact" id="input-date_pcontact"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-source_pros">Source de prospect</label>
                                        <input type="text" name="source_pros" id="input-source_pros"
                                            class="form-control form-control-alternative" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-role">Commercial concerned</label>
                                        <select name="comm" id="input-role" class="form-control form-control-alternative"
                                            required="">
                                            <option value="">-</option>
                                            @foreach ($comms as $comm)
                                                <option value="{{ $comm->id }}">{{ $comm->name }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choisir le fichier
                        Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('prospect.import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Import Excel
                                File</label>
                            <input class="form-control" name="file" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/clipboard/dist/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
@endpush
