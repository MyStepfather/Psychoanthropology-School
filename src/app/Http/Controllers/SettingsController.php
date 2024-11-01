<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class SettingsController extends Controller
{

    public function notify($status, $text, $param)
    {
        if ($status == 'success') {
             return redirect()->back()->with('success', $text);
        }
        if ($status == 'error') {
            return redirect()->back()->withErrors([$param => $text]);
        }
    }

    public function updatePersonalData(Request $request)
    {
        $request->validate([
            'name_first' => ['nullable', 'string'],
            'name_last' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'image', 'max:5120'],
        ]);

        $user = auth()->user();

        if ($user) {
            if ($request->filled('name_first')) {
                $user->name_first = $request->input('name_first');
            }

            if ($request->filled('name_last')) {
                $user->name_last = $request->input('name_last');
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('image/avatars', 'public');
                $user->avatar = $path;
            }

            if (
                $request->filled('birthday_day') ||
                $request->filled('birthday_month') ||
                $request->filled('birthday_year')
            ) {
                $requestDay = $request->input('birthday_day');
                $requestMonth = $request->input('birthday_month');
                $requestYear = $request->input('birthday_year');

                $date = new DateTime();
                $date->setDate($requestYear, $requestMonth, $requestDay);
                $user->birthdate = $date;
            }

            $user->save();
        }

        return redirect()->back()->with('success', 'Профиль успешно обновлен!');
    }

    public function deleteAvatar()
    {
        $user = auth()->user();

        if ($user) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
                $user->avatar = null;
                $user->save();
            }
            return response()->json(['success' => true]);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current-password' => ['required', 'string'],
            'new-password' => ['required', 'string', 'min:8'],
        ]);
        $user = auth()->user();

        if ($user) {
            if (password_verify($request->input('current-password'), $user->password) && ($request->input('new-password'))) {
                $user->password = bcrypt($request->input('new-password'));
                $user->save();
                return redirect()->back()->with('success', 'Пароль успешно изменен!');
            } else {
                 return redirect()->back()->withErrors(['current-password' => 'Текущий пароль неверен.']);
            }
        }
    }

     public function changeEmail(Request $request)
     {
         $user = auth()->user();

         $request->validate([
             'email' => 'string|email:rfc,dns|min:6',
         ]);
         $user->email = $request['email'];
         $user->save();

         return redirect()->back()->with('success', 'Почта успешно изменена!');
     }

    public function changeMembership(Request $request)
    {
    }

    public function changeContacts(Request $request)
    {
        $user = auth()->user();
        $socialLinks = $user->social ? json_decode($user->social, true) : [];

        if ($user) {
            if ($request->input('phone')) {
                $user->phone = $request->input('phone');
            }
            if (!empty($request->input('vk')) || array_key_exists('vk', $socialLinks)) {
                $vk = $request->input('vk') ? $request->input('vk') : $socialLinks['vk'];
                $socialLinks['vk'] = $vk;
            }

            if (!empty($request->input('instagram')) || array_key_exists('', $socialLinks)) {
                $inst = $request->input('instagram') ? $request->input('instagram') : $socialLinks['instagram'];
                $socialLinks['instagram'] = $inst;
            }

            if ($request->has('is_public')) {
                $user->is_public = $request->input('is_public');
            } else {
                $user->is_public = 0;
            }

            $user->social = !empty($socialLinks) ? json_encode($socialLinks) : null; // Если $socialLinks не пустой, то только тогда преобразуйте в JSON

            $user->save();

            return redirect()->back()->with('success', 'Успешно обновлено!');
        }
    }

    public function showPage()
    {
        $user = auth()->user();
        $membershipData['groups'] = Group::query()
            ->get()
            ->unique('country_id');
        $membershipData['selectedCountry'] = $user->group->country->name;
        $membershipData['selectedTown'] = $user->group->town->name;
        $membershipData['selectedCoordinator'] = $user->group->place;
        return view('settings', compact('membershipData'));
    }
}
