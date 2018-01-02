@extends('layouts.master')
@section('title','Larvel Shopping Cart')
@section('content')

    @foreach($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as $product)
                <div class="col-sm-6 col-md-4 ">
                    <div class="thumbnail">
                        <a href="{{route('show_product',$product->id)}}">
                            <img src="{{asset('product_image').'/'.$product->images()->first()->imagePath}}" alt="...">
                        </a>
                        <div class="caption">
                            <h3>{{$product->title}}</h3>
                            <p class="description">{{$product->description}}</p>
                            <div class="clearfix">
                                <div class="pull-left price">{{$product->price}}</div>
                                <div><a href="{{route('addToCart',$product->id)}}" class="btn btn-success pull-right" role="button">Button</a></div>
                            </div>
                        </div> 
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {{ $products->links() }}
@endsection
