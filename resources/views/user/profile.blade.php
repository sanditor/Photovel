@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="profile-user">
                <div class="card text-center mb-3 overflow-hidden" style="min-width: 20em; margin-top: 10px;">
                    <div class="card-header bg-danger" style="height: 6rem;">
                        <div class="container-avatar mx-auto white light-mode zoom">
                            @if($user->image)
                            <img src=" {{ route('user.avatar', ['filename'=>$user->image]) }}" class="rounded-circle" style="height: 110px; width: 110px;" />
                            @endif
                        </div>

                    </div>

                    <div class="body">
                        <div class="user-info text-center">
                            <div class="font-weight-bold">
                                <h2>{{$user->nick}}</h2>
                            </div>
                            <h6>
                                {{$user->name.' '.$user->surname}}
                            </h6>
                            <p class="nickname-date"> {{'Se unió:  '.\FormatTime::LongTimeFilter($user->created_at)}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <hr />
        </div>
        <div class="card-deck">
            @foreach($user->images as $image)
            <div class="col-md-4 mt-4">
                @include('includes.image', ['image'=>$image])
            </div>
            @endforeach
        </div>
    </div>


</div>
@endsection
