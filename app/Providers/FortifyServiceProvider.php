<?php

namespace App\Providers;
use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use Laravel\Fortify\Contracts\LoginResponse;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();

        if ($request->is('admin/*')) {

            Config::set('fortify.guard', 'admin');

            Config::set('fortify.passwords', 'admins');

            Config::set('fortify.prefix', 'admin');

            Config::set('fortify.home', 'admin/dashboard/dashboard');


  
        }
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                $user = $request->user('admin');

                if($user)
                {
                    return redirect()->route('dashboard');
                }
                else
                {
                    return redirect()->route('home');
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {



        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
       // Fortify::authenticateUsing(AuthenticateUser::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        /*
        Fortify::loginView('auth.login');
        // ==
        Fortify::loginView(function()
        {
          
            if(Config::set('fortify.guard') == 'web')
            {
                return view('front.auth.login');
            }
            return view('auth.login');
        });*/

        if(Config::get('fortify.guard') == 'admin')
        {
            Fortify::authenticateUsing([new AuthenticateUser, 'authenticate']);

            Fortify::viewPrefix('auth.');
        }
        else
        {
            Fortify::viewPrefix('front.auth.'); 
        }

        Fortify::registerView('auth.register');

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });
    }
}
