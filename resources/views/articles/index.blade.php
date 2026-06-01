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
                    {{ __('Articles') }}
                    <a href="{{ route('articles.create') }}" class="btn btn-success float-end">{{ __('Add New Article') }}</a>
                    <a href="{{ route('articles.filter') }}" class="btn btn-outline-primary float-end me-2">{{ __('Filter by Author') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Publication Date') }}</th>
                                <th>{{ __('Author') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ Str::limit($article->description, 100) }}</td>
                                <td>{{ $article->publication_date->format('Y-m-d') }}</td>
                                <td>{{ $article->author->first_name }} {{ $article->author->last_name }}</td>
                                <td>
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-info btn-sm">{{ __('Edit') }}</a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure?') }}');">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($articles->isEmpty())
                        <p class="text-muted">{{ __('No articles found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection