<div class="col-lg-9 col-md-9 ">
    <div class="mainmenu bg-color-4 ">
        <nav>
            <ul>
                <li class="active"><a href={{route('products')}}>خانه</a>
                    <ul>
                        <li><a href={{route('products')}}>خانه</a></li>
                    </ul>
                </li>
                <li><a href="shop.html">پرفروش‌ترین محصولات</a></li>
                <li><a href="shop.html">محصولات جدید</a></li>
                <li><a href="#">صفحات</a>
                    <ul>
                        @foreach($pages as $page)
                            <li><a href="{{route('show_page',$page->id)}}">{{$page->title}} </a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="about.html">درباره ما</a></li>
            </ul>
        </nav>
    </div>
</div>