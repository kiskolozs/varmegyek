@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-home"></i> {{ __('Vármegye') }}</h3>
                        <form method="post" action="{{ route('searchVarmegyek') }}" class="form-inline">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="needle" class="form-control" placeholder="Keresés">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Megnevezés</th>
                                        <th>Művelet <a href="{{route('createVarmegye')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entities as $entity)
                                        <tr>
                                            <td>{{ $entity->id }}</td>
                                            <td>{{ $entity->name }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <form method="post" action="{{ route('editVarmegye', $entity->id) }}">
                                                        <button class="btn btn-sm btn-warning" type="submit">
                                                            <i class="fas fa-edit"></i> Módosítás
                                                        </button>
                                                        @csrf
                                                    </form>
                                                    <form method="post" action="{{ route('deleteVarmegye', $entity->id) }}">
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="fas fa-trash"></i> Törlés
                                                        </button>
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
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
    </div>
@endsection
