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

        <h2>Table</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Price</th>
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
                        <td>{{$row->qty}}</td>
                        <td>{{$row->price}}</td>
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

        <a class="navbar-brand" href="{{route('Gateway-Request')}}">pay</a>
    <button type="button" class="btn btn-default btn-lg">

    </button>
@endsection