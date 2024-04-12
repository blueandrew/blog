<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Works;

class HomeController extends Controller
{
    public function edit(Request $request): Response
    {
        $query = Works::where('status', 1)->get();

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'works' => $query,
        ]);
    }
}
