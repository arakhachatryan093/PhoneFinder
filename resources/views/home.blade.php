@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header head-color">
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="title"><span class="icon mx-3"><i class="fas fa-mobile-alt"></i></span>PHONE FINDER</h1>
                </div>
            </div>
            <div class="card-body body-color">
                <table class="table">
                    <tr class="row col-12">
                        @foreach($categories as $category)
                            <td class="col-3 text-center">
                                <a href="{{route('category_products',$category->id)}}">{{$category->name}}</a>
                            </td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
