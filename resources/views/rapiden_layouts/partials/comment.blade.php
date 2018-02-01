<!-- Comments Form -->

<hr>

<!-- Posted Comments -->
<div class="tab-pane" id="messages3">
    <ul class="media-list comment-list mt-30">
        @foreach($comments as $comment)
            <li class="media">
                <div class="media-left">
                    <a href="#">
                        {{--<img alt="Jonathon Doe" src="img/blog/man-4.jpg" class="avatar">--}}
                    </a>
                </div>
                <div class="media-body">
                    <div class="comment-info">
                        <h4 class="author-name">{{ $comment->user->name }}</h4>
                        <div class="comment-meta">
                            <small>{{ jdate($comment->created_at)->ago() }}</small>
                            <button class="comment-reply-link response_comment" id="{{ $comment->id }}"
                                    value="{{ $comment->id }}">پاسخ
                            </button>
                            {{--<a type="button" class="comment-reply-link"   id="{{ $comment->id }}" value="{{ $comment->id }}">پاسخ</a>--}}
                        </div>
                    </div>
                    <p>{!! $comment->comment !!}</p>
                <!-- Nested Comment -->
                @if(count($comment->comments))
                    @foreach($comment->comments as $childComment)
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    {{--<img alt="Jonathon Doe" src="img/blog/man-1.jpg" class="avatar">--}}
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="comment-info">
                                    <h4 class="author-name">{{ $childComment->user->name }}

                                    </h4>
                                    <div class="comment-meta">
                                        <small>{{ jdate($childComment->created_at)->ago() }}</small>
                                    </div>
                                </div>
                                <p>{!! $childComment->comment !!} </p>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
            </li>
            <!-- End Nested Comment -->
        @endforeach

@if(auth()->check())
    <div class="well">
        @include('admin.layouts.errors')

        <div class="comments-form">
            <div class="row">
                <form role="form" action="/comment" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="parent_id" value="0">
                    <input type="hidden" name="commentable_id" value="{{ $subject->id }}">
                    <input type="hidden" name="commentable_type" value="{{ get_class($subject) }}">
                    <div class="col-md-12">
                        <textarea name="comment" class="form-control" rows="3"></textarea>
                        <button class="btn btn-lg mt-30">ثبت</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-danger">شما برای ارسال نظر باید وارد سایت شوید</div>
@endif
    </ul>
</div>
<!-- Comment -->

<div class="modal fade" id="sendCommentModal" tabindex="-1" role="dialog" aria-labelledby="sendCommentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">ارسال پاسخ</h4>
            </div>
            <div class="modal-body">
                <form action="/comment" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="parent_id" name="parent_id" value="0">
                    <input type="hidden" name="commentable_id" value="{{ $subject->id }}">
                    <input type="hidden" name="commentable_type" value="{{ get_class($subject) }}">

                    <div class="form-group">
                        <label for="message-text" class="control-label">متن پاسخ:</label>
                        <textarea class="form-control" id="message-text" name="comment"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.response_comment', function (event) {
                var id = $(this).attr("id");
                $("#parent_id").val(id);
                $("#sendCommentModal").modal();
            });
        });

    </script>
@endsection