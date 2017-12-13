@extends('layouts.admin_master')
@section('title','Larvel Add Product')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}"  crossorigin="anonymous">
@endsection
@section('content')
    @include('partials.errors')
    <br>

    <div class="container " >
        <div class="panel-heading"><h2>محصول جدید</h2></div>

        <form class="form-horizontal" method="post" action="{{route('a_Update_product')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="p_id" id="product_id" value="{{$s_product->id}}">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="title">عنوان :</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="title" placeholder="title" name="title"
                               value="{{$s_product->title}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="price">قیمت :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="price" placeholder="price" name="price"
                               value="{{$s_product->price}}" required>
                    </div>
                    <label class="control-label col-sm-2" for="discount">تخفیف :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="discount" placeholder="discount" name="discount"
                               value="{{$s_product->discount}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="inventory" required>موجودی :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inventory" placeholder="inventory" name="inventory"
                               value="{{$s_product->inventory}}">
                    </div>
                    <label class="control-label col-sm-2" for="weight">وزن :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="weight" placeholder="weight" name="weight"
                               value="{{$s_product->weight}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="size">ابعاد :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="size" placeholder="size" name="size"
                               value="{{$s_product->size}}">
                    </div>
                    <label class="control-label col-sm-2" for="color">رنگ :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="color" placeholder="color" name="color"
                               value="{{$s_product->color}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="warranty">گارانتی :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="warranty" placeholder="warranty" name="warranty"
                               value="{{$s_product->warranty}}">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2">گروه :</label>
                    <select class="form-control col-sm-4" name="category_id" id="category_id" required>
                        @foreach($categories as $category)
                            @if($s_product->category_id==$category->id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">توضیح مختصر </label>
                    <div>
                        <textarea class="form-control" rows="6" id="description" name="description"></textarea>
                    </div>
                </div>

            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>توضیحات کامل</label>
                    <div>
                    <textarea rows="5" class="form-control" name="long_description" id="body"
                              placeholder="توضیحات را وارد کنید">
                    </textarea>
                    </div>
                </div>
            </div>

            <row class="form-group">
                <div class="col-sm-10" id="C_table">

                    @foreach($s_product->images()->get() as $product_img)
                        <div class="col-md-2">
                            <div class="thumbnail">

                                <img src="{{asset('product_image').'/'.$product_img->imagePath}}"
                                     class="m_admin_image img-rounded" alt="...">
                                <div class="caption">
                                    <button type="button" class="btn btn-danger  our_button_d"
                                            id="{{$product_img->id}}"
                                    >حذف
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success btn-block" id="add_category">Submit</button>
                </div>
            </row>

        </form>

        <form method="post" action="{{route('a_Edit_Products_Image')}}" class="dropzone">
            <input type="hidden" name="product_id" value="{{$s_product->id}}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
        </form>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script>
        CKEDITOR.replace('body', {
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image'
        });
        CKEDITOR.config.contentsLangDirection = 'rtl';
        CKEDITOR.config.defaultLanguage = 'fa';
    </script>
    <script type="text/javascript">
        $(document).on('click', '.our_button_d', function (event) {
            var image_id = $(this).attr("id");
            var product_id= $("#product_id").val();
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var _method = 'DELETE';
            swal({
                    title: "آیا از عملیات حذف مطمئن هستید",
                    text: "عملیات حذف محصول",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "بله ",
                    cancelButtonText: "لغو عملیات",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.post("/admin/EditProducts", {
                            'product_id': product_id,
                            'image_id':image_id,
                            _token: CSRF_TOKEN,
                            _method: _method,
                        }, function (data) {
                            $('#C_table').html(data);
                        });
                        swal("حذف", "عملیات حذف با موفقیت پایان یافت", "success");
                    } else {
                        swal("لغو", "عملیات لغو گردید", "error");
                    }
                });

        });
    </script>
@endsection

