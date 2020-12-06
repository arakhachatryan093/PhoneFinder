@extends('layouts.app')
@section('content')


    <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="" placeholder="Category Name"
                                   required>
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" placeholder="Description" cols="20" rows="6"
                                      class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h3>Categories</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <p>Name: {{ $category->name }} </p>

                                        <div class="button-group d-flex">
                                            <button type="button" class="btn btn-sm btn-primary mr-1 edit-category"
                                                    data-toggle="modal" data-target="#editCategoryModal"
                                                    data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                                    data-description="{{$category->description}}">Edit
                                            </button>

                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button onclick="return confirm('Are you sure?')" type="submit"
                                                        class="btn btn-sm btn-danger">Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="cat_info my-1">
                                        <p>Description: {{$category->description}}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if($categories)
                            <div class="my-2">
                                {{ $categories->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Category</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                       placeholder="Category Name" required>
                            </div>
                            <div class="form-group">
                                <textarea name="description" value="{{old('description')}}" id="description"
                                          placeholder="Description" cols="20" rows="6" class="form-control"></textarea>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
