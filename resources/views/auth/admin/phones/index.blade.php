@extends('layouts.app')
@section('content')

    <div id="cont">
        <div class="container">

            <div class="card-header d-flex">
                <span>Phones Management</span>
                <a href="{{route('phones.create')}}" class="btn btn-primary btn-sm ml-auto">create phone</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($phones as $phone)
                            <tr>
                                <th scope="row"><a class="btn text-info bt-name"
                                                   href="{{route('phone_details',$phone->id)}}">{{$phone->name}}</a>
                                </th>
                                <td>
                                    {{$phone->category->name}}
                                </td>
                                <td class="w-25">
                                    <img src="{{'/storage/'.$phone->image}}"
                                         class="tbl-img" alt="{{$phone->name}}">
                                </td>
                                <td>{{$phone->price}}</td>
                                <td>{{$phone->description}}</td>

                                <td class="flfl">
                                    <form action="{{ route('phones.edit', $phone->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn  btn-success">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                    </form>
                                    <form action="{{route('phones.destroy',$phone->id)}}" method="POST"
                                          style="margin-left: 10px;">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('Are you sure?')" type="submit"
                                                class="btn  btn-danger">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($phones)
                        <div>
                            {{ $phones->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
