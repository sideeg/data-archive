<?php

namespace App\Http\Controllers;

use App\Order;
use Pusher\Pusher;
use App\Medication;
use App\OrderStatus;
use App\DeliveryTime;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
 
    public function index(Order $order,Request $request)
    {

        //We will use datatable to display data by using index_data function
        // $orders = Order::paginate(10);
        // return view('orders.index', compact('orders'));
        $orders_status = OrderStatus::orderBy('id', 'asc')->get();
        // $orders = Order::all();
        $orders = Order::get();
        if ($request->get('status')) {
            $orders = Order::where('order_status_id', $request->get('status'))
            ->get();
        }

        
        return view('orders.index', compact('orders_status','orders'));

    }

    public function index_data(Request $request)
    {
        $orders = Order::get();
        if ($request->get('status')) {
            $orders = Order::where('order_status_id', $request->get('status'))
            ->get();
        }

        return DataTables::of($orders)
        ->addColumn('medicine_name', function($order) {
            $medicines = Medication::where('order_id', $order->id)->get();
            $names = '';
            foreach ($medicines as $key => $medicine) {
                $names .= $medicine->name .', ';
            }
            return $names;
        })
        ->addColumn('prescription_photo', function($order) {
            return '<img src="'.$order->prescription_photo_full_path.'" style="width:50px"/>';
        })
        ->addColumn('insurance_card_photo', function($order) {
            return '<img src="'.$order->insurance_card_photo_full_path.'" style="width:50px"/>';
        })
        ->addColumn('status', function($order) {
            return $order->orderStatus->order_status;
        })
        ->addColumn('created_at', function($order) {
            return $order->created_at->diffForHumans();
        })
        ->addColumn('view', function ($order) {
            $action = '';
            $action .='<a href="/orders/'.$order->id.'" class="btn btn-xs btn-success"><i class="fa fa-eye" aria-hidden="true"></i>View</a>';
            ;
            return $action;
        })
        ->addColumn('edit', function ($order) {
            $action = '';
            $action .= '<a href="/orders/'.$order->id.'/edit" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>Edit</a>';
            ;
            return $action;
        })
        ->editColumn('id', '{{$id}}')
        ->rawColumns(['prescription_photo','insurance_card_photo','view', 'edit'])
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                $orders_status = OrderStatus::orderBy('id', 'asc')->get();

        return view('orders.create', compact('orders_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Validator::make($request->all(),[
            'pation_name'           => ['required','string'],
            'phone'                 => ['required','integer'],
            'another_phone'         => ['sometimes','nullable'],
            'location_description'  =>['sometimes','nullable'],
            'prescription_photo'    => ['sometimes','nullable','image','mimes:jepg,png,jpg,gif,svg', 'max:4096'],
            'medicine_name'         => ['sometimes','nullable'],
            'insurance_card_photo'  => ['sometimes','nullable','image','mimes:jepg,png,jpg,gif,svg', 'max:4096'],
            'insurance'             => ['in:1,0'],
            'order_status_id' => ['nullable'],
            'delivery_time_id'         => ['sometimes','nullable'],
         ]);
        $request['employee_id'] = 1;
        // $request['order_status_id'] = 1;


        $input = $request->all();
        $order = Order::create($input);

        $order->medicine_name = $input['medicine_names'];

        $order->save();

        $medicines = $input['medicine_names'];
        $materials = $input['materials'];
        $companies = $input['companies'];

        foreach ($medicines as $key => $medicine) {
            Medication::create([
                'effective_material'=> $materials[$key],
                'name' => $medicine,
                'order_id' => $order->id,
                'company_name'=> $companies[$key],
                'medication_status_id' => 1
            ]);
        }
        

        $images_names = ['prescription_photo','insurance_card_photo'];

        foreach($images_names as $image){

            if ($request->file($image)){

                $image_name = md5($order->id."app".$order->id . rand(1,1000));
            
                $image_ext = $request->file($image)->getClientOriginalExtension(); // example: png, jpg ... etc
                
                $image_full_name = $image_name . '.' . $image_ext;
        
                $uploads_folder =  getcwd() .'/images/';
        
                if (!file_exists($uploads_folder)) {
                    mkdir($uploads_folder, 0777, true);
                }
                 
    
                $request->file($image)->move($uploads_folder, $image_name  . '.' . $image_ext);
                
    
               $order->{$image} =  $image_full_name;
            }
        }

        $order->save();

        if ($order->medicine_name) {

            $message= $order;
            $this->pushNotinfication($message);
            
        }
     
        // dd($order);
        Session::flash('نجاح', 'تم إضافة الملف الجديد بنجاح');

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $delivery_time = DeliveryTime::latest()->get();
        $orders_status = OrderStatus::get();
        $medicines = Medication::where('order_id', $order->id)->get();
        return view('orders.edit', compact('order','orders_status','medicines', 'delivery_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $order = Order::find($id);
        $this->validate($request,[
            'pation_name'           => ['required'],
            'phone'                 => ['required'],
            'another_phone'         => ['nullable'],
            'medicine_name'         => ['sometimes','nullable'],
            'location_description'  =>['nullable'],
            'insurance'             => ['in:1,0'],
            'order_status_id'       => ['nullable'],
            'delivery_time_id'      => ['sometimes','nullable'],
        ]);
        
        $input = $request->all();
        $order->update($input);

        $medicines = $input['medicine_names'];

        $order->medicine_name = $input['medicine_names'];

        $order->save();

        $ids = $input['ids'];
        $materials = $input['materials'];
        $companies = $input['companies'];

        $old_medicines = Medication::where('order_id', $order->id )->get();

        
        foreach ($medicines as $index => $medicine) {
            if($index+1 <= count($old_medicines)){
                $old_medicine = Medication::find($ids[$index]);

                if ($order->order_status_id == 4) {
                    $old_medicine->update([
                        'name' => $medicine,
                        'effective_material'=> $materials[$index],
                        'company_name' => $companies[$index],
                        'medication_status_id' => 1
                    ]);
                    // dd($old_medicine);
                } elseif($order->order_status_id == 7)
                {
                    $old_medicine->update([
                        'name' => $medicine,
                        'effective_material'=> $materials[$index],
                        'company_name' => $companies[$index],
                        'medication_status_id' => 4
                    ]);
                }else {
                     $old_medicine->update([
                    'name' => $medicine,
                    'effective_material'=> $materials[$index],
                    'company_name' => $companies[$index],
                ]);
                }
               
                $old_medicine->save();

                if ($old_medicine) {
                    $message= $old_medicine;
                    $this->pushNotinfication($message);
                } 
              
            }else{
                Medication::create([
                    'effective_material'=> $materials[$index],
                    'name' => $medicine,
                    'order_id' => $order->id,
                    'company_name' => $companies[$index],
                    'medication_status_id'=>1
                ]);
            }
        }

        $files_names = [
            'prescription_photo',
            'insurance_card_photo'
        ];

        foreach($files_names as $file){
            
            if ($request->file($file)){
    
                $file_name = md5($order->id."store".$order->id . rand(1,1000));
                        
                $file_ext = $request->file($file)->getClientOriginalExtension(); // example: png, jpg ... etc
                
                $file_full_name = $file_name . '.' . $file_ext;
        
                $uploads_folder =  getcwd() .'/images/';
        
                if (!file_exists($uploads_folder)) {
                    mkdir($uploads_folder, 0777, true);
                }
                
    
                $request->file($file)->move($uploads_folder, $file_name  . '.' . $file_ext);
                
    
                $order[$file] =  $file_full_name;
    
            }
        }

        $order->save();

      
        // dd($order);
        Session::flash('success', 'this order successfully updated!');

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Storage::disk('public')->delete("images/$order->prescription_photo");
        Storage::disk('public')->delete("images/$order->insurance_card_photo");

        $order->delete();

        Session::flash('delete','This Order Was successfully deleted');
        return redirect()->route('orders.index');
    }


    public function export_pdf($id)
    {

        $data = Order::find($id);

        $pdf = PDF::loadView('pdf',compact('data'));

        return $pdf->download('order.pdf');
    }


    public function proccess($id)
    {
        $data = Order::find($id);

        if ($data->order_status_id == 1) {
            $data->order_status_id = 2;
            $data->save();

        } elseif ($data->order_status_id == 2) {
            $data->order_status_id = 3;
            $data->save();

        } elseif ($data->order_status_id == 3) {
            $data->order_status_id = 4;     
            $data->save();

        } elseif ($data->order_status_id == 4) {
            $data->order_status_id = 3;
            $data->save();
        }

        return back();
    }

    public function cancel($id)
    {
        $data = Order::find($id);

        $data->order_status_id = 6;

        $data->save();

        return back();
    }

    public function comment($id)
    {
        $data = Order::find($id);

        $data->order_status_id = 5;

        $data->save();

        return back();
    }

    protected function pushNotinfication($message)
    {

        $options = array(
            'cluster' => 'us2', 
            'encrypted' => true
        );

       //Remember to set your credentials below.
        $pusher = new Pusher(
            '34cf47ca040d847b0d9c',
            'ee37d436e8a2dac80281',
            '998874',
            $options
        );
		
        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('afia-orders', 'afia-event', $message);  
    }
}