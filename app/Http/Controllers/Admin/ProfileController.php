<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Update;
use App\Models\User;
use App\Queries\ProfilesQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected QueryBuilder $profilesQueryBuilder;
    public function __construct(
        ProfilesQueryBuilder $profilesQueryBuilder,
    ) {
        $this->profilesQueryBuilder = $profilesQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', [
            'userList' => $this->profilesQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return \view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, User $user): RedirectResponse
    {
        $user = $user->fill($request->validated());
        if ($user->save()) {
            return \redirect()->route('admin.users.index')->with('success', __('Profile has been updated'));
        }

        return \back()->with('error', __('Profile has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();

            return  \response()->json('ok');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return  response()->json('error', 400);
        }
    }
}
