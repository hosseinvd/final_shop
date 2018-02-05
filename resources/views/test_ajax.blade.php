<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}" crossorigin="anonymous">

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    {{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
    <title>Ajax_Test</title>
</head>
<body>
<br>
<div class="conteiner">


    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title<a href="#" id="add_new_icon" class="pull-right" data-toggle="modal"
                                                          data-target="#myModal"><i class="fa fa-plus"
                                                                                    aria-hidden="true"></i></a></h3>
                </div>
                <div class="panel-body" id="ctrl_data">
                    <div class="list-group" id="response">
                        @foreach($items as $item)
                            <button type="button" class="list-group-item ouritem" id="{{$item->id}}" data-toggle="modal"
                                    data-target="#myModal">{{$item->item}}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="title">Add Item</h4>
            </div>
            <div class="modal-body">
                <p><input type="text" placeholder="write_items" id="add_item" tabindex="1" class="form-control"></p>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>--}}
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                <button type="button" class="btn btn-primary" id="add_btn" style="display: none" data-dismiss="modal">Add Item</button>
                <button type="button" class="btn btn-warning" id="delete_item" style="display: none">delete Item</button>
                <button type="button" class="btn btn-success" id="save_item" style="display: none">save cheange</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{--{{csrf_field()}}--}}


<div class="product_vmegamenu">
    <ul>
        <li>
            <a href='#'>one</a>
            <div class='vmegamenu'>
                <span>
                <a href='#' class='vgema-title'>two</a>
                <a href='#'>four</a>
                </span>
            </div>
        </li>
        <li>
            <a href='#'>five</a>
            <div class='vmegamenu'>
            </div>
        </li>
        <li>
            <a href='#'>وسایل منزل</a>
            <div class='vmegamenu'>
                <span>
                <a href='#' class='vgema-title'>وسایل برقی</a>
                <a href='#'>وسایل برقی شارژی</a>
                </span>
            </div>
        </li>


    </ul>
</div>

@include('sweet::alert')
</body>


<script>
    //                var text=$(this).attr("id");

    $(document).ready(function () {
        $(".ouritem").each(function () {
            $(this).click(function (event) {

                swal("Here's a message!", "It's pretty, isn't it?")
                var text = $(this).text();
                $("#add_item").val(text);
                var id=$(this).attr("id");
                $("#title").text(id);
                $("#delete_item").show("400");
                $("#save_item").show("400");
                $("#add_btn").hide();
            });
        });

        $("#add_new_icon").click(function (event) {

            $("#add_item").val(" ");
            $("#title").text("add new item");
            $("#delete_item").hide("400");
            $("#save_item").hide("400");
            $("#add_btn").show();
        });
        $('#add_btn').click(function (event) {
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var text=$("#add_item").val();
            $.post("/ta",{'text':text,_token: CSRF_TOKEN},function (data) {
//                $('#ctrl_data').load(location.href+' #ctrl_data');
//                console.log(data);
//                $("#response").html(data);
                $('#ctrl_data').load("/ta #ctrl_data");
            });
        })
    });
</script>


</html>