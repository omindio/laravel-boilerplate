<?php

namespace App\BoundedContext\User\Presentation\Controller;

use App\BoundedContext\User\Presentation\Request\UpdateProfileRequest;
use App\Shared\Presentation\Controller;

use App\Shared\Exception\BaseException;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    protected $profileService;


    public function update(UpdateProfileRequest $request)
    {
        try {
            $user = $this->profileService->update($request->user(), $request->validated());
        } catch (BaseException $e) {
        }
    }

    public function show(Request $request)
    {
        try {
            $user = $this->profileService->showByRequest($request);
        } catch (BaseException $e) {
        }
    }
}
