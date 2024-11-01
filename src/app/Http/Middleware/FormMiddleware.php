<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Contact;
use App\Models\Content;
use App\Constants\ContentTypes;

class FormMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Получаем данные
        $topics = Contact::pluck('topics')->flatten()->toArray();
        $representatives = Contact::pluck('representatives')->flatten()->toArray();
        $articles = Content::where('type', ContentTypes::ARTICLE_CONTACTS)->get();

        

        // Передаем данные во все представления
        view()->share([
            'topics' => $topics,
            'representatives' => $representatives,
            'articles' => $articles,
        ]);

        return $next($request);
    }
}
