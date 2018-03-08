@extends('admin.layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('content')
    <!-- /.chat -->
    <br>
    <div class="container col-md-2 center-block"></div>
    <div class="container col-md-8 center-block">

        <div class="panel panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">ثبت دسته جدید</div>
                <form class="form-horizontal" method="post" action="{{route('a_CreateProductCategory')}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="panel-body">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="usr"> نام دسته </label>
                                <input type="text" class="form-control" name="name" id="Category_name">
                            </div>
                        </div>
                        <div class="col-md-4 col-md-push-1 col-sm-12">
                            <div class="form-group">
                                <label class="control-label">گروه</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option value="0">سرگروه</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"><strong>{{$category->name}}</strong></option>
                                        <?php
                                        $sub_cats = $category->categories;
                                        if ($sub_cats->isNotEmpty()) {
                                            echo "<optgroup>";
                                            foreach ($sub_cats as $sub_cat) {
                                                echo "<option value='$sub_cat->id'>$sub_cat->name</option>";
                                            }
                                            echo "</optgroup>";
                                        }
                                        ?>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="pwd">توضیحات</label>
                            <input type="text" class="form-control" name="description" id="Category_description">
                            <br>
                            <button type="submit" class="btn btn-primary btn-block" id="add_category_1">ثبت</button>
                        </div>
                        {{--<div class="treeview">--}}
                            {{--<ul>--}}
                                {{--{!! $cat_html !!}--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                </form>
            </div>

            <div class="panel panel-info" id="C_table">
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>نام دسته</th>
                            <th>توضیحات</th>
                            <th>زیرمجموعه گروه</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories_p as $category)
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

                                    @if($category->parent_id>0)
                                        <?php
                                        $parent_category = \App\Category::where('id', '=', $category->parent_id)->first();
                                        ?>
                                        <input type="hidden" placeholder="write_items"
                                               id='tbl_parent_id_{{$category->id}}' value='{{$category->parent_id}}'>
                                        {{$parent_category->name}}
                                    @else
                                        <input type="hidden" placeholder="write_items"
                                               id='tbl_parent_id_{{$category->id}}' value='0'>
                                        ریشه
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-block our_button_e"
                                            id="{{$category->id}}" data-toggle="modal"
                                            data-target="#myModal">ویرایش
                                    </button>
                                </td>
                                <td>
                                    @if(!($category->products()->exists()))
                                        <button type="button" class="btn btn-danger btn-block our_button_d"
                                                id="{{$category->id}}" data-toggle="modal"
                                        >حذف
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-block our_button_d" disabled
                                                id="{{$category->id}}" data-toggle="modal"
                                        >حذف
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $categories_p->links() }}
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
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="pre_Category_parent_id_m">
                        <label class="control-label">گروه</label>
                        <select class="form-control" name="Category_parent_id_m" id="Category_parent_id_m" required>
                            <option value="0">سرگروه</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"><strong>{{$category->name}}</strong></option>
                                <?php
                                $sub_cats = $category->categories;
                                if ($sub_cats->isNotEmpty()) {
                                    echo "<optgroup>";
                                    foreach ($sub_cats as $sub_cat) {
                                        echo "<option value='$sub_cat->id'>$sub_cat->name</option>";
                                    }
                                    echo "</optgroup>";
                                }
                                ?>
                            @endforeach
                        </select>
                    </div>

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
                $("#Category_id_m").val(id);//current_Category_parent_id_m
            });


            $(document).on('click', '#edit_category_m', function (event) {
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var _method = 'PATCH';
                var id = $("#Category_id_m").val();
                var sel_parent_id = $("#Category_parent_id_m").val();
                var name = $("#Category_name_m").val();
                var description = $("#Category_description_m").val();
                $.post("/admin/CreateProductCategory", {
                    'name': name,
                    'id': id,
                    'description': description,
                    'sel_parent_id': sel_parent_id,
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
                            $.post("/admin/CreateProductCategory", {
                                'id': id,
                                _token: CSRF_TOKEN,
                                _method: _method,
                            }, function (data) {
                                $('#C_table').load(location.href + ' #C_table');
                            });
                            swal("حذف", "عملیات حذف با موفقیت پایان یافت", "success");
                        } else {
                            swal("لغو", "عملیات لغو گردید", "error");
                        }
                    });

            });

//

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
                var category_id = $("#category_id").val();
                $.post("/admin/CreateProductCategory", {
                    'name': name,
                    'description': description,
                    'category_id': category_id,
                    _token: CSRF_TOKEN
                }, function (data) {
                    $('#C_table').load(location.href + ' #C_table');
                });
            })
        });

    </script>
@endsection
