@extends('layouts.pagesapp',['class' => 'bg-gradient-primary'])

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
                                    <li class="breadcrumb-item"><a href="#"></a>Commerciaux</li>
                                    {{-- <li class="breadcrumb-item active" aria-current="page"></li> --}}
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
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
                            {{ session('er') }} <br>
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
                                    <h3 class="mb-0">Liste des commerciaux</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add commercial</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Prospects</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->commercial as $comm)
                                        <tr>
                                            <td>{{ $comm->name }}</td>
                                            <td>
                                                <a href="mailto:{{ $comm->email }}">{{ $comm->email }}</a>
                                            </td>
                                            <td><a href="{{ route('user.show', $comm->id) }}"
                                                    class="btn btn-sm btn-default">Pros</a></td>
                                            <td class="text-sm">
                                                <a href="{{ route('user.edit', $comm->id) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                    <i class="fas fa-user-edit text-default" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('user.destroy', $comm->id) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete user">
                                                    <i class="fas fa-trash text-default" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dark table -->
            {{-- <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Users</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add user</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Prospect</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <a href="mailto:mehdiott10@gmail.com">{{ $user->email }}</a>
                                            </td>
                                            <td>12/02/2020 11:00</td>
                                            <td>{{ $user->admin ? __('Admin') : __('Commercial') }}</td>
                                            <td><a href="{{ route('prospect.show', $user->id) }}"
                                                    class="btn btn-info text-sm">{{ $user->id . ' Pros' }}</a></td>
                                            <td class="text-sm">
                                                <a href="{{ route('user.show', $user) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                    <i class="fas fa-user-edit text-light" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('user.destroy', $user) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Delete user">
                                                    <i class="fas fa-trash text-light" aria-hidden="true"></i>
                                                </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/clipboard/dist/clipboard.min.js"></script>
@endpush
