@php $count = 1;  @endphp
<select name="city" class="form-control" id="city_id">
    @foreach($cities as $city)
        <option value="{{$city->City}}" {{isset($scity)? $city->City == $scity ?'selected':'':''}}>{{$city->City}}</option>
        @php $count++;  @endphp
    @endforeach
</select>