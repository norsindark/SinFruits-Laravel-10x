<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderCancellation;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductWarehouse;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\Facades\View;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot()
    {

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url)
                ->line('If you did not create an account, no further action is required.')
                ->line('Thank you for using our SinFruits!')
                ->success();
        });

        // Share users with all views
        View::share('users', User::all());

        // Share notification quantity products with all views
        View::share('notifications', ProductWarehouse::orderBy('quantity', 'asc')->get());

        // Share users with all views
        View::share('billOrders', Order::paginate(12));

        // Share users with all views
        View::share('reports', OrderCancellation::paginate(12));

        // Share categories with all views
        View::share('categories', Category::all());

        // Share categories with all views
        View::share('warehouses', Warehouse::all());

        // Share paginated products with all views
        View::share('products', Product::paginate(12));

        // Share recent products with all views
        view()->share('recentProducts', Product::orderBy('created_at', 'desc')->take(3)->get());

        // Share asc products with all views
        view()->share('ascProducts', Product::orderBy('name', 'asc')->get());

        // Share comments with all views
        // View::share('comments', ProductReview::paginate(12));

        // Share carts with all views
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartService = app(CartService::class);

                $cartData = $cartService->getIndexData();

                $subTotal = isset($cartData['subTotal']) ? $cartData['subTotal'] : 0;
                $vat = isset($cartData['vat']) ? $cartData['vat'] : 0;
                $total = isset($cartData['total']) ? $cartData['total'] : 0;
                $count = isset($cartData['count']) ? $cartData['count'] : 0;


                $view->with([
                    'cartItems' => $cartData['cartItems'],
                    'subTotal' => $subTotal,
                    'vat' => $vat,
                    'total' => $total,
                    'count' => $count,
                ]);
            } else {
                $view->with([
                    'cartItems' => [],
                    'subTotal' => 0,
                    'vat' => 0,
                    'total' => 0,
                    'count' => 0,
                ]);
            }
        });
    }
}
