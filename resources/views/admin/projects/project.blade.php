@extends('layouts.admin')
@section('content')
<h1 class="mt-3">Show posts table</h1>
 <a class="btn btn-dark py-2 my-4" href="{{route('admin.projects.create')}}" role="button">Create Post</a> 

@include('partials.session_message')

<div class="table-responsive">
    <table class="table table-striped
    table-hover
    table-borderless
    table-primary
    align-middle">
        <thead class="table-light">

            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody class="table-group-divider">


        @forelse ($projects as $project)
            <tr class="table-primary">
                <td scope="row">{{$project->id}}</td>
                <td><img height="100" src="{{$project->cover_image}}" alt="{{$project->title}}"></td>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td>

                    <div class="d-flex gap-1">
                        <a class="btn btn-primary" href="{{route('admin.projects.show', $project->id )}}" role="button">View</a>
                        <a class="btn btn-warning" href="{{route('admin.projects.edit', $project->id )}}" role="button">Edit</a>
                        <form action="{{route('admin.projects.destroy', $project->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId">
                                  Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">Are you sure you want to delete {{$project->title}}?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Click on Delete to destroy this project or click Close to turn back.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                        </form>
                    </div>

                </td>

            </tr>
            @empty
            <tr class="table-primary">
                <td scope="row">No project yet.</td>

            </tr>
            @endforelse
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>








@endsection
