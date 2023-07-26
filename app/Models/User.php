<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Stripe\Issuing\Transaction;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
        'image',
        'type',
        'user_type',
        'description',
        'country_code',
        'email_verified_at',
        'created_at',
        'updated_at'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array

     */

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    // public function getImageAttribute()
    // {
    //     if (isset($this->attributes['image']) && !empty($this->attributes['image']))
    //         return 'https://198.211.99.129/laundry/public' . $this->attributes['image'];
    // }
    public function getCreatedAtAttribute()
    {
        return  Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
    public function getEmailVerifiedAtAttribute()
    {
        $date1 = $this->attributes['email_verified_at'];
        $date2 = Carbon::now();

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        $day1 = date('d', $ts1);
        $day2 = date('d', $ts2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        if ($diff > 0) {
            if ($diff >= 12) {
                $diff = round($diff / 12) . ' years';
            } else {
                $diff = $diff . ' months';
            }
        } else {
            $diff = $day2 - $day1;
            if ($diff > 1) {
                $diff = $diff . ' Days.';
            } else {
                $diff = $diff . ' Day.';
            }
        }
        return  $diff;
    }
    public function shop()
    {
        return $this->hasOne(Shops::class, 'user_id', 'id')->with('shopcategories');
    }
    // public function userOrders()
    // {
    //     return $this->hasMany(Orders::class, 'user_id', 'id')->count();
    // }
    // public function userOrdersCount()
    // {
    //     return $this->hasMany(Orders::class, 'user_id', 'id')->count();
    // }
}
