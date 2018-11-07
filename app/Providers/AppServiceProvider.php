<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Product_category;
use App\Brand;

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
        $product_category = Product_category::all();
        view()->share('product_category', $product_category);

        $brands = Brand::all();
        view()->share('brands', $brands);
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
