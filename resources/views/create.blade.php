@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form method="post" action="{{ route('saveVarmegye') }}" accept-charset="UTF-8">
                        @csrf
                        <div class="card-header">{{ __('Új Vármegye') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div>
                                <div class="table table-active">
                                    <div>
                                        <div class="row" style="margin-left: 15px;">
                                            <div class="row"><label for="name"><strong>Név</strong></label><input type="text" name="name" required></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer row text-center" style="margin-left: 0; margin-right: 0">
                            <div class="col-auto">
                                <button type="submit" class="btn"><i class="fa fa-save"></i>&nbsp;{{__('Mentés')}}</button>
                            </div>
                            <div class="col-auto">
                                <a class="btn" href="{{ route('varmegyek') }}"><i class="fa fa-ban"></i>&nbsp;{{__('Mégse')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
