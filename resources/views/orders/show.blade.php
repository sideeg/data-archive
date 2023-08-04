@extends('main')
@section('title', '| Order Details')
@section('content')
 
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">{{$order->pation_name}} التفاصيل</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            
            <div class=" col-md-9 col-lg-12 ">
              <table class="table table-user-information">
                <tbody class="text-dir">

                    <a href="{{ URL::to('/orders/pdf/'.$order->id) }}" class="btn btn-primary"> PDFاستخراج كملف </a>

                  <tr>
                    <td>{{$order->pation_name}}</td>
                    <td>اسم المالك</td>
                    
                  </tr>

                  <tr>
                    <td>{{$order->phone}}</td>
                    <td>رقم الهاتف</td>
                    
                  </tr>

                  @if($order->another_phone)
                  <tr>
                    <td>{{$order->another_phone}}</td>
                    <td>رقم هاتف احتياطي</td>
                    
                  </tr>
                  @endif

                  @if($order->location_description)
                  <tr>
                    <td>{{$order->location_description}}</td>
                    <td> وصف الموقع</td>
                    
                  </tr>
                  @endif

                  @if($order->prescription_photo)
                  <tr>
                    <!-- <td>صورة الاورنيك</td> -->
                  <td>
                    
                                 
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prescription_photo">
                     صورة الاورنيك
                  </button>

            
                  <div class="modal fade" id="prescription_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <img class="modal_img_size" src="/images/{{$order->prescription_photo}}" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                                      
                                    
                  </td>
                  </tr>
                  @endif


                  @if ($order->medicine_name)
                  <tr>
                     <td>{{$order->medicine_name}}</td>
                    <td>اسم الجار</td>
                   
                  </tr>
                  @endif

                  <tr>
                     @if ($order->insurance == 1)
                        <td>نعم</td>
                      @else
                        <td>لا</td>
                      @endif
                      <td>هل يوجد كروكي؟</td>
                     
                  </tr>

                  <tr>
                    @if($order->insurance_card_photo)
                    <!-- <td> صورة الكوركي</td> -->
                    <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insurance_card_photo">
                      صورة الكوركي
                    </button>

                    <div class="modal fade" id="insurance_card_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img class="modal_img_size" src="/images/{{$order->insurance_card_photo}}" alt="">
                         
                          </div>
                        </div>
                      </div>
                    </div>   
                  </td>                                       
                    @endif
                  </tr>

                  <tr>
                    <td>{{$order->orderStatus->order_status}}</td>
                    <td>اسم القرية</td>
                  </tr>

                </tbody>
              </table>

             <a href="{{Route('orders.index')}}" class="btn btn-default">كل الاراضي</a>

            </div>
          </div>
        </div>
          <div class="panel-footer">
              <a href="{{route('orders.edit', $order->id)}}" type="button" class="btn btn-warning"><span>تعديل الملف</span></a>
              <span class="pull-right">
                <form action="{{ route('orders.destroy', $order->id)}}" method="POST">
                    {{method_field('DELETE')}}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="حذف الملف"/>
                </form>

              </span>
          </div>
      </div>
    </div>
  </div>

@endsection