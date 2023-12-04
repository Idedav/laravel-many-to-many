@extends('layouts.admin')


@section('content')
    <h1>{{ $title }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="mb-3">
            <label for="name" class="form-label">Project Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $project?->name) }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="m-3">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($technologies as $technology)
                    <input type="checkbox" class="btn-check" id="technology-{{ $technology->id }}" autocomplete="off"
                        name="technologies[]" value="{{ $technology->id }}"
                        @if (
                            ($errors->any() && in_array($technology->id, old('technologies', []))) ||
                                (!$errors->any() && $project?->technologies->contains($technology))) checked @endif>
                    <label class="btn btn-outline-primary"
                        for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Project Type:</label>
            <select class="form-select" id="type" name="type">
                <option selected>Select a type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ old('type_id', $project?->type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}
                    </option>
                @endforeach

            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image"
                value="{{ old('image', $project?->image) }}">
            @if ($project)
                <img width="150" src="{{ asset('storage/' . $project->image) }}" alt="">
            @endif
        </div>
        <div class="mb-3">
            <label for="description">Description:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Leave a description here"
                id="description" name="description" style="height: 100px">{{ old('description', $project?->description) }}</textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Confirm</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </form>
@endsection
