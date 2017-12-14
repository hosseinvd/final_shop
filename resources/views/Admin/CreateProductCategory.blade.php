@extends('layouts.admin_master')
@section('title','Larvel Shopping Cart')

@section('content')
    <!-- /.chat -->
    <br>
    <div class="container col-md-2 center-block"></div>
    <div class="container col-md-8 center-block">
        <div class="panel panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">ثبت دسته جدید</div>
                <div class="panel-body">
                    <label for="usr"> نام دسته </label>
                    <input type="text" class="form-control" id="Category_name">
                    <label for="pwd">توضیحات</label>
                    <input type="text" class="form-control" id="Category_description">
                    <br>
                    <button type="button" class="btn btn-primary btn-block" id="add_category">ثبت</button>
                </div>
            </div>

            <div class="panel panel-info" id="C_table">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>نام دسته</th>
                            <th>توضیحات</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr class="our_table" id="{{$category->id}}">
                                <td>
                                    <input type="hidden" placeholder="write_items" id='tbl_name_{{$category->id}}'
                                           value='{{$category->name}}'>
                                    {{$category->name}}
                                </td>
                                <td>
                                    <input type="hidden" placeholder="write_items"
                                           id='tbl_description_{{$category->id}}' value='{{$category->description}}'>
                                    {{$category->description}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-block our_button_e"
                                            id="{{$category->id}}" data-toggle="modal"
                                            data-target="#myModal">ویرایش
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-block our_button_d"
                                            id="{{$category->id}}" data-toggle="modal"
                                            >حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $categories->links() }}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="title">ویرایش دسته</h4>
                </div>
                <div class="modal-body">
                    <label for="usr"> نام دسته </label>
                    <input type="text" class="form-control" id="Category_name_m">
                    <input type="hidden" class="form-control" id="Category_id_m">
                    <label for="pwd">توضیحات</label>
                    <input type="text" class="form-control" id="Category_description_m">
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block" id="edit_category_m" data-dismiss="modal">
                        ثبت
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $(document).on('click', '.our_button_e', function (event) {
                    var id = $(this).attr("id");
                    var name = $("#tbl_name_" + id).val();
                    var description = $("#tbl_description_" + id).val();
                    $("#Category_name_m").val(name);
                    $("#Category_description_m").val(description);
                    $("#Category_id_m").val(id);
             });


            $(document).on('click', '#edit_category_m', function (event) {
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var _method = 'PATCH';
                var id = $("#Category_id_m").val();
                var name = $("#Category_name_m").val();
                var description = $("#Category_description_m").val();
                $.post("/admin/CreateProductCategory", {
                    'name': name,
                    'id': id,
                    'description': description,
                    _token: CSRF_TOKEN,
                    _method: _method,
                }, function (data) {
                    $('#C_table').load(location.href + ' #C_table');
                });
            });

            $(document).on('click', '.our_button_d', function (event) {
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var _method = 'DELETE';
                var id = $(this).attr("id");
                $.post("/admin/CreateProductCategory", {
                    'id': id,
                    _token: CSRF_TOKEN,
                    _method: _method,
                }, function (data) {
                    $('#C_table').load(location.href + ' #C_table');
                });
            });

            $("#add_new_icon").click(function (event) {
                $("#add_item").val(" ");
                $("#title").text("add new item");
                $("#delete_item").hide("400");
                $("#save_item").hide("400");
                $("#add_btn").show();
            });
            $('#add_category').click(function (event) {
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var name = $("#Category_name").val();
                var description = $("#Category_description").val();
                $.post("/admin/CreateProductCategory", {
                    'name': name,
                    'description': description,
                    _token: CSRF_TOKEN
                }, function (data) {

                    $('#C_table').load(location.href + ' #C_table');
                });
            })
        });

    </script>
@endsection