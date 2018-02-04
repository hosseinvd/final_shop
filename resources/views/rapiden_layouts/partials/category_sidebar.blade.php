<div class="col-lg-3  col-md-3">
    <div class="mainmenu-left  visible-lg  visible-md">
        <div class="product-menu-title">
            <h2>همه دسته ها <i class="fa fa-arrow-circle-down"></i></h2>
        </div>
        <div class="product_vmegamenu">
            <ul>
                {!! $cat_html !!}
                {{--@foreach($categories as $category)--}}
                    {{--<li><a href="{{route('products_in_cat',$category->id)}}">{{$category->name}}</a></li>--}}
                {{--@endforeach--}}
            </ul>
        </div>
    </div>
</div>