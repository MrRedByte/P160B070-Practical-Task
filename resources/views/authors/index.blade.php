@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Authors') }}
                    <a href="{{ route('authors.create') }}" class="btn btn-success float-end">{{ __('Add New Author') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>{{ __('Articles') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->first_name }}</td>
                                <td>{{ $author->last_name }}</td>
                                <td>{{ $author->articles->count() }}</td>
                                <td>
                                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure?') }}');">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($authors->isEmpty())
                        <p class="text-muted">{{ __('No authors found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection