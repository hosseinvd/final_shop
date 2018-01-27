@extends('admin.layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="thumbnail">
                <div class="col-xs-12 col-sm-12 col-md-12">
                @foreach($product->images as $index=>$image)
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="pro-large-img">
                                <img class="m_admin_image" src="{{asset('product_image').'/'.$image->imagePath}}" alt="...">
                            </div>
                        </div>
                @endforeach
                </div>
                <div class="caption">
                    <h3>{{$product->title}}</h3>
                    <div class="short-desc">
                        <p>{{$product->description}}</p>
                    </div>
                    <div class="tab-pane active" id="home3">
                        <div class="pro-desc">
                            <p>{!!$product->long_description!!}</p>
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

