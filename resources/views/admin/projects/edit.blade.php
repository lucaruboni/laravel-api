@extends('layouts.admin')

@section('content')
<div class="container">
    @include('partials.validation_errors')
    <h1> {{$project->title}} Editing</h1>

    <form action="{{route('admin.projects.update', $project->id)}}" method="post" class="pb-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="progetto ex." aria-describedby="titleHelper" value="{{ old('title', $project->title)}}" >
            <small id="titleHelper" class="text-muted">Type the project title max: 200 characters</small>
            @error('title')
            <div class="alert alert-danger" role="alert">
                <strong>Title, error :</strong>{{$message}}
            </div>
            @enderror

        </div>


        <div class="d-flex gap-3">
            
        <img src="{{asset('storage/' . $project->cover_image)}}" width="100" alt="">

            <div class="mb-3">
                <label for="cover_image" class="form-label">Replace Image</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image" aria-describedby="cover_imageHelper" placeholder="Learn php">
                <small id="cover_imageHelper" class="form-text text-muted">Type the post cover_image max *kb</small>
                @error('image')
                    <div class="alert alert-danger" role="alert">
                        <strong>Image, error :</strong>{{$message}}
                    </div>
                    @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="github_link" class="form-label">Github Link</label>
            <input type="text" class="form-control @error('github_link') is-invalid @enderror" name="github_link" id="github_link" aria-describedby="github_linkHelper" placeholder="Learn php" value="{{ old('github_link', $project->github_link) }}">
            <small id="github_linkHelper" class="form-text text-muted">Type the post github_link max 255 characters</small>
            @error('github_link')
            <div class="alert alert-danger" role="alert">
                <strong>github_link, error :</strong>{{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">content</label>
            <input type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="Nintendo Switch" aria-describedby="contentHelper" value="{{ old('content', $project->content)}}">
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
                <option value="{{ old('type_id', $project->type)}}">Select a type</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" {{ $type->id  == old('type_id', '') ? 'selected' : '' }}>{{$type->name}}</option>
                @endforeach
            </select>
        </div>


       

        <button type="submit" class="btn btn-primary">Add project</button>
    </form>

</div>


@endsection