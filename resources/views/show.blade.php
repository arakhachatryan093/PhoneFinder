@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Product {{ $phone->name }}</h1>
        <table id="prd-tbl" class="table">
            <tbody>

            <tr>
                <td>Name</td>
                <td>{{ $phone->name }}</td>
            </tr>
            <tr>
                <td>Category</td>
                <td>{{ $phone->category->name }}</td>
            </tr>
            <tr>
                <td>Price</td>
                <td>{{ $phone->price }}</td>
            </tr>

            <tr>
                <td>Description</td>
                <td>{{ $phone->description }}</td>
            </tr>
            <tr>
                <td>Image</td>
                <td><img src="{{'/storage/'.$phone->image}}"
                         class="tbl-big-img" alt="{{$phone->name}}"></td>
            </tr>
            </tbody>
        </table>

@endsection
