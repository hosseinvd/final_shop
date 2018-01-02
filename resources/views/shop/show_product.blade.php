@extends('layouts.master')
@section('title','Larvel Shopping Cart')
@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="thumbnail">
                <img src="{{asset('product_image').'/'.$product->images()->first()->imagePath}}" alt="...">
                <div class="caption">
                    <h3>{{$product->title}}</h3>
                    <p class="description">{{$product->description}}</p>
                    <div class="clearfix">
                        <div class="pull-left price">{{$product->price}}</div>
                        <div><a href="{{route('addToCart',$product->id)}}" class="btn btn-success pull-right"
                                role="button">Button</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-12 panel panel-info">
        <div class="panel-body">
        @include('layouts.comment' , ['comments' => $comments , 'subject' => $product])
        </div>
    </div>
@endsection

