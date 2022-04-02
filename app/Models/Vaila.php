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
        return [
            'title' => 'required',
            'desc' => 'required',
 //           'new_arrivals' => 'required',
 //           'special'=>'required',
//            'has_pool'=>'required',
//            'has_barbikio'=>'required',
//            'has_parcking'=>'required',
//            'for_shbab'=>'required',
            'price'=>'required|numeric',
            'price_weekend'=>'required|numeric',
            'price_hoolday'=>'required|numeric',
            'number_room'=>'required|numeric',
            'governorate_id'=>'required|numeric',
 //           'garden'=>'required',
  //          'conditioners'=>'required',
   //         'kitchen'=>'required',
   //         'wifi'=>'required',
            'thumb'=>'required',
            'images'=>'required'
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
