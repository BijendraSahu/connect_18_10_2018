<script src="{{ url('js/validation.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>
<div class="container-fluid">
    <div class="col-sm-6">
        <div class="basic_lb_row">
            <div class="col-sm-4">
                <div class="Lb-title-txt" id="_TypeName">Profession:</div>
            </div>
            <div class="col-sm-8">
                <p></p>
                <label for="">{{$reg->profession}}</label>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-4">
                <div class="Lb-title-txt" id="_TypeName">Earning:</div>
            </div>
            <div class="col-sm-8">
                <p></p>
                <label for="">
                    <?php
                    $com = new \App\com();
                    $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $reg->id)->get();
                    // Sum up all earnings
                    $total = 0;
                    foreach ($getTotalEarningsByPID as $Ttl) {
                        $total = $total + $Ttl->Com;
                    }
                    ?>
                    {{$total}}
                </label>
            </div>
        </div>


    </div>
    <div class="col-sm-6">
        <div class="basic_lb_row">
            <div class="col-sm-4">
                <div class="Lb-title-txt" id="_TypeName">Date Of Birth:</div>
            </div>
            <div class="col-sm-8">
                <p></p>
                <label for="">{{ date_format(date_create($reg->birthday), "d-M-Y")}}</label>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-4">
                <div class="Lb-title-txt" id="_TypeName">Member Type:</div>
            </div>
            <div class="col-sm-8">
                <p></p>
                <label for="">{{$reg->member_type}}
                </label>
            </div>
        </div>
    </div>
</div>
