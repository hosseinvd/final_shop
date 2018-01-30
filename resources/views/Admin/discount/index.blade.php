@extends('admin.layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('content')

        <div class="breadcrumb-area">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{route('a_Dashboard')}}"><i class="fa fa-home"></i> داشبورد</a></li>
                    <li class="active">تخفیفها</li>
                </ol>
            </div>
        </div>
        <div class="panel panel-default" id="C_table">
            <div class="panel-heading">تخفیفها</div>
        <form class="form-horizontal" method="post" action="{{route('a_Edit_Products')}}" >
            {{csrf_field()}}
            <table class="table table-condensed">
                <tr>
                    <th>code</th>
                    <th>درصد دتخفیف</th>
                    <th>مقدار تخفیف</th>
                    <th>تعداد باقی مانده</th>

                </tr>
                <tbody>
                @foreach($discounts as $discount)
                    <tr>
                        <td>
                            {{$discount->code}}
                        </td>
                        <td>
                            {{$discount->percent}}
                        </td>
                        <td>
                            {{$discount->value}}

                        </td>
                        <td>
                            {{$discount->numbers}}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
        {{ $discounts->links() }}
    </div>
@endsection
@section('scripts')

@endsection
