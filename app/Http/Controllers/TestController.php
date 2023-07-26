<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\Auth\RegisterVerificationMail;
use App\Mail\Orders\OrderApprovedMail;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Shops;
use App\Models\User;
use Carbon\Carbon;
use DB;


class TestController extends Controller
{


    function index($latitude = "30.7112384", $longitude = "76.6887369", $radius = 3000)
    {


        // $data =  password_verify('hello', 'sad');
        // echo $data;
        // die;
        $data =  $this->mail();
        // echo "<pre>";
        // print_r($data->orderQuantity[0]->shopsubcategory[0]->subcategory->shopcategory->title);
        // die;
        // Mail::to($data->user->email)->send(new OrderApprovedMail($data));


        Mail::raw('Hi, welcome user!', function ($message) {
            $message->to('sandeep@pixlerlab.com')
                ->subject('..');
        });
        die;
        $ifUserExists = User::find(1);
        try {
            Mail::to('sandeep@pixlerlab.com')->send(new RegisterVerificationMail($ifUserExists, 1212));

            return "Success";
        } catch (Exception $ex) {
            // Debug via $ex->getMessage();
            return "We've got errors!";
        }
        // try{



        //  }catch(\Swift_TransportException $transportExp){
        //    print_r($transportExp->getMessage());
        //  }
        // Mail::to($request->email)->send(new RegisterVerificationMail($user, $userlog->otp));
        // $date = date_create($data->delivery_date);
        // $date = date_format($date, "l, d F");
        // $data->delivery_date = $date;
        // return view('Mail.Orders.orderApproved', ['allOrderDetails' => $data]);
        die;
        // $date = Carbon::now()->addDays(1);
        // echo $date;
        // exit; 
        echo env('ASSET_URL');
        exit;
        $dat = $this->getOrderDetailsRaw(5);
        $subject = "Register Email Verification.";
        return view('Mail.Auth.registerSuccess', ['allOrderDetails' => $dat]);

        //         $daya = DB::select('SELECT * FROM
        //         (SELECT id, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
        //         cos(radians(longitude) - radians(' . $lng . ')) +
        //         sin(radians(' . $lat . ')) * sin(radians(latitude))))
        //         AS distance
        //         FROM shops) AS distances
        //     WHERE distance < ' . $circle_radius . '
        //     ORDER BY distance

        // ');

        $daya =     Shops::selectRaw(" *,
( 6371000 * acos( cos( radians(?) ) *
  cos( radians( latitude ) )
  * cos( radians( longitude ) - radians(?)
  ) + sin( radians(?) ) *
  sin( radians( latitude ) ) )
) AS distance", [$latitude, $longitude, $latitude])
            // ->where('active', '=', 1)
            ->having("distance", "<", $radius)
            ->orderBy("distance", 'asc')
            ->offset(0)
            ->limit(20)
            ->get();
        // echo "<pre>";
        // print_r($daya);
        // die;

        //         Shops::selectRaw("*,
        // ( 6371000 * acos( cos( radians(?) ) *
        //   cos( radians( latitude ) )
        //   * cos( radians( longitude ) - radians(?)
        //   ) + sin( radians(?) ) *
        //   sin( radians( latitude ) ) )
        // ) AS distance", [$latitude, $longitude, $latitude])->with(['shopSubcategoriesMinimumPrice', 'orderCount', 'avgRating', 'attachements', 'shopcategories', 'users'])
        //             ->whereHas('shopcategories', function ($q) use ($category) {
        //                 $q->where('category_id', '=', $category);
        //             })
        //             ->where(['status' => 'ACTIVE'])

        //             ->having("distance", "<", $radius)
        //             ->orderBy('distance', 'asc')
        //             ->limit($offset)

        //             ->get();
        //     $category = 3;
        //     $data = Shops::select(
        //         "shops.*",
        //         DB::raw("6371000 * acos(cos(radians(" . $latitude . ")) 
        // * cos(radians(shops.latitude)) 
        // * cos(radians(shops.longitude) - radians(" . $longitude . ")) 
        // + sin(radians(" . $latitude . ")) 
        // * sin(radians(shops.latitude))) AS distance")
        //     )->with(['attachements', 'shopcategories', 'users'])
        //         ->whereHas('shopcategories', function ($q) use ($category) {
        //             // Query the name field in status table
        //             $q->where('category_id', '=', $category); // '=' is optional
        //         })
        //         // ->where(['status' => 'ACTIVE'])
        //         // ->offset($offset)
        //         ->limit(20)
        //         ->orderBy('id', 'desc')
        //         ->get();
        //     // $data =    Shops::select()

        //     //     ->having("distance", "<", $radius)
        //     //     ->orderBy("distance", 'asc')
        //     //     // ->offset(0)
        //     //     ->limit(20)
        //     //     ->get();

        //     echo "<pre>";
        //     print_r($data);
        //     die;
    }


    public function mail($id = 3)
    {
        $getAllorderDetails = Orders::with('shop', 'user', 'orderTransactions', 'orderQuantity')->where(['id' => $id])->first();
        return   $getAllorderDetails;
    }
    public function getOrderDetailsRaw($id)
    {
        $checkOrderDetails =  Orders::with('user', 'shop', 'orderTransactions', 'orderQuantity')->where(['user_id' => auth('api')->user()->id, 'id' => $id])->first();

        return $checkOrderDetails;
    }
    function time_elapsed_string($datetime, $full = false)
    {
        $value = "";
        if ($datetime !== NULL) {
            $now = new \DateTime();
            $ago = new \DateTime($datetime);
            $diff = $now->diff($ago);

            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $value = $diff->$k . ' ' . $v;
                } else {
                    unset($string[$k]);
                }
            }
        }


        return $value;
    }
    function test()
    {
        $val = $this->full_path();
        return header("content-security-policy: frame-ancestors  " . $_GET['shop'] . " https://admin.shopify.com;");
        // return $val;
    }
    function full_path()
    {
        $s = &$_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
        $segments = explode('?', $uri, 2);
        $url = $segments[0];
        return $url;
    }
}
