<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ملف</title>
</head>
<body>
    <h1> شهادة سكن</h1>

    <table>
        <tr>
          <td>{{$data->id}}</td>
          <td>رقم الملف</td>
            
          </tr>
        <tr>
            <td>{{$data->pation_name}}</td>
            <td>اسم الماك</td>
            
          </tr>

          <tr>
            <td>{{$data->phone}}</td>
            <td>رقم الهاتف</td>
            
          </tr>

          @if($data->another_phone)
          <tr>
            <td>{{$data->another_phone}}</td>
            <td>رقم هاتف احتياطي</td>
            
          </tr>
          @endif

          @if($data->location_description)
          <tr>
            <td>{{$data->location_description}}</td>
            <td> وصف الموقع</td>
            
          </tr>
          @endif

          @if ($data->medicine_name)
          <tr>
            <td>{{$data->medicine_name}}</td>
            <td>اسم الجار</td>
            
          </tr>
          @endif

          <tr>
              @if ($data->insurance == 1)
                <td>نعم</td>
              @else
                <td>لا</td>
              @endif
              <td>هل يوجد كوركي؟</td>
              
          </tr>


          <tr>
            <td>{{$data->orderStatus->order_status}}</td>
            <td>اسم القرية</td>
            
          </tr>
    </table>
</body>
</html>