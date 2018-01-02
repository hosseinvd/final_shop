@extends('layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('content')
    <div class="panel panel-default" >
        <div class="panel-heading">همه نظرات</div>

        <table class="table table-condensed">
            <thead>
            <tr>
                <th>نام کاربر</th>
                <th>متن کامنت</th>
                <th>پست مربوطه</th>
                <th>تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td><a href="{{ route('a_show_product',$comment->commentable_id)}}">{{  $comment->commentable->title }}</a></td>
                    <td>
                        <form action="{{ route('comments.destroy'  , ['id' => $comment->id]) }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="btn-group btn-group-xs">
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!!   $comments->render() !!}
    </div>
@endsection

