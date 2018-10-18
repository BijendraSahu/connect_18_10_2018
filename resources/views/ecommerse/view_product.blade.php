@extends('layout.master.admin_master')


@section('content')

    <div class="grid-title">
        <h4><span class="semi-bold">Product Details</span></h4>
        <a href="{{url('/administrator/products')}}" class="btn btn-primary btn-cons">Go Back</a>
    </div>
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-body no-border"><br>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success-msg'))
                    <p class="alert alert-success">{{ Session::get('success-msg') }}</p>
                @endif
                <div class="form-group">
                    <label class="form-label bold">Name</label>
                    <div class="input-with-icon  right">
                        <label for="">{{$product->name}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label bold">Price</label>
                    <div class="input-with-icon  right">
                        <label for="">{{$product->price}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label bold">Image</label>
                    <div class="input-with-icon  right">
                        @if(isset($image))
                            <img src="{{url($image->image)}}" width="100px" height="100px" alt=""/>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <label class="form-label bold">Status</label>
                    <div class="input-with-icon  right">
                        <i class=""></i>
                        @if($product->status ==1)
                            Active
                        @else
                            InActive
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>
@stop