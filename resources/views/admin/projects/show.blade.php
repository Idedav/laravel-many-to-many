@extends('layouts.admin')

@section('content')
    <h1 class="my-5">
        Project detail</h1>
    <h4>{{ $project->name }}</h4>
    <p>Technologies: @forelse ($project->technologies as $technology)
            <a href="#" class="badge text-bg-info">{{ $technology->name }}</a>
        @empty
            -
        @endforelse
    </p>

    @if ($project->type)
        <p>Type: <strong>{{ $project->type->name }}</strong></p>
    @endif
    <div class="w-50">
        <img src="{{ asset('storage/' . $project->image) }}" alt="">
    </div>
    <p>{{ $project->description }}</p>
@endsection
