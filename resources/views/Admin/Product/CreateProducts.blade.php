@extends('admin.layouts.admin_master')
@section('title','Larvel Add Product')



@section('content')
    @include('Admin.partials.errors')
    <br>

    <div class="container ">
        <div class="panel-heading"><h2>محصول جدید</h2></div>
        <form class="form-horizontal" method="post" action="{{route('a_storeProduct')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="title">عنوان :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" placeholder="title" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="price" >قیمت :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="price" placeholder="price" name="price" required>
                    </div>
                    <label class="control-label col-sm-2" for="discount">تخفیف :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="discount" placeholder="discount" name="discount">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="inventory" required>موجودی :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="inventory" placeholder="inventory" name="inventory">
                    </div>
                    <label class="control-label col-sm-2" for="weight">وزن :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="weight" placeholder="weight" name="weight">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="size">ابعاد :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="size" placeholder="size" name="size">
                    </div>
                    <label class="control-label col-sm-2" for="color">رنگ :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="color" placeholder="color" name="color">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="warranty">گارانتی :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="warranty" placeholder="warranty" name="warranty">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-2">گروه :</label>
                    <select  class="form-control col-sm-4" name="category_id[]" id="category_id" required multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <label class="control-label col-sm-2">تصویر:</label>
                    <input type="file" class="form-control col-sm-4" name="images" id="images"
                               placeholder="تصویر مقاله را وارد کنید" value="">
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
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block" id="add_category">Submit</button>
            </div>
        </form>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('body',{
            filebrowserUploadUrl : '/admin/panel/upload-image',
            filebrowserImageUploadUrl :  '/admin/panel/upload-image'
        });
        CKEDITOR.config.contentsLangDirection = 'rtl';
        CKEDITOR.config.defaultLanguage = 'fa';
    </script>
@endsection

