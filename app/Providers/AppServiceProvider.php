<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;

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
        // ResetPassword::createUrlUsing(function (User $user, string $token) {
        //     return 'http://127.0.0.1:8000/new-password?token=' . $token;
        // });
    }
}
