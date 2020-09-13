@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

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
@endsection