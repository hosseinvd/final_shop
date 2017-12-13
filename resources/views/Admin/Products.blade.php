@extends('layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('content')
    <div class="panel panel-default" id="C_table">
        <div class="panel-heading">محصولات</div>
        <form class="form-horizontal" method="post" action="{{route('a_Edit_Products')}}" >
            {{csrf_field()}}
        <table class="table table-condensed">
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        @if($product->images()->exists())
                            <img src="{{asset('product_image').'/'.$product->images()->first()->imagePath}}"
                                 class="m_admin_image" alt="...">
                        @else
                            <img src="{{asset('product_image').'/'.'A.jpg'}}"
                                 class="m_admin_image" alt="...">
                        @endif
                    </td>
                    <td>
                        <div class="caption">
                            <h3>{{$product->title}}</h3>
                            <p class="description">{{$product->description}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="clearfix">
                            <div class="price">{{$product->price}}</div>
                        </div>
                    </td>
                    <td>
                        <button type="submit" name="product_id" class="btn btn-submit btn-block"
                                 value="{{$product->id}}"
                        >ویرایش
                        </button>
                        <button type="button" class="btn btn-danger btn-block our_button_d"
                                id="{{$product->id}}"
                        >حذف
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </form>
        {{ $products->links() }}
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
