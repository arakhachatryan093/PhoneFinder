@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            @if(count($phones) > 0 )
                @foreach($phones as $phone)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">{{$phone->name}}</h3>
                        </div>
                        <div class="card-body">
                            <img src="{{'/storage/'.$phone->image}}"
                                 class="round-img" alt="{{$phone->name}}">
                            <p class="text-info">
                                {{$phone->price}}
                            </p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-success add_comp" data-img="{{$phone->image}}"
                                    data-name="{{$phone->name}}" data-id="{{$phone->id}}">add to compare
                            </button>
                            <a href="{{route('phone_details',$phone->id)}}" class="btn btn-sm btn-primary">view
                                details</a>
                        </div>
                    </div>
                @endforeach
            @else
                <h2 class="text-center w-100">No phones of this brand</h2>
            @endif
        </div>
    </div>

@endsection
