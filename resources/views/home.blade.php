@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>
                <div class="card-body">

                    {{-- START: PROFILE --}}
                    <div class="d-flex flex-column justify-content-center text-center">
                        <div class="p-2">
                            <img class="rounded-circle" src="{{asset('/storage/images/'.Auth::user()->avatar)}}"
                                alt="avatar" width="160" height="160">
                        </div>
                        <div class="p-2">
                            <h1>{{Auth::user()->name}}</h1>
                            <small>{{Auth::user()->email}}</small>
                        </div>

                    </div>
                    {{-- END: PROFILE --}}

                    <div class="card p-2 col">
                        {{-- START: ALERT MESSAGE --}}
                        @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                        @elseif(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                        @endif
                        {{-- END: ALERT MESSAGE --}}

                        <form action="/upload-avatar" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input id="image-upload" type="file" name="avatar">
                            <button class="btn bg-secondary text-light" type="submit">Upload</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection