<?php
namespace App\Http\Controllers;

use App\Background;
use App\Backgroundimage;
use App\Food;
use App\Models\Location;
use App\Models\Store;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $backgroundimage = Backgroundimage::limit(10)->get()->first()->allbackground;
        $background = Background::limit(10)->get()->first();
        $search = $request->search;
        $foods = Food::where('title', 'LIKE', '%' . $search . '%')->where('status', '>', '0')->limit(10)->get();
        return view('searchs')->with('foods', $foods)->with('backgroundimage', $backgroundimage)->with('background', $background);
    }

    public function getSearchReview()
    {
        $search = $_GET['term'];
        $results = array();
        $queries = Store::where('name', 'LIKE', '%' . $search . '%')->where('approval', '1')->where('status', '1')->paginate(15);
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->name, 'avatar' => $query->images];
        }
        return ($results);
    }

    public function getSearchUser()
    {
        $search = $_GET['term'];
        $results = array();
        $queries = User::where('email', 'LIKE', '%' . $search . '%')->limit(10)->get();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->email, 'avatar' => $query->photo];
        }
        return ($results);
    }

    public function postSearchAllStore(Request $request)
    {
        $search = $request->search;
        $store = Store::where('name', $search)->first();
        return view('version2.storesearch')->with('store', $store);
    }

    public function getSearchAllStore(Request $request)
    {
        $search = $request->search;
        $store = Store::where('name', $search)->first();
        return view('version2.storesearch')->with('store', $store);
    }

    public function postGlobleSearch(Request $request)
    {

        session(['location' => $request->location, 'typeOfFood' => $request->typeoffood, 'restaurantName' => $request->restaurantname, 'place' => $request->place]);
        return view('version2.searchresult');

    }

    public function getAngularSeach(Request $request)
    {

        $location = session()->get('location');
        $restaurant = session()->get('restaurantName');
        $place =session()->get('place');
        $typeOfFood = session()->get('typeOfFood');
        if ($location != "") {
            $location = Location::where('name', $location)->first();
            $lat = $location->lat;
            $long = $location->long;
            if ($restaurant != "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE name LIKE "%' . $restaurant . '%" AND type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_place_name LIKE "%' . $place . '%" AND type_of_food_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by pricefrom desc limit 10'));
            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                return $results = DB::select(DB::raw('SELECT *, ( 3959 * acos ( cos ( radians("' . $lat . '") ) * cos( radians( maplat ) ) * cos( radians( maplon) - radians("' . $long . '") ) + sin ( radians("' . $lat . '") ) * sin( radians( maplat ) ) ) ) AS `distance`  FROM `stores` WHERE  type_of_food_name LIKE "%' . $typeOfFood . '%" HAVING (distance <=5)  order by pricefrom desc limit 10'));
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
                $stores=Store::where('name','LIKE','%'.$restaurant.'%')->where('type_of_food','LIKE','%'.$typeOfFood.'%')->where('type_of_place_name','LIKE','%'.$place.'%')->limit(10)->get();
            } else if ($restaurant == "" && $place != "" && $typeOfFood != "") {
                $stores=Store::where('type_of_food_name','LIKE','%'.$typeOfFood.'%')->where('type_of_place_name','LIKE','%'.$place.'%')->limit(10)->get();

            } else if ($restaurant == "" && $place == "" && $typeOfFood != "") {
                $stores=Store::where('type_of_food_name','LIKE','%'.$typeOfFood.'%')->limit(10)->get();

            } else if ($restaurant != "" && $place != "" && $typeOfFood == "") {
                $stores=Store::where('name','LIKE','%'.$restaurant.'%')->where('type_of_place_name','LIKE','%'.$place.'%')->limit(10)->get();

            } else if ($restaurant != "" && $place == "" && $typeOfFood == "") {
                $stores=Store::where('name','LIKE','%'.$restaurant.'%')->limit(10)->get();

            } else if ($restaurant == "" && $place != "" && $typeOfFood == "") {
                $stores=Store::where('type_of_place_name','LIKE','%'.$place.'%')->limit(10)->get();

            }else{

            }
            return $stores->toJson();
        }

    }

    public function getSearchFilter(Request $request)
    {
        $restaurantname = $request->restaurantname;
        $typeoffood = $request->typeoffood;
        $location = $request->location;
        $place = $request->place;
        if (empty($restaurantname) && empty($typeoffood) && empty($location) && empty($place)) {
            return redirect()->back();
        } else if (!empty($location)) {
            $storeresults = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->limit(10)->get();
            $storeOrderByRankings = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('rating', 'DESC')->limit(10)->get();
            $views = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('view', 'DESC')->limit(10)->get();
            $prices = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('priceto', 'DESC')->limit(10)->get();

            $distances = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->where('distance', '<=', '3')->orderBy('distance')->limit(10)->get();

            return view('version2.searchresult')->with('storeresults', $storeresults)->with('storeOrderByRankings', $storeOrderByRankings)->with('views', $views)->with('prices', $prices)->with('locationsearch', $location)->with('distances', $distances);
        } else {
            $storeresults = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->limit(10)->get();

            $storeOrderByRankings = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('rating', 'DESC')->limit(10)->get();
            $views = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('view', 'DESC')->limit(10)->get();
            $prices = Store::where('name', 'LIKE', '%' . $restaurantname . '%')->where('type_of_food_name', 'LIKE', '%' . $typeoffood . '%')->where('type_of_place_name', 'LIKE', '%' . $place . '%')->orderBy('priceto', 'DESC')->limit(10)->get();
        }
        return view('version2.searchresult')->with('storeresults', $storeresults)->with('storeOrderByRankings', $storeOrderByRankings)->with('views', $views)->with('prices', $prices);
    }

    function toMiles($lat1, $lon1, $lat2, $lon2)
    {
        // Formula for calculating distances
        // from latitude and longitude.
        $dist = acos(sin(deg2rad($lat1))
            * sin(deg2rad($lat2))
            + cos(deg2rad($lat1))
            * cos(deg2rad($lat2))
            * cos(deg2rad($lon1 - $lon2)));
        $dist = rad2deg($dist);
        $miles = (float)$dist * 69;
        // To get kilometers, multiply miles by 1.61
        $km = (float)$miles * 1.61;
        // This is all displaying functionality
        $display = sprintf("%0.2f", $miles) . ' miles';
        $display .= ' (' . sprintf("%0.2f", $km) . ' kilometers)';
        return $display;
    }


    public function getUpdateDistance(Request $request)
    {
        $location = Location::where('name', $request->location)->first();
        DB::table('stores')
            ->where('approval', '1')
            ->update(['mapfrom' => $location->lat, 'mapto' => $location->long]);
        $stores = Store::all();
        foreach ($stores as $store) {
            $updateStore = Store::where('id', '=', $store->id)->update(array('distance' => $this->toMiles((float)$store->maplat, (float)$store->maplon, (float)$store->mapfrom, (float)$store->mapto)));
        }
    }
}
