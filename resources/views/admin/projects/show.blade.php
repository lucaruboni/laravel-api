@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row py-5">
        <div class="col ">
        
            <img src="{{asset('storage/' . $project->cover_image)}}" class="img-fluid" alt="{{$project->title}}">
           
        </div>

        <div class="col">
            <h1>{{$project->title}}</h1>
            <div> <strong>Content: </strong>{{$project->content}}</div>
            <div> <strong>type: </strong>{{$project->type->name}}</div>

            
          
            <h6><strong>Technologies:</strong></h6>
                  <ul>
                
                    @forelse ($project->technologies as $technology)
                    
                    <li>  {{ $technology->name }}</li>
                    @empty
                      <div><strong>Technology:</strong> n/a</div>
                    @endforelse
                  <ul>
             
          
          
            </div>
                       
        </div>
    </div>

@endsection