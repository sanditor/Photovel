@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">

        <div class="col-md-5 mb-5">
            @foreach($users as $user)
            @endforeach
            <div class="card">
                <div class="card-header bg-danger" style="height: 6rem;">
                    <div class="home-avatar mx-auto white light-mode zoom">
                        @if(Auth::user()->image)
                        <a href="{{ route('profile', ['id' => $user->id]) }}"><img src=" {{ route('user.avatar', ['filename'=>Auth::user()->image]) }}" class="rounded-circle" style="height: 110px; width: 110px;" />
                        </a>
                        @endif
                    </div>

                </div>
                <div class="card-body">
                    <div class="nickhome">
                        {{ $user->nick}}
                    </div>
                    <form method="POST" action=" {{ route('image.save') }}" enctype="multipart/form-data" class="">
                        @csrf
                        <div class="mt-1 text-center div-image">
                            <img src=" {{ asset('img/camara.png') }}" class="home-image" alt="Subir Foto"></img>
                            <div class="info-image">
                                <div class="info-photo ">
                                    <i class="fa fa-camera fa-2x"></i>
                                    <h5 text-white>Subir Imagen</h5>
                                </div>
                            </div>
                            <input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}" required />
                            @if($errors->has('image_path'))
                            <span class="invalid-feedback" role="alert">
                                <strong> {{ $errors->first('image_path') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mt-4" style="position:relative;">
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} mt-2 " id="description" placeholder="Describir la imagen" autofocus></textarea>
                            @if($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong> {{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-danger border-0 hoverable mt-4 m-0 w-100 white-text">
                                        <i class="fas fa-upload" aria-hidden="true"></i> Upload
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            @include('includes.message')
            @foreach($images as $image)
            @include('includes.image', ['image'=>$image])
            @endforeach

            <!--        PAGINACION-->
            <div class="clearfix"></div>
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection
