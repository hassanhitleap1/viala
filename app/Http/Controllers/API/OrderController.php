<?php

namespace App\Http\Controllers\API;


use App\Helper\AccountingHelper;
use App\Helper\FCM;
use App\Helper\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\BookingHistoryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\VailaResource;
use App\Models\Accounting;
use App\Models\Orders;
use App\Models\Paymants;
use App\Models\Vaila;
use DateTime;

class OrderController extends Controller
{


    public function __construct()
    {
           $this->middleware('jwt.verify')->only(['index','store','update','show','booking_history','book_naw','previous_booking','destroy']);
           $this->middleware('marchant')->only(['book_naw']);
   }



    public function booking_history(){
    
        $orders =Vaila::join('orders','orders.vaial_id','vaila.id')
            ->where( 'orders.user_id',auth('api-jwt')->user()->id)
            ->paginate(10);
        return BookingHistoryResource::collection($orders);
      
    }



    public function previous_booking(){
        $orders =Vaila::join('orders','orders.vaial_id','vaila.id')
            ->where( 'vaila.user_id',auth('api-jwt')->user()->id)
            ->paginate(10);
        return BookingHistoryResource::collection($orders);
    
    }


    public function previous_booking_byid($id){
        $orders =Vaila::join('orders','orders.vaial_id','vaila.id')
            ->where( 'vaila.id',$id)
            ->paginate(10);
        return BookingHistoryResource::collection($orders);
    
    }




    public function index(){
        return OrderResource::collection(Orders::paginate(10));
    }

    private function checkedVaila($request){
        return Orders::where('vaial_id',$request->vaial_id)
        ->where(function($q) use($request){

            $q->orwhere(function($q) use($request){
                $q->whereDate('form_date' ,'<=', $request->form_date);
                $q->whereDate('to_date' ,'>=', $request->form_date);
            });
           
            $q->orwhere(function($q) use($request){
                $q->whereDate('form_date' ,'<=', $request->to_date);
                $q->whereDate('to_date' ,'>=', $request->to_date);
            });
        })->get();
    }

    public function store(OrderRequest  $request){
        $order = $this->checkedVaila($request);    
        $vaial=Vaila::findOrfail($request->vaial_id);   
        $earlier = new DateTime($request->form_date);
        $later = new DateTime($request->to_date);
        $dayes_order= $later->diff($earlier)->format("%a") + 1; 
        $total_price=AccountingHelper::getPrice( $vaial) * $dayes_order;
        
    
        if($order->count()){
            $form_date=     date("Y-m-d", strtotime($order[0]->form_date)); 
            $to_date= date("Y-m-d", strtotime($order[0]->to_date)); 
            return response()->json([
                'success'=>false,
                "message" => "this villa not available booked from $form_date to $to_date",
                'errors' => [],
                'status' => 422,
                'data'=>$vaial
            ], 422);
        }
        $amount=0;
        
        foreach($request->paymants as $paymant){
            $amount+=$paymant['amount'];
        }

    
      
        $order =Orders::create([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'price'=>$total_price,
            'payment_type'=>'mix',
            'vaial_id'=>$request->vaial_id,
            'user_id'=> auth('api-jwt')->user()->id
        ]);



        
        foreach($request->paymants as $paymant){
            $paymantModel = new Paymants();
            $paymantModel ->type	=$paymant['type'];
            $paymantModel ->amount	=$paymant['amount'];
            $paymantModel->order_id=$order->id;
            $paymantModel->save();
        }

       
        $calculation=AccountingHelper::calculation_order($total_price);

        Accounting::create([
            'for_me'=>$calculation['for_me'],
            'for_app'=>$calculation['for_app'],
            'user_id'=>auth('api-jwt')->user()->id
        ]);
        $viala=Vaila::find($request->vaial_id);
        $viala->number_booking= $viala->number_booking + 1;
        $viala->save();
        NotificationHelper::booking_notify($order->merchant,1,auth('api-jwt')->user(),$request->form_date,$request->to_date);
        //MakeOrderEvent::dispatch($order);
        $order['merchant']=$order->merchant;
        return response()->json([
            'success'=>true,
            'status' => 201,
            'data'=>$order
        ], 422);

        
        return new OrdersResource($order);
    }


    

    public function book_naw(OrderRequest  $request){

        $order = $this->checkedVaila($request);    
        $vaial=Vaila::findOrfail($request->vaial_id);  
        
       
        if($order->count()){
            $form_date=     date("Y-m-d", strtotime($order[0]->form_date)); 
            $to_date= date("Y-m-d", strtotime($order[0]->to_date)); 
            return response()->json([
                'success'=>false,
                "message" => "this vaial not available booked from $form_date to $to_date",
                'errors' => [],
                'status' => 422,
                'data'=>$vaial
            ], 422);
        }

   
     
        $order =Orders::create([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'price'=>0,
            'payment_type'=>'mix',
            'vaial_id'=>$request->vaial_id,
            'user_id'=> auth('api-jwt')->user()->id
        ]);
       

        $vaial->number_booking= $vaial->number_booking + 1;
        $vaial->save();
        //MakeOrderEvent::dispatch($order);
        $order['merchant']=$order->merchant;
        return response()->json([
            'success'=>true,
            'status' => 201,
            'data'=>$order
        ], 422);

        
        return new OrdersResource($order);

    }


    public function show(Orders $order){
        return new OrdersResource($order);
    }

    public function update(Orders $order,OrderRequest $request){

        $admin= tap($order)->update([
            'form_date'=>$request->form_date,
            'to_date'=>$request->to_date,
            'phone'=>$request->phone,
            'type'=>$request->price,
            'vaial_id'=>$request->vaial_id
        ]);

        return new OrdersResource($admin);
    }


    public function destroy(Orders $order){
        $order->delete();
        return Response('',201);
    }



}
