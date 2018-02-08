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

        <table class="table table-condensed">
            <tr>
                <th>code</th>
                <th>درصد دتخفیف</th>
                <th>مقدار تخفیف</th>
                <th>تعداد باقی مانده</th>
                <th>نوع محاسبه</th>
                <th>تاریخ شروع</th>
                <th>تاریخ پایان</th>
                <th>عملیات</th>
            </tr>
            <tbody>
            @foreach($discounts as $discount)
                @if($discount->numbers<=0 or \Carbon\Carbon::today()>$discount->end_date)
                    <tr class="danger">
                @else
                    <tr class="success">
                        @endif

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
                        <td>
                            {{$discount->calc_mode}}
                        </td>
                        <td>
                            {{jdate($discount->start_date)->format('date')}}
                        </td>
                        <td>
                            {{jdate($discount->end_date)->format('date')}}
                        </td>
                        <td>
                            <a href="{{route('discount.edit',$discount->id)}}" class="btn btn-success">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                ویرایش
                            </a>
                            @if($discount->numbers>0)
                                <a href="{{route('discount.deactive',$discount->id)}}" class="btn btn-danger">
                                    <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                    غیر فعال کردن
                                </a>
                            @else
                                <a href="{{route('discount.deactive',$discount->id)}}" class="btn btn-danger disabled">
                                    <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                    غیر فعال کردن
                                </a>
                            @endif
                            <a href="{{route('discount.show',$discount->id)}}" class="btn btn-success">
                                <i class="fa fa-eye" aria-hidden="true"></i>

                                مشاهده
                            </a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>

        {{ $discounts->links() }}
    </div>
@endsection

