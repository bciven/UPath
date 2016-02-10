<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use View;
use Request;
use Mail;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function reserve()
    {
        return View::make('reserve', array('username_taken' => false));
    }

    public function register()
    {
        $user = new User;

        $user_existed = User::where('user_name', (string)Request::input('user_name'))->first();

        if($user_existed != null)
        {
            return View::make('reserve', array('username_taken' => true));
        }

        $user->user_name =  Request::input('user_name');
        $user->email = Request::input('email');
        $user->confirmation_code = md5(uniqid(rand(), true));

        $data = array('cc' => $user->confirmation_code);
        Mail::send('email', $data, function($message) use ($user) {
            $message->to($user->email, $user->user_name);
        });
        $user->save();

        return View::make('success');
    }

    public function confirm($code)
    {
        $user = User::where('confirmation_code', (string)$code)->firstOrFail();

        if($user != null)
        {
            return View::make('emailconfirmation');
        }
        else
        {
            return View::make('fail');
        }
    }
}
