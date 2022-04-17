<?php

namespace App\Models;

use App\Scopes\FiltersViala;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * This is the model class for table "{{%vaila}}".
 * @property int $id
 * @property string $title
 * @property string $desc
 * @property bool $new_arrivals
 * @property  bool $special
 * @property bool $has_pool,
 * @property bool $has_barbikio
 * @property bool $has_parcking
 * @property bool $for_shbab
 * @property  float $price
 * @property float $price_weekend
 * @property  float $price_hoolday
 * @property  integer $number_room
 * @property integer $number_booking
 * @property  bool $status
 * @property  bool $user_id
 * @property  integer $governorate_id
 * @property  bool $garden
 * @property  bool conditioners
 * @property  bool $kitchen
 *  @property  bool $wifi
 * @property string $thumb
 *  @property string|null $lag
 *  @property string|null  $lat
 */

class Vaila extends  Model
{
    use SoftDeletes;
    protected  $table='vaila';

    protected $guarded = [];

    public  static function rules(){
        return [ "create"=>[
            'title_en' => 'required',
            'title_ar' => 'required',
            'title_he' => 'required',
            'desc_en' => 'required',
            'desc_ar' => 'required',
            'desc_he' => 'required',
            'price'=>'required|numeric',
            'area'=>'required|numeric',
            'price_weekend'=>'required|numeric',
            'price_hoolday'=>'required|numeric',
            'number_room'=>'required|numeric',
            'governorate_id'=>'required|numeric',
            'thumb'=>'required',
            'images'=>'required'
        ],
            "update"=>[
                'title_en' => 'required',
                'title_ar' => 'required',
                'title_he' => 'required',
                'desc_en' => 'required',
                'desc_ar' => 'required',
                'desc_he' => 'required',
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
        return self::orderBy('user_id', auth('api-jwt')->user()->id);
    }


    public static function nearby(){
        $lag=$_GET["lag"];
        $lat=$_GET["lat"];
        return self::whereRaw("ACOS(SIN(RADIANS('lag'))*SIN(RADIANS($lag))+COS(RADIANS('lat'))*COS(RADIANS($lat))*COS(RADIANS('longitude')-RADIANS($lag)))*6380 < 10")
        ->orderBy('number_booking','DESC');
    }


    public static function  get_next_id(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'vaila'");
        return $statement[0]->Auto_increment;
    }




    public function comments(){
        return $this->hasMany(Comments::class);
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
