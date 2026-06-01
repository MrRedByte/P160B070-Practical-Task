@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Article') }}</div>
                <div class="card-body">
                    <form action="{{ route('articles.update', $article->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">{{ __('Title') }}:</label>
                            <input class="form-control" type="text" name="title" value="{{ old('title', $article->title) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Description') }}:</label>
                            <textarea class="form-control" name="description" rows="4">{{ old('description', $article->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Publication Date') }}:</label>
                            <input class="form-control" type="date" name="publication_date" value="{{ old('publication_date', $article->publication_date->format('Y-m-d')) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Author') }}:</label>
                            <select class="form-control" name="author_id">
                                <option value="">{{ __('Select Author') }}</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $article->author_id) == $author->id ? 'selected' : '' }}>
                                        {{ $author->first_name }} {{ $author->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success">{{ __('Update Article') }}</button>
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