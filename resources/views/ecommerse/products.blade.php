@extends('layout.master.admin_master')

@section('title', 'Products List')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Products List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords">
                            <a href="#" class="btn btn-primary create-add">Create Product</a>
                            <span class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($products)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr>
                                <th class="hidden">id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                            </tbody>
                            <tbody>
                            @foreach ($products as $product)
                                <tr class="odd gradeX">
                                    <td class="hidden">{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{"Rs.".$product->price."/-"}}</td>
                                    <td>{{isset($product->description)?$product->description:'-'}}</td>
                                    @if (isset($product->image) > 0)
                                        <td><img style="width:100px;" src="{{url($product->image)}}"
                                                 data-img="{{$product->image}}" alt="" class="superbox-img"></td>
                                    @else
                                        <td><img style="width:100px;"
                                                 src="{{url(''). '/assets/img/img_not_available.png'}}"
                                                 data-img="{{url(''). '/assets/img/img_not_available.png'}}" alt=""
                                                 class="superbox-img"></td>
                                    @endif
                                    @if($product->is_active=='0')
                                        <td>
                                            <span class="label label-danger">InActive</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="label label-success">Active</span>

                                        </td>
                                    @endif
                                    <td>
                                        <a href="#" id="{{$product->id}}" onclick="edit_product(this);">
                                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                        </a>
                                        <a href="#" id="{{$product->id}}"
                                           onclick="ShowConformationPopupMsg('Are you sure you want to delete this ad');"
                                           class="btn btn-danger btn-sm btnDelete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "columnDefs": [
                    {"width": "20px", "targets": 0}
                ],
                "order": [[0, "desc"]]
            });

            $('.datatable-col').on('keyup change', function () {
                table.column($(this).attr('id')).search($(this).val()).draw();
            });
        });

        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/delete_product/" + id;
            $('#ConfirmBtn').attr("href", append_url);
        });

        $(".create-add").click(function () {
            $('#myModal').modal('show');
            $('#modal_title').html('Create New Product');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('create_product') }}",
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                }
            });

        });

        function edit_product(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('Edit Product');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            //alert(id);
            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/edit_product/" + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }
    </script>
@stop