<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Http\Controllers\Client\CategoriesController;
use App\Http\Controllers\client\ProductsController;
use App\Services\CartService;

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

        // Share categories with all views
        View::share('categories', Category::all());

        // Share paginated products with all views
        View::share('products', Product::paginate(12));

        // Share recent products with all views
        view()->share('recentProducts', Product::orderBy('created_at', 'desc')->take(3)->get());

        // Share carts with all views
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $cartService = app(CartService::class);

                $cartData = $cartService->getIndexData();

                $view->with([
                    'cartItems' => $cartData['cartItems'],
                    'subTotal' => $cartData['subTotal'],
                    'vat' => $cartData['vat'],
                    'total' => $cartData['total'],
                    'count' => $cartData['count'],
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
