<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Store;
use DB;
use Illuminate\Http\Request;

class SortController extends Controller
{

    public function getSortByRanking(Request $request)
    {
        $location = $request->session()->get('location');
        $restaurant = session()->get('restaurantName');
        $place = session()->get('place');
        $typeOfFood = session()->get('typeOfFood');


        if ($location != "") {
            $location = Location::where('name', $location)->first();
            $lat = $location->lat;
            $long = $location->long;

            if ($restaurant != "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by rating desc limit 10'));
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by rating desc limit 10'));
            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by rating desc limit 10'));
            } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%"  HAVING (distance <=5)  order by rating desc limit 10'));
            } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%"  HAVING (distance <=5)  order by rating desc limit 10'));
            } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_place_name LIKE "%' . $place . '%"  HAVING (distance <=5)  order by rating desc limit 10'));
            } else {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` HAVING (distance <=5)  order by rating desc limit 10'));

            }

        } else {
            if ($restaurant != "" && $place != "" && $typeOfFood != "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('rating', 'DESC')->limit(10)->get();
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                $stores = Store::where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('rating', 'DESC')->limit(10)->get();

            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                $stores = Store::where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->orderBy('rating', 'DESC')->limit(10)->get();

            } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('rating', 'DESC')->limit(10)->get();

            } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->orderBy('rating', 'DESC')->limit(10)->get();;
            } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
                $stores = Store::where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('rating', 'DESC')->limit(10)->get();
            }
            return $stores->toJson();
        }
    }

    public function getSortByView(Request $request)
    {
        $location = session()->get('location');
        $restaurant = session()->get('restaurantName');
        $place = session()->get('place');
        $typeOfFood = session()->get('typeOfFood');



        if ($location != "") {
            $location = Location::where('name', $location)->first();
            $lat = $location->lat;
            $long = $location->long;
            if ($restaurant != "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by view desc limit 10'));
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by view desc limit 10'));
            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by view desc limit 10'));
            } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%"  HAVING (distance <=5)  order by view desc limit 10'));
            } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%"  HAVING (distance <=5)  order by view desc limit 10'));
            } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_place_name LIKE "%' . $place . '%"  HAVING (distance <=5)  order by view desc limit 10'));
            } else {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` HAVING (distance <=5)  order by view desc limit 10'));

            }
        } else {
            if ($restaurant != "" && $place != "" && $typeOfFood != "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('view', 'DESC')->limit(10)->get();
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                $stores = Store::where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('view', 'DESC')->limit(10)->get();

            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                $stores = Store::where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->orderBy('rating', 'DESC')->limit(10)->get();

            } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('view', 'DESC')->limit(10)->get();

            } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->orderBy('view', 'DESC')->limit(10)->get();;
            } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
                $stores = Store::where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('view', 'DESC')->limit(10)->get();

            }
            return $stores->toJson();
        }
    }

    public function getSortByPrice(Request $request)
    {
        $location = $request->session()->get('location');
        $restaurant = session()->get('restaurantName');
        $place = session()->get('place');
        $typeOfFood = session()->get('typeOfFood');

        if ($location != "") {
            $location = Location::where('name', $location)->first();
            $lat = $location->lat;
            $long = $location->long;
            if ($restaurant != "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%"  HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%"  HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_place_name LIKE "%' . $place . '%"  HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` HAVING (distance <=5)  order by pricefrom desc limit 10'));

            }
        } else {
            if ($restaurant != "" && $place != "" && $typeOfFood != "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('pricefrom', 'DESC')->limit(10)->get();
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                $stores = Store::where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('pricefrom', 'DESC')->limit(10)->get();

            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                $stores = Store::where('type_of_food_name', 'LIKE', '%' . $typeOfFood . '%')->orderBy('pricefrom', 'DESC')->limit(10)->get();

            } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('pricefrom', 'DESC')->limit(10)->get();

            } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
                $stores = Store::where('name', 'LIKE', '%' . $restaurant . '%')->orderBy('pricefrom', 'DESC')->limit(10)->get();;
            } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
                $stores = Store::where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('pricefrom', 'DESC')->limit(10)->get();

            }
            return $stores->toJson();
        }
    }

    public function getSortByDistance(Request $request)
    {
        $restaurant = session()->get('restaurantName');
        $place = session()->get('place');
        $typeOfFood = session()->get('typeOfFood');
        $location = session()->get('location');
        $location = Location::where('name', $location)->first();
        $lat = $location->lat;
        $long = $location->long;
        if ($restaurant != "" && $place != "" && $typeOfFood != "") {

            return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by distance asc limit 10'));
        } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
            return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores`  WHERE type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by distance asc limit 10'));

        } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
            return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by distance asc limit 10'));

        } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
            return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores`  WHERE type_of_place_name LIKE "%' . $place . '%" AND name LIKE "%' . $restaurant . '%" HAVING (distance <=5)  order by distance asc limit 10'));

        } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
            return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%"  HAVING (distance <=5)  order by distance asc limit 10'));
        } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
            return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%"  AND type_of_food_name_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by distance asc limit 10'));
        } else {
            return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores`  HAVING (distance <=5)  order by distance asc limit 10'));
        }

    }
}


