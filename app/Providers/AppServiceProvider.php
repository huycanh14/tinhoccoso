<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Product_category;
use App\Brand;
use App\Cart;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //chia sẻ thư mục sản phẩm
        $product_categories = Product_category::all();
        view()->share('product_categories', $product_categories);

        $brands = Brand::all();
        view()->share('brands', $brands);

        view()->composer(['layout.header', 'pages.dat_hang'], function($view){
            if(Session('cart'))
            {
                $oldCart = Session::get('cart');
                $cart  = new Cart($oldCart);
                $view->with(['cart' => Session::get('cart'), 'product_cart' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
            }
            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
