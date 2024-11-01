<?php

namespace App\Http\Controllers;

use App\Models\Council;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Contact;
use App\Models\Content;
use App\Constants\ContentTypes;



class AboutPageController extends Controller
{
    public function showAboutPage() {
        
        $councils  = Council::with(['towns', 'users'])->get();

        return view('about', compact('councils'));
    }

    public function showCouncilPage() {

        $councils  = Council::with(['towns', 'users'])->get();

        return view('about', compact('councils'));
    }

    public function showContactsPage() {
        
        $councils  = Council::with(['towns', 'users'])->get();
      
        return view('about', compact('councils'));        
    }
    

}
