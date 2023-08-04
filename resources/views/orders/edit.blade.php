@extends('main')
@section('title', '| Edit Order')
@section('content')
 
<div class="container">
    <h1 class="text-center">تعديل {{$order->pation_name}}</h1><br>
 
    <div class="row">
      <div class="col-lg-6">
        <form action="{{ route('orders.cancel', $order->id) }}" method="post">
          @csrf
          {{ method_field('PUT') }}
          <div class="form-group">
            <input type="submit" value="حذف الملف" class="form-control btn-danger">
          </div>
          
        </form>
      
        <form action="{{ route('orders.comment', $order->id) }}" method="post">
          @csrf
          {{ method_field('PUT') }}
          <div class="form-group">
            <input type="submit" value="تجاهل" class="form-control btn-warning">
          </div>
          
        </form>
    
        <!-- <form action="{{ route('orders.proccess', $order->id) }}" method="post">
          @csrf
          {{ method_field('PUT') }}
        <div class="form-group"> 
          <input type="submit" value="
          @switch($order->order_status_id)
              @case(1)
              proccess
              @break

              @case(2)
              pharmacy
              @break
    
              @case(3)
              deleviry
              @break

              @case(4)
              pharmacy
              @break

              @default
              disabled

          @endswitch"
          class="form-control btn-success"
          @if($order->order_status_id == 5 || $order->order_status_id == 6) disabled @endif></div>
        </form> -->
      <form method="post" action="{{ route('orders.update', $order->id) }}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
          <label>اسم مالك القطعة</label>
        <input type="text" name="pation_name" class="form-control" dir="auto" placeholder=" اسم المالك" required value="{{ $order->pation_name }}">
        </div>

        <div class="form-group">
          <label> رقم الهاتف</label>
          <input type="number" name="phone" class="form-control" dir="auto" placeholder="Pation Phone" required value="{{ $order->phone }}">
        </div>

        <div class="form-group">
          <label> رقم الهاتف الاحتياطي</label>
          <input type="number" name="another_phone" class="form-control" dir="auto" placeholder=" رقم الهاتف الاحتياطي" value="{{ $order->another_phone }}" required>
        </div>
    
        <div class="form-group">
          <label>وصف الموقع</label>
          <input type="text" name="location_description" class="form-control" dir="auto" placeholder="Pation Phone" value="{{ $order->location_description }}" required>
        </div>

        

        <div class="form-group">
          <label>تغيير صورة الاورنيك</label>
          <input type="file" name="prescription_photo" class="form-control" dir="auto" >
        </div>

          <div class="form-group input_fields_wrap ">
            <div class="ques_card" >
            <label> اسم الجار</label>
            @if(count($medicines) == 0)
            <input type="hidden" name='ids[]' value="1" />
            <input type="text" placeholder=" اسم الجار الجنوبي" name="medicine_names[]" class="form-control" dir="auto" />
            <input type="text" placeholder="Effective Martials" name="materials[]" class="form-control" dir="auto"  />
            <input type="text" placeholder="Company" name="companies[]" class="form-control" dir="auto" />
            @else
              @foreach ($medicines as $medicine)
                  <input type="hidden" name='ids[]' value="{{$medicine->id}}" />
                  <input type="text" placeholder="اسم الجار" name="medicine_names[]" class="form-control" dir="auto" value="{{ $medicine->name }}" />
                  <input type="text" placeholder="الجهة التي يحدها" name="materials[]" class="form-control" dir="auto" value="{{ $medicine->effective_material }}" />
                  <input type="text" placeholder="اي معلومات اضافية" name="companies[]" class="form-control" dir="auto" value="{{ $medicine->company_name }}" />
           
                  @endforeach
            @endif
            </div>
          </div>
          <a href="" data-method="delete" data-token="{{csrf_token()}}" data-confirm="هل انت متأكد؟">حذف الجار</a>
          <a class="btn btn-warning btn-block add_field_button">اضافة جار جديد</a>

          <div class="form-group">
            <label> اسم القرية</label>
            <select name="order_status_id" class="form-control" name="insurance">
                @foreach ($orders_status as $status)
                <option value="{{$status->id}}"
                  @if( $status->id == $order->order_status_id ) selected='selected' @endif
                  >{{$status->order_status}}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>الكوركي</label>
            <select class="form-control insurance_status" name="insurance">
                {{-- <option value="0"> لايوجد كوركي</option> --}}
                <option value="{{$order->insurance}}">{{$order->insurance == 1 ? 'Insurance' : 'No Insurance'}}</option>
                <option value="0">لايوجد كوركي </option>
                <option value="1">يوجد كوركي</option>
            </select>
          </div>

        <div class="form-group insurance_input">
            <label> تعديل صورة الكوركي</label>
            <input type="file" name="insurance_card_photo" class="form-control" dir="auto" >
        </div>

        <!-- <div class="form-group">
          <label>Delivert Time</label>
          <select class="form-control" name="delivery_time_id" >
             @if($order->delivery_time_id)
                 <option  value="{{$order->deliveryTime->id}}">{{$order->deliveryTime->delivery_time}}</option>
             @endif
             
              @foreach ($delivery_time as $time)
                <option value="{{$time->id}}">{{$time->delivery_time}}</option>
              @endforeach
          </select>
        </div> -->
      
        <div class="form-group">
          <input type="submit" value="تعديل الملف" class="form-control btn btn-success btn-block text">
        </div>
      
      </form>
      </div>
      <div class="col-lg-6">
        {{-- <div
          id="map_canvas"
          style="height: 600px;width: 800px;margin: 0.6em;"
        ></div> --}}
        <img 
          style="   
          width: 116%;
          height: 450px;
          margin-top: 25px;" 
          src="/images/{{$order->prescription_photo}}" 
        alt="prescription photo">
        <img style="    
          width: 116%;
          height: 450px;
          margin-top: 25px;" 
          src="/images/{{$order->insurance_card_photo}}" 
        alt="insurance card photo">
      </div>
    </div>  
</div>
{{-- <script src="https://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  var map;
  var marker;
  function initMap() {

    let order = <?php echo $order; ?>

    let lat = (order.lat) ? order.lat : 15.525981;
    let lng =  (order.lng) ? order.lng : 32.560911;
    var latlng = new google.maps.LatLng(lat, lng),
      image =
        "http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png";

    //zoomControl: true,
    //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,

    var mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        panControl: true,
        panControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: true,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.LARGE,
          position: google.maps.ControlPosition.TOP_left
        }
      },
      map = new google.maps.Map(
        document.getElementById("map_canvas"),
        mapOptions
      ),
      marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: image
      });

    var input = document.getElementById("searchTextField");
    var autocomplete = new google.maps.places.Autocomplete(
      input,
      {
        types: ["geocode"]
      }
    );

    autocomplete.bindTo("bounds", map);
    var infowindow = new google.maps.InfoWindow();

    google.maps.event.addListener(
      autocomplete,
      "place_changed",
      function(event) {
        infowindow.close();
        var place = autocomplete.getPlace();
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);
        }

        moveMarker(place.name, place.geometry.location);
        $("#lat").val(place.geometry.location.lat());
        $("#lng").val(place.geometry.location.lng());
      }
    );
    google.maps.event.addListener(map, "click", function(
      event
    ) {
      placeMarker(event.latLng);
      $("#lat").val(event.latLng.lat());
      $("#lng").val(event.latLng.lng());
      infowindow.close();
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode(
        {
          latLng: event.latLng
        },
        function(results, status) {
          console.log(results, status);
          if (status == google.maps.GeocoderStatus.OK) {
            console.log(results);
            var lat = results[0].geometry.location.lat(),
              lng = results[0].geometry.location.lng(),
              placeName =
                results[0].address_components[0].long_name,
              latlng = new google.maps.LatLng(lat, lng);

            moveMarker(placeName, latlng);
            $("#searchTextField").val(
              results[0].formatted_address
            );
          }
        }
      );
    });

    function placeMarker(location) {
      if (marker) {
        marker.setPosition(location);
      } else {
        marker = new google.maps.Marker({
          position: location,
          map: map
        });
      }
    }
    function moveMarker(placeName, latlng) {
      marker.setIcon(image);
      marker.setPosition(latlng);
      infowindow.setContent(placeName);
      //infowindow.open(map, marker);
    }
  }
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7t1K3XV0Bw0_I07Y_o1Pzg9M1Y2KUfsU&callback=initMap"
  async
></script>  --}}
@endsection
