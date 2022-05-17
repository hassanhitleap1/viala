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

    public  static function rules($id = null){
        return [ "create"=>[
            'title_en' => 'required|unique:vaila',
            'title_ar' => 'required|unique:vaila', 
            'entry_hour'=>'required',
            'out_hour'=>'required',
            'price'=>'required|numeric',
            'area'=>'numeric',
            'price_weekend'=>'required|numeric',
            'price_hoolday'=>'required|numeric',
            'number_room'=>'required|numeric',
            'governorate_id'=>'required|numeric',
            'thumb'=>'required',
            'images' => 'required',
            'images.*' => 'mimes:jpeg,jpg,png,gif'
        ],
            "update"=>[
                'title_en' => 'string|unique:vaila,title_en,'.$id,
                'title_ar' => 'string|unique:vaila,title_ar,'.$id, 
                'area'=>'numeric',
                'price'=>'numeric',
                'price_weekend'=>'numeric',
                'price_hoolday'=>'numeric',
                'number_room'=>'numeric',
                'governorate_id'=>'numeric',

            ]
        ];
    }


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new FiltersViala());
    }


    public static function newArival(){
        return self::where('new_arrivals',1)->where("vaila.active",1);;
    }


    public static function bestSell(){
        return self::orderBy('number_booking','DESC')->where("vaila.active",1);;
    }

    public static function myViala(){
        return self::where('vaila.user_id', auth('api-jwt')->user()->id)->where("vaila.active",1);;
    }


    public static function nearby(){
        $lag=$_GET["lag"];
        $lat=$_GET["lat"];
        return self::
        //sqrt(power(source_lat - lat, 2) + power(source_long - long, 2))
       // whereNotNull('lag')->whereNotNull('lat')
        //whereRaw("ACOS(SIN(RADIANS('lag'))*SIN(RADIANS($lag))+COS(RADIANS('lat'))*COS(RADIANS($lat))*COS(RADIANS('lang')-RADIANS($lag)))*6380 < 10")
        orderByRaw("sqrt(power(vaila.lag - $lat, 2) + power(vaila.lag - $lag, 2))")
        ->where("vaila.active",1)
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
