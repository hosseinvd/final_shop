@extends('layouts.admin_master')
@section('title','Admic Create Page')
@section('content')
    <div class="col-sm-10 center-block">
        <form class="form-horizontal" method="post" action="{{route('a_Store_page')}}" >
            {{ csrf_field() }}
            <label>اطلاعات صفحه</label>
            <div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="title">عنوان :</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control" id="title" placeholder="title" name="title"
                                required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                    <textarea rows="30"   name="body" id="body" placeholder="توضیحات را وارد کنید">
                    </textarea>
                    </div>
                    <div class="col-sm-6 pull-left">
                    <button type="submit" class="btn btn-success btn-block" >Submit</button>
                    </div>
                </div>
            </div>
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
        CKEDITOR.config.height=500 ;
//        CKEDITOR.on('instanceReady',
//            function( evt ) {
//                var instanceName = 'body'; // the HTML id configured for editor
//                var editor = CKEDITOR.instances[instanceName];
//                editor.execCommand('maximize');
//            }
//        );

    </script>
@endsection
