<?php

namespace App\Models;

use App\Scopes\FiltersViala;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;



class Vaila extends  Model
{
    use SoftDeletes;
    protected  $table='vaila';

    protected $guarded = [];

    public  static function rules(){
        return [ "create"=>[
            'title_en' => 'required',
            'title_ar' => 'required',
            'desc_en' => 'required',
            'code' => 'required',
          
            'price_weddings'=> 'required',
            'retainer'=> 'required',
            'entry_hour'=>'required',
            'out_hour'=>'required',
            'desc_ar' => 'required',
            'price'=>'required|numeric',
            'area'=>'required|numeric',
            'price_weekend'=>'required|numeric',
            'price_hoolday'=>'required|numeric',
            'number_room'=>'required|numeric',
            'governorate_id'=>'required|numeric',
            'thumb'=>'required',
            'images'=>'required',
        ],
            "update"=>[
                'title_en' => 'required',
                'title_ar' => 'required',
                'code' => 'required',
         
                'price_weddings'=> 'required',
                'retainer'=> 'required',
                'entry_hour'=>'required',
                'out_hour'=>'required',
               
                'desc_en' => 'required',
                'desc_ar' => 'required',
               
                'area'=>'required|numeric',
                'price'=>'required|numeric',
                'price_weekend'=>'required|numeric',
                'price_hoolday'=>'required|numeric',
                'number_room'=>'required|numeric',
                'governorate_id'=>'required|numeric',

            ]
        ];
    }


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FiltersViala());
    }


    public static function newArival(){
        return self::where('new_arrivals',1);
    }


    public static function bestSell(){
        return self::orderBy('number_booking','DESC');
    }

    public static function myViala(){
        return self::where('vaila.user_id', auth('api-jwt')->user()->id);
    }


    public static function nearby(){
        $lag=$_GET["lag"];
        $lat=$_GET["lat"];
        return self::
        //sqrt(power(source_lat - lat, 2) + power(source_long - long, 2))
       // whereNotNull('lag')->whereNotNull('lat')
        //whereRaw("ACOS(SIN(RADIANS('lag'))*SIN(RADIANS($lag))+COS(RADIANS('lat'))*COS(RADIANS($lat))*COS(RADIANS('lang')-RADIANS($lag)))*6380 < 10")
        orderByRaw("sqrt(power(vaila.lag - $lat, 2) + power(vaila.lag - $lag, 2))")
        ->orderBy('number_booking','DESC');
    }


    public static function  get_next_id(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'vaila'");
        return $statement[0]->Auto_increment;
    }




    public function comments(){
        return $this->hasMany(Comments::class);
    }
    public function reservations(){
        return $this->hasMany(Orders::class,'vaial_id','id')->limit(3);
    }

    public function services(){
        return $this->hasMany(VaialServices::class)
            ->join('services','services.id','=','vaial_services.services_id');
    }


    public function orders(){
        return $this->hasMany(Orders::class)
        ->whereBetween('form_date', [date('Y-m-01'), date('Y-m-t')]);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function imagevaila(){
        return $this->hasMany(ImageVaila::class);
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }

    public function rates(){
        return $this->hasMany(Rate::class);
    }

}
