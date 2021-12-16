<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Product;
use App\User;
use App\Category;

/*use App\Charts\CountCategoryChart;
use App\Charts\PostsByMonthChart;
use App\Charts\PostsInYearChart;
use App\Comment;
use App\Contact;*/



/*use App\Post;
use App\Review;
use App\User;*/

use App\Charts\TheChart;


class DashboardController extends Controller
{

    protected $monthLabels;
    protected $sortLabels;

    public function __construct()
    {

        $this->monthLabels =  ['يناير', 'فبراير', 'مارس', 'إبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
        $this->sortLabels = Category::whereCategoryId(Null)->pluck('name');
    }

    public function index()
    {
        $productCount = Product::count();
        $orderCount = rand(0, 5);
        $clientsCount = User::count();
        $vendorsCount = Admin::whereRole(1)->count();


      

        // Get Posts Of The Specific Category And Make Line Chart Depending On
        // Count Category Posts
        $countCategories = Product::CountCategories();
        // Make Doghnut Chart Depending On
        $countCategoryChart = new TheChart;
        $countCategoryChart->labels = array_keys($countCategories);
        $resultCountCategories = array_values($countCategories);
        $countCategoryChart->dataset('My dataset', 'doughnut', $resultCountCategories)->backgroundColor(["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#bd2000", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]);
        $countCategoryChart->height(522);
        $countCategoryChart->minimalist(false);
        $countCategoryChart->displayAxes(false);


        // Get Posts Of The Specific Category And Make Line Chart Depending On During The Whole Year
        $OrdersBySortInYear = [];
        //for($i = 0; $i < count($this->sortLabels); $i++){
            //$PostsBySortInYear[$i] = [];
            for($j = 1; $j < 13; $j++){
                array_push($OrdersBySortInYear,Product::FindProductsByMonth($i = 0, $j));
            }
        //}
        //dd($PostsBySortInYear);       
        $OrdersInYearChart = new TheChart;
        $OrdersInYearChart->labels = ($this->monthLabels);
        for($i = 0; $i < 4; $i++){
            $OrdersInYearChart->dataset($this->sortLabels[$i], 'line', $OrdersBySortInYear)->backgroundColor("rgba(236,29,23,0.6)");
        }
        $OrdersInYearChart->height(200);


       // Get Posts Of The Specific Category And Make Line Chart Depending On During The Whole Year
       $ProductsBySortInYear = [];
       //for($i = 0; $i < count($this->sortLabels); $i++){
           //$PostsBySortInYear[$i] = [];
           for($j = 1; $j < 13; $j++){
               array_push($ProductsBySortInYear,Product::FindProductsByMonth($i = 0, $j));
           }
       //}
       //dd($PostsBySortInYear);       
       $ProductsInYearChart = new TheChart;
       $ProductsInYearChart->labels = ($this->monthLabels);
       for($i = 0; $i < 4; $i++){
           $ProductsInYearChart->dataset($this->sortLabels[$i], 'line', $ProductsBySortInYear)->backgroundColor("rgba(236,29,23,0.6)");
       }
       $ProductsInYearChart->height(200);


          // Get Posts Of The Current Month And Make Line Chart Depending On
          $postsByMonthChartTwo = new TheChart;
          $postsByMonthChartTwo->labels = ($this->sortLabels);
          $postsInMonth = [];
          for($j = 0; $j < count( $this->sortLabels); $j++){
              array_push($postsInMonth,Product::FindProductsByMonth($this->sortLabels[$j], now()->month));
          }
          $postsByMonthChartTwo->dataset('My dataset', 'line', $postsInMonth)->backgroundColor("rgba(236,29,23,0.6)");
          $postsByMonthChartTwo->height(400);
          //$postsByMonthChartTwo->minimalist(false);
          //$postsByMonthChartTwo->displayAxes(false);

          $users = User::latest()->take(10)->get();
          $admins = Admin::latest()->take(10)->get();

        return view('admin.dashboard', compact('productCount', 'orderCount', 'clientsCount', 'vendorsCount', 'OrdersInYearChart', 'countCategoryChart' ,'ProductsInYearChart' , 'postsByMonthChartTwo', 'users', 'admins'));


    }
}