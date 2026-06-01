@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Author') }}</div>
                <div class="card-body">
                    <form action="{{ route('authors.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('First Name') }}:</label>
                            <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Last Name') }}:</label>
                            <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}">
                        </div>
                        <button class="btn btn-success">{{ __('Add Author') }}</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection