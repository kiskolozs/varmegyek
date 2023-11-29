@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="post" action="{{ route('updateVarmegye', $entity->id) }}" accept-charset="UTF-8">
                    @csrf
                    @method('patch')
                    <div class="card-header">{{ __('Vármegye módosítása') }} (#{{$entity->id}})</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name"><strong>Név</strong></label>
                            <input type="text" class="form-control" name="name" value="{{ $entity->name }}" required>
                        </div>
                    </div>

                    <div class="card-footer row justify-content-between">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;{{__('Mentés')}}</button>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-secondary" href="{{ route('varmegyek') }}#{{$entity->id}}"><i class="fa fa-ban"></i>&nbsp;{{__('Mégse')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
