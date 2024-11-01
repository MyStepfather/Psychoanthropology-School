<?php

namespace App\Http\Controllers;

use App\Actions\Notify\NewUserNotifyBuilder;
use App\Notifications\ResetPasswordNotification;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Показывает страницу логина
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function getEmail($request)
    {
        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

        if ($loginType === 'email') {
            $email = $request->email;
        } else {
            $email = User::where('login', $request->email)->first()->email;
        }
        return $email;
    }

    /**
     * Обработка формы логина
     * @param Request $request
     */
    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';


        if (auth('web')->attempt([$loginType => $request->email, 'password' => $request->password], $request->boolean('remember'))) {

            $user = auth()->user();
            if ($user->is_active) {
                return redirect(route('main.show'));
            } else {
                return redirect(route('login'))->withErrors(["email" => 'Ожидайте активации от администратора']);
            }
        }

        $request->session()->regenerate();

        return redirect(route('login'))->withErrors(["email" => 'Пользователь не найден, либо данные введены неверно']);
    }

    /**
     * Logout
     * @return View
     */
    public function logOut()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    /**
     * Показывает страницу Сброса пароля
     * @return View
     */
    public function showResetPassword(): View
    {
        return view('auth.resetPassword');
    }

    /**
     * Обработка формы сброса пароля, отправка ссылки на почту
     * @param Request $request
     * @return RedirectResponse
     */
    public function processResetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required'],
        ]);

        $email = $this->getEmail($request);

        $status = Password::sendResetLink(
            ['email' => $email]
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('success.reset.password')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function processUpdatePassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $email = $this->getEmail($request);

        $request = $request->merge(['email' => $email]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Показывает страницу - успешной отправки ссылки на сброс пароля
     * @return View
     */
    public function successResetPassword(): View
    {
        return view('auth.resetSuccess');
    }

    /**
     * Показывает страницу 1 шага Регистрации
     * @return View
     */
    public function showStep1(): View
    {
        return view('auth.registerStep1');
    }

    /**
     * Обработка формы 1 шаг регистрации
     * @param Request $request
     * @return RedirectResponse
     */
    public function processStep1(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'login' => ['required', 'string', 'unique:users,login'],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::create([
            'email' => $request->email,
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);

        Session::put('email', $request->email);

        if ($user) {
            return redirect(route('show.step2'));
        }
    }

    /**
     * Показывает страницу 2 шага Регистрации
     * @return View
     */
    public function showStep2(): View
    {
        return view('auth.registerStep2');
    }

    /**
     * Обработка формы 2 шаг регистрации
     * @param Request $request
     * @return RedirectResponse
     */
    public function processStep2(Request $request): RedirectResponse
    {
        $request->validate([
            'name_first' => ['required'],
            'name_last' => ['required'],
            'file' => ['file', 'image', 'max:5120'],
        ]);

        $email = Session::get('email');
        $user = User::whereEmail($email)->first();

        $user->name_first = $request->name_first;
        $user->name_last = $request->name_last;

        if ($request->files) {
            $file = $request->file('photo');
            $path = $file->store('image/avatars');
            $user->avatar = $path;
        }

        $user->save();

        return redirect(route('show.step3'));
    }

    /**
     * Показывает страницу 3 шаг Регистрации
     * @return View
     */
    public function showStep3(): View
    {
        return view('auth.registerStep3');
    }

    /**
     * Обработка формы 3 шаг регистрации
     * @param Request $request
     * @return RedirectResponse
     */
    public function processStep3(Request $request): RedirectResponse
    {
        $request->validate([
            'country_id' => ['required'],
            'day' => ['required'],
            'month' => ['required'],
            'year' => ['required'],
        ]);

        //       Получаемые поля
        //      "country_id" => "1"
        //      "town_id" => "2"
        //      "group_id" => "4"
        //      "day" => "4"
        //      "month" => "2"
        //      "year" => "2020"
        //      "coordinator" => "on"

        $email = Session::get('email');
        $user = User::whereEmail($email)->first();

        $user->entered_at = $request->year . '-' . $request->month . '-' . $request->day;

        if ($request->group_id) {
            $user->group_id = $request->group_id;
        }

        $user->save();

        return redirect(route('show.step4'));
    }

    /**
     * Показывает страницу 4 шаг Регистрации
     * @return View
     */
    public function showStep4(): View
    {
        return view('auth.registerStep4');
    }

    /**
     * Обработка формы 4 шаг регистрации и редирект на страницу, все успешно
     * @param Request $request
     * @return View
     */
    public function processStep4(Request $request, NewUserNotifyBuilder $sendNotify): View
    {
//        $request->validate([
//            'phone' => ['required_without:telegram', 'numeric'],
//            'telegram' => ['required_without:phone', 'string'],
//            'agree_contact' => ['required'],
//            'agree_policy' => ['required'],
//        ]);

        $email = Session::get('email');
        $user = User::whereEmail($email)->first();

        if ($request->phone) {
            $user->phone = $request->phone;
        }
        if ($request->telegram) {
            $user->telegram = $request->telegram;
        }
        $user->save();
        $sendNotify->handle($user);
        return view('auth.registerSuccess');
    }
}
