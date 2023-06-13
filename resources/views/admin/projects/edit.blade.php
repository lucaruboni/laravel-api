@extends('layouts.admin')

@section('content')
<div class="container">
    @include('partials.validation_errors')
    <h1> {{$project->title}} Editing</h1>

    <form action="{{route('admin.projects.update', $project->id)}}" method="post" class="pb-5">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="progetto ex." aria-describedby="titleHelper" value="{{$project->title}}">
            <small id="titleHelper" class="text-muted">Type the project title max: 200 characters</small>
            @error('title')
            <div class="alert alert-danger" role="alert">
                <strong>Title, error :</strong>{{$message}}
            </div>
            @enderror

        </div>

        <div class="mb-3">
            <label for="image" class="form-label">image</label>
            <input type="text" name="image" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="https://" aria-describedby="imageHelper" value="{{$project->image}}">
            <small id="imageHelper" class="text-muted">Type the project image max: 200 characters</small>
            @error('image')
            <div class="alert alert-danger" role="alert">
                <strong>Image, error :</strong>{{$message}}
            </div>
            @enderror
        </div>





        <div class="mb-3">
            <label for="content" class="form-label">content</label>
            <input type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="Nintendo Switch" aria-describedby="contentHelper" value="{{$project->content}}">
            <small id="contentHelper" class="text-muted">Type the project content</small>

            @error('content')
            <div class="alert alert-danger" role="alert">
                <strong>content, error :</strong>{{$message}}
            </div>
            @enderror
        </div>

        <div class='form-group'>
        <p>Seleziona i technology:</p>
        @foreach ($technologies as $technology)
        <div class="form-check @error('technologies') is-invalid @enderror">
        <label class='form-check-label'>
        @if($errors->any())
        <!-- 1 (if) -->
        <input name="technologies[]" type="checkbox" value="{{ $technology->id}}" class="form-check-input" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
        @else
        <!-- 2 (else) -->
        <input name='technologies[]' type='checkbox' value='{{ $technology->id }}' class='form-check-input' {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
        @endif
        {{ $technology->name }}
        </label>
        </div>
        @endforeach
        @error('technologies')
        <div class='invalid-feedback'>{{ $message}}</div>
        @enderror
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">types</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                <option value="">Select a type</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" {{ $type->id  == old('type_id', '') ? 'selected' : '' }}>{{$type->name}}</option>
                @endforeach
            </select>
        </div>


       

        <button type="submit" class="btn btn-primary">Add project</button>
    </form>

</div>


@endsection