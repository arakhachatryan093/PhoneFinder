@extends('layouts.app')

@isset($phone)
    @section('title', 'Edit product ' . $phone->name)
@else
    @section('title', 'Add product')
@endisset

@section('content')
    <div class="container">
        @isset($phone)

            <h1 class="mx-3">edit phone <b>{{ $phone->name }}</b></h1>
        @else
            <h1 class="mx-3">add phone</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($phone)
              action="{{ route('phones.update', $phone) }}"
              @else
              action="{{ route('phones.store') }}"
            @endisset
        >
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                @isset($phone)
                    @method('PUT')
                @endisset
                @csrf
                <div class="form-group ">
                    <label for="name" class="col-sm-2 col-form-label">Name </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($phone){{ $phone->name }}@endisset">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="price" class="col-sm-2 col-form-label">Price </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="price" id="price"
                               value="@isset($phone){{ $phone->price }}@endisset">
                    </div>
                </div>

                <br>
                <div class="form-group ">
                    <label for="description" class="col-sm-2 col-form-label">Description </label>
                    <div class="col-sm-6">
                        <textarea name="description" id="description" cols="62"
                                  rows="5">@isset($phone){{ $phone->description }}@endisset</textarea>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="category" class="col-sm-2 col-form-label">category </label>
                    <select class="custom-select col-sm-3" name="category" id="category" required>
                        @foreach($categories as $category)
                            @isset($phone)
                                @if($category->name === $phone->category->name)
                                    <option value="{{$phone->category_id}}" selected>{{$phone->category->name}}</option>
                                    @continue
                                @endif
                            @endisset
                            <option value="{{$category->id}} ">{{$category->name}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group row" style="padding-left: 15px;">
                    <label for="image" class="col-sm-2 col-form-label">Image </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            <input class="form-control-file" type="file" name="image" id="image">
                        </label>
                    </div>

                </div>

                <button style="margin-left: 13px;" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection

