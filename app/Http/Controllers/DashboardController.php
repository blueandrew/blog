<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\DataUpdateRequest;
use App\Http\Requests\DataAddRequest;
use App\Models\Works;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Works::where('user_id', $request->user()->id)->get();

        return Inertia::render('Dashboard', [
            'works' => $query,
        ]);
    }

    public function getWorks(Request $request): Collection
    {
        $works = Works::where('user_id', $request->user()->id)->get();
        
        return $works;
    }

    public function create(DataAddRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = $request->user()->id;

        // 创建新的数据项
        $Works = Works::create($validatedData);

        return Redirect::route('dashboard.index');
    }

    public function update(DataUpdateRequest $request, $id): RedirectResponse
    {
        $works = Works::where('user_id', $request->user()->id)->find($id);
        $validatedData = $request->validated();
        $works->fill($validatedData);
        $works->save();

        return Redirect::route('dashboard.index');
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $query = Works::find($id);
        $query -> delete();
        
        return response()->json(['message' => '成功刪除'], 200);
    }
}

