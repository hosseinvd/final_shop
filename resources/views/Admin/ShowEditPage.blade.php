@extends('admin.layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('content')
    <div class="panel panel-default" id="C_table">
        <div class="panel-heading">صفحات</div>
        <form class="form-horizontal" method="post" action="{{route('a_Edit_page')}}" >
            {{csrf_field()}}
            <table class="table table-condensed">
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>
                            <div class="caption">
                                <h3>{{$page->title}}</h3>
                            </div>
                        </td>
                        <td >
                            <div class="clearfix">
                                <div style="height: 180px ; overflow: scroll;">{!! $page->body !!}</div>
                            </div>
                        </td>
                        <td>
                            <button type="submit" name="page_id" class="btn btn-submit btn-block"
                                    value="{{$page->id}}"
                            ><i class="fa fa-pencil" aria-hidden="true"></i>
                                ویرایش
                            </button>
                            <button type="button" class="btn btn-danger btn-block our_button_d"
                                    id="{{$page->id}}"
                            ><i class="fa fa-trash" aria-hidden="true"></i>
                                حذف
                            </button>
                            <br>
                            <a href="{{route('a_show_page',$page->id)}}" class="btn btn-success">
                                <i class="fa fa-eye" aria-hidden="true"></i>

                                مشاهده
                            </a>

                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
        {{ $pages->links() }}
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        $(document).on('click', '.our_button_d', function (event) {
            var id = $(this).attr("id");
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
                        $.post("/admin/Products", {
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

    </script>
@endsection
