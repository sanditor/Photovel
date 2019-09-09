@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center p-2">
        <div class="card" style="width: 26%;;">
            <div class="card-body">
                <h4 class="card-title text-center p-1">Buscador Usuarios</h4>
                <form method="Get" action="{{ route('user.index') }}" id="buscador">
                    @csrf
                    <div class="row p-3">
                        <div class="form-group col-9">
                            <input id="search" type="text" name="search" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="" />
                            <span class="invalid-feedback" role="alert">
                                <strong> {{ $errors->first('name') }}</strong>
                            </span>
                        </div>
                        <div class="form-group col-3 btn-search">
                            <input type="submit" class="btn btn-success" value="Buscar" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">

        @foreach($users as $user)
        <div class="col-md-4 p-3">
            <div class="card-deck">
                <div class="card text-center mb-5 overflow-hidden" style="width: 16rem; margin-top: 10px;">
                    <div class="profile-user">
                        <div class="card-header bg-danger" style="height: 6rem;">
                            @if($user->image)
                            <img src=" {{ route('user.avatar', ['filename'=>$user->image]) }}" class="container-avatar rounded-circle" />
                            @endif
                        </div>
                        <div class="body">
                            <div class="user-info text-center">
                                <div class="font-weight-bold">
                                    <h2>{{$user->nick}}</h2>
                                </div>
                                <h6>{{$user->name.' '.$user->surname}}</h6>
                                <p class="nickname-date"> {{'Se unió:  '.\FormatTime::LongTimeFilter($user->created_at)}} </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-success">Ver perfil</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!--        PAGINACION-->
    <div class="clearfix"></div>
    {{ $users->links() }}
</div>
@endsection
