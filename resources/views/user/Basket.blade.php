@extends('layouts.master')
@section('title')
    @guest
        guest
        @else
            {{auth()->user()->name}}
            @endguest
@endsection
@section('content')
    <div class="container">
        <form class="form-horizontal" method="post" action="{{route('Gateway-Request')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <h2>Table</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>refresh</th>
                        <th>Product Price</th>
                        <th>tax</th>
                        <th>Totla row Price</th>

                    </tr>
                    </thead>
                    <tbody>

                    {{$i=0}}
                    @foreach(Cart::content() as $row)
                        <tr>
                            {{$i++}}
                            <td>{{$i}}</td>
                            {{--<td>{{$row->rowId}}</td>--}}
                            <td><p><strong>{{$row->name}}</strong></p></td>
                            <td>
                                <input class="form-control" id="row_id_{{$i}}" type="hidden" name="row_id[]" value="{{$row->rowId}}">
                                <input class="form-control" id="row_qty_{{$i}}" type="number" name="row_qty[]" value="{{$row->qty}}">
                            </td>
                            <td>
                                <button  type="button" class="btn btn-warning " id="refresh" value="{{$i}}"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                            </td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->qty*$row->tax}}</td>
                            <td>{{$row->total}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Subtotal</td>
                        <td><?php echo Cart::subtotal(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Tax</td>
                        <td><?php echo Cart::tax(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Total</td>
                        <td><?php echo Cart::total(); ?></td>
                    </tr>

                    </tfoot>
                </table>
            </div>
    </div>


    <input type="hidden" class="form-control" name="total_price" value="{{Cart::total()}}">
    <div class="col-md-12">
        <div class="col-md-6">
            <button type="submit" class="btn btn-success btn-block">پرداخت</button>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    </form>

@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {

            $(document).on('click', '#refresh', function (event) {
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var _method = 'PATCH';
                var id = $(this).attr("value");
                var row_id = $("#row_id_" + id).val();
                var row_qty = $("#row_qty_" + id).val();
                if (isNaN(parseInt(row_qty, 10))) {
                    alert("Input not valid");
                } else {
                    $.post("{{route('updateCart')}}", {
                        'id': id,
                        'row_id': row_id,
                        'row_qty': row_qty,
                        _token: CSRF_TOKEN,
                        _method: _method,
                    }, function (data) {

                    });
                }
            });


        });

    </script>
@endsection
