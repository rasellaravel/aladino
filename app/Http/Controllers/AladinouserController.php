<?php

namespace App\Http\Controllers;

use Request;

use App\MenuCategory;
use Hash;
class AladinouserController extends Controller
{
    public function index()
    {

        $url = 'http://tamalmanager.aladino.lt/domain.php';
        $json = file_get_contents($url);
        $result = json_decode($json, true);
        foreach ($result as  $value) {
            $arr[]= $value['domain_name'];
        }
        $hostName = Request::server ("HTTP_HOST");
        if(in_array($hostName, $arr)){
            return view('front-end.myhome');
        }else{
            return view('product.error');
        }
    }
    public function aladinoHome()
    {
        return view('aladino-frontend.index');
    }
    public function aladinoProduct()
    {
        return view('aladino-frontend.product');
    }

    public function aladinoProductDetails()
    {
        return view('aladino-frontend.product-details');
    }
  


   
}
