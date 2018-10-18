<script src="{{ url('js/validation.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>
{!! Form::open(['url' => 'update_product/'.$product->id, 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'put', 'files'=>true]) !!}
<div class="container-fluid">
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="_TypeName3">Product Name :</div>
        </div>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control required" placeholder="Enter Name"
                   data-validate="Btn_advertise" value="{{$product->name}}"
                   maxlength="250" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="_TypeName2">Product Price :</div>
        </div>
        <div class="col-sm-10">
            <input type="text" name="price" class="form-control amount required" placeholder="Enter Price"
                   data-validate="Btn_advertise" value="{{$product->price}}"
                   maxlength="250" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="_TypeName1">Product Description* :</div>
        </div>
        <div class="col-sm-10">
            <textarea type="text" name="description" class="form-control" placeholder="Enter Description"
                      data-validate="Btn_advertise"
                      maxlength="250" autocomplete="off">{{$product->description}}</textarea>
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt">Upload Image :</div>
        </div>
        <div class="col-sm-10">
            <div class="com-block file_upload_box">
                <input type="file" accept=".png,.jpg, .jpeg, .gif" class="file_upload" name="image"
                       id="advertise_Image"
                       onchange="ShowAdverImage(this, adver_uploadimg, advertise_close);"/>
                <div class="view-uploaded-file">
                    <img src="{{url('').'/'.$product->image}}" id="adver_uploadimg">
                    <div class="upload_imgclose mdi mdi-close" id="advertise_close"
                         onclick="RemoveAdvertise(this, adver_uploadimg, advertise_Image)"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="basic_lb_row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-9">
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
