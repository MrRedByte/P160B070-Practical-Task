@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Filter Articles by Author') }}
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary float-end">{{ __('Back to Articles') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('articles.filter') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-control" name="author_id">
                                    <option value="">{{ __('Select Author') }}</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ $selectedAuthorId == $author->id ? 'selected' : '' }}>
                                            {{ $author->first_name }} {{ $author->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                            </div>
                        </div>
                    </form>

                    @if($selectedAuthorId)
                        <h5>{{ __('Articles by selected author') }}</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Publication Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ Str::limit($article->description, 100) }}</td>
                                    <td>{{ $article->publication_date->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($articles->isEmpty())
                            <p class="text-muted">{{ __('No articles found for this author.') }}</p>
                        @endif
                    @else
                        <p class="text-muted">{{ __('Select an author from the dropdown and click Filter.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection