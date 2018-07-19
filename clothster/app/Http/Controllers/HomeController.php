<?php

namespace App\Http\Controllers;

use App\Addresses;
use App\CategoriesProducts;
use App\ProductsImages;
use App\ProductsSizes;
use App\Users;
use Illuminate\Support\Facades\DB;
use App\Orders;
use App\OrdersProducts;
use App\Products;
use App\ProductsColors;
use Illuminate\Support\Facades\Hash;
use Request;
use App\Categories;
use Illuminate\Support\Facades\Input;
use function Sodium\add;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function homePage()
    {
        $arr = array("banners" => array("bannerURL" => "abcd.com", "bannerLink" => "abcde.com"), "aboutUsText" => "aut", "promotions" => array("text" => "212dasd", "text" => "aa212dasd"));
        return $arr;
    }

    public function categories()
    {
        $arr = Categories::all();
        return response()->json(array("categories" => $arr));//array("categories" => $arr);
//        return array("categories" => $arr);
    }

    public function productsCount($filters)
    {
        $filter = explode("=", $filters);
        switch ($filter) {
            case $filter[0] == 'category' :
                $productsIds = DB::select("select count(products_id) as number from categories_products where categories_id = '$filter[1]'")[0];
                return response()->json($productsIds);
                break;
            case $filter[0] == 'color' :
                $productsIds = DB::select("select count(products_id) as number from products_colors where color = '$filter[1]'")[0];
                return response()->json($productsIds);
                break;
            default :
                return "error";
        }
    }

    public function products($filters, $page, $perPage)
    {
        $filter = explode("=", $filters);
        switch ($filter) {
            case $filter[0] == 'category' :
                $productsIds = DB::select("select products_id from categories_products where categories_id = '$filter[1]'");
                $result = array();
                for ($i = $perPage * $page; $i < count($productsIds) && $i < $perPage * ($page + 1); $i++) {
                    $product = Products::where('id', $productsIds[$i]->products_id)->get()->first();
                    $colors = ProductsColors::where('products_id', $productsIds[$i]->products_id)->get();
                    $sizes = ProductsSizes::where('products_id', $productsIds[$i]->products_id)->get();
                    $images = ProductsImages::where('products_id', $productsIds[$i]->products_id)->get();
                    $product->colors = $colors;
                    $product->sizes = $sizes;
                    $product->images = $images;
                    $result[$i] = $product;
                }
                return $result;
                break;
            case $filter[0] == 'color' :
                $productsIds = DB::select("select distinct products_id from products_colors where color = '$filter[1]'");
                $result = array();
                for ($i = $perPage * $page; $i < count($productsIds) && $i < $perPage * ($page + 1); $i++) {
                    $product = Products::where('id', $productsIds[$i]->products_id)->get()->first();
                    $colors = ProductsColors::where('products_id', $productsIds[$i]->products_id)->get();
                    $sizes = ProductsSizes::where('products_id', $productsIds[$i]->products_id)->get();
                    $images = ProductsImages::where('products_id', $productsIds[$i]->products_id)->get();
                    $product->colors = $colors;
                    $product->sizes = $sizes;
                    $product->images = $images;
                    $result[$i] = $product;
                }
                return $result;
                break;

            case $filter[0] == 'name' :
                $productsIds = DB::select("select distinct id from products where name = '$filter[1]'");
                $result = array();
                for ($i = $perPage * $page; $i < count($productsIds) && $i < $perPage * ($page + 1); $i++) {
                    $product = Products::where('id', $productsIds[$i]->id)->get()->first();
                    $colors = ProductsColors::where('products_id', $productsIds[$i]->id)->get();
                    $sizes = ProductsSizes::where('products_id', $productsIds[$i]->id)->get();
                    $images = ProductsImages::where('products_id', $productsIds[$i]->id)->get();
                    $product->colors = $colors;
                    $product->sizes = $sizes;
                    $product->images = $images;
                    $result[$i] = $product;
                }
                return $result;
                break;
            default :
                return "error";
        }
//        return array("filters" => $filters, "page" => $page, "perpage" => $perPage);
    }

    public function product($id)
    {
        $product = Products::find($id);
        $colors = ProductsColors::where('products_id', $id)->get();
        $sizes = ProductsSizes::where('products_id', $id)->get();
        $images = ProductsImages::where('products_id', $id)->get();
        $product->colors = $colors;
        $product->sizes = $sizes;
        $product->images = $images;
        return response()->json($product);
    }

    public function filters($name, $value)
    {
        $arr = array();
        if ($name == "color") {
            $colors = explode(",", $value);
            for ($i = 0; $i < count($colors); $i++) {
                array_push($arr, Products::whereHas('colors', function ($query) use ($colors, $i) {
                    $query->where('color', '=', $colors[$i]);
                })->get());
            }
        }
        if ($name == "price") {
            $prices = explode(",", $value);
            if (isset($prices[0]) && !isset($prices[1])) {
                array_push($arr, Products::where('price', '>', $prices[0])->get());
            } elseif (isset($prices[0]) && isset($prices[1])) {
                array_push($arr, Products::whereBetween('price', [$prices[0], $prices[1]])->get());
            } else {
                return http_send_status(404);
            }
        }
        return $arr;
    }

    public function order(Request $request)
    {
        $products = Request::get("products");
        $totalPrice = Request::get("totalPrice");
        $address = Request::get("address");
        $paymentType = Request::get("paymentType");
        $userId = Request::get("userId");
        $status = Request::get("status");
        $deliveryTime = Request::get("deliveryTime");
//        return(array("products"=>$products,"totalPrice"=>$totalPrice,"address"=>$address));
        if (isset($products) && isset($totalPrice) && isset($address) && isset($paymentType) && isset($userId) && isset($status) && isset($deliveryTime)) {
            $order = new Orders;
            $order->users_id = $userId;
            $order->totalPrice = $totalPrice;
            $order->address = $address;
            $order->paymentType = $paymentType;
            $order->status = $status;
            $order->deliveryTime = $deliveryTime;
            $order->save();
            $lastId = $order->id;
            $ordersProducts = new OrdersProducts;
            for ($i = 0; $i < count($products); $i++) {
                $ordersProducts->orders_id = $lastId;
                $ordersProducts->products_id = $products[$i];
                $ordersProducts->save();
            }
            return "ok";
        } else {
            return "error";
        }

//        return (array("products" => $products, "total price" => $totalPrice, "address" => $address, "payment type", $paymentType));
    }

    public function orderPost($id)
    {
        $products = Request::get("products");
        $totalPrice = Request::get("totalPrice");
        $address = Request::get("address");
        $paymentType = Request::get("paymentType");
        $userId = Request::get("userId");
        $status = Request::get("status");
        $deliveryTime = Request::get("deliveryTime");
//        return(array("products"=>$products,"totalPrice"=>$totalPrice,"address"=>$address));
        if (isset($products) && isset($totalPrice) && isset($address) && isset($paymentType) && isset($userId) && isset($status) && isset($deliveryTime)) {
            $order = Orders::find($id);
            $order->users_id = $userId;
            $order->totalPrice = $totalPrice;
            $order->address = $address;
            $order->paymentType = $paymentType;
            $order->status = $status;
            $order->deliveryTime = $deliveryTime;
            $order->save();
            $lastId = $order->id;
//            $ordersProducts = OrdersProducts::where('orders_id',$id);
//            for ($i=0 ; $i<count($products);$i++){
//                $ordersProducts->orders_id=$lastId;
//                $ordersProducts->products_id=$products[$i];
//                $ordersProducts->save();
//            }
            return "ok" . $lastId;
        } else {
            return "error";
        }
    }

    public function getOrder($id)
    {
        $orders = Orders::find($id);
        $products = DB::select("select * from products where id in (select products_id from  orders_products where orders_id= '$id')");
        return array("products" => $products, "order" => $orders);
    }

    public function getUser($id)
    {
        $user = Users::find($id);
        $addresses = Addresses::where('users_id', $id)->get();
        return array('user' => $user, 'addresses' => $addresses);
    }

    public function setUser(Request $request)
    {
        $username = $request::get('username');
        $password = Hash::make($request::get('password'));
        $avatarURL = $request::get('avatarURL');
        $credit = 0;
        $addressText = $request::get('addressText');
        $city = $request::get('city');
        $lat = $request::get('lat');
        $lon = $request::get('lon');
        if (isset($username)) {
            if (isset($password)) {
                $users = new Users;
                if (isset($addressText) && isset($city) && isset($lat) && isset($lon)) {
                    if (isset($avatarURL)) {
                        $users->avatarURL = $avatarURL;
                    }
                    $users->username = $username;
                    $users->password = $password;
                    $users->credit = $credit;
                    $users->save();
                    $lastId = $users->id;
                    for ($i = 0; $i < count($addressText); $i++) {
                        $addresses = new Addresses;
                        $addresses->users_id = $lastId;
                        $addresses->addressText = $addressText[$i];
                        $addresses->city = $city[$i];
                        $addresses->lat = $lat[$i];
                        $addresses->lon = $lon[$i];
                        $addresses->save();
                    }
                    return "ok";
                } else {
                    return "address not set";
                }
            } else {
                return "password required";
            }
        } else {
            return "username required";
        }
    }

    public function editUser(Request $request)
    {
        $id = $request::get('id');
        $username = $request::get('username');
        $password = Hash::make($request::get('password'));
        $avatarURL = $request::get('avatarURL');
        $credit = $request::get('credit');
        if (isset($username)) {
            if (isset($password)) {
                $users = Users::find($id);
                $users->username = $username;
                $users->password = $password;
                $users->credit = $credit;
                $users->avatarURL = $avatarURL;
                $users->save();
                return "ok";
            } else {
                return "password required";
            }
        } else {
            return "username required";
        }
    }

    public function getAddresses()
    {
        $id = 13;
        $addresses = new Addresses;
        return $addresses::where('users_id', $id)->get();
    }

    public function setAddresses($id, Request $request)
    {
        $addresses = Addresses::find($id);
        $addresses->addressText = $request::get('addressText');
        $addresses->city = $request::get('city');;
        $addresses->lat = $request::get('lat');;
        $addresses->lon = $request::get('lon');;
        $addresses->save();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        return view('home');
//    }
//
}
