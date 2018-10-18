<div class="container-fluid">
    <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
        <tbody>
        <tr class="tr-header globe-header-tr">
            <th class="width_25">Item Image</th>
            <th class="width_25">Item Name</th>
            <th class="width_10">Qty</th>
            <th class="width_12">Price</th>
            <th class="width_12">Total</th>
            <th class="width_15">Cancelled Status</th>
        </tr>
        </tbody>
        <tbody id="ListContainerSection">
        @if(count($orders)>0)
            @foreach($orders as $order)
                @php
                    $item = \App\ItemMaster::find($order->item_master_id);
                @endphp
                <tr>
                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                        <img style="width: 60%;" src="{{url('').'/'.$item->image}}" alt="Product">
                    </td>
                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                        {{$item->name}}
                    </td>

                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                        {{$order->qty}}
                    </td>
                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                        {{$order->unit_price}}
                    </td>
                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                        {{$order->total}}
                    </td>

                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                        {{$order->is_cancelled=='1'?'Cancelled by user':'-'}}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">
                    <span class="list_no_record">< No Record Available ></span>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
