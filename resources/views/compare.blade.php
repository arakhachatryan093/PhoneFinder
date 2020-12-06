@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class=" text-center">{{$first_phone->name}} vs {{$second_phone->name}}</h2>
        <div class="d-flex my-3">
            <div class="container d-flex img-title">
                <div class="wdth-small">

                </div>
                <div class="phone-item ">
                    <h3 class=" comp-img-title">{{$first_phone->name}}</h3>
                    <img class="comp-item-img" src="{{'/storage/'.$first_phone->image}}" alt="{{$first_phone->name}}">
                </div>
                <div class="phone-item ">
                    <h3 class=" comp-img-title">{{$second_phone->name}}</h3>
                    <img class="comp-item-img" src="{{'/storage/'.$second_phone->image}}" alt="{{$second_phone->name}}">
                </div>
            </div>
        </div>
        <table id="prd-tbl" class="table">
            <tbody>
            <tr>
                <td class="small-td">Title</td>
                <td>{{ $first_phone->name }}</td>
                <td>{{ $second_phone->name }}</td>
            </tr>
            <tr>
                <td class="small-td">Category</td>
                <td>{{ $first_phone->category->name}}</td>
                <td>{{ $second_phone->category->name}}</td>
            </tr>
            <tr>
                <td class="small-td">Price</td>
                <td>{{ $first_phone->price }}</td>
                <td>{{ $second_phone->price }}</td>
            </tr>

            <tr>
                <td class="small-td">Description</td>
                <td>{{ $first_phone->description }}</td>
                <td>{{ $second_phone->description }}</td>
            </tr>

            </tbody>
        </table>
    </div>

@endsection

