<?php

namespace App\BoundedContext\User\Presentation\Controller;

use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Contract\QueryBusInterface;
use App\BoundedContext\User\Presentation\Request\UpdateProfileRequest;
use App\BoundedContext\User\Application\Command\UpdateUserProfile;
use App\BoundedContext\User\Application\Query\GetUserProfile;
use App\Shared\Presentation\Controller;

use App\Shared\Domain\Exception\BaseException;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    private CommandBusInterface $commandBus;
    private QueryBusInterface $queryBus;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $data = $request->validated();

            $userId = $this->authenticatedId();

            $updateProfileCommand = new UpdateUserProfile(
                $userId,
                $data['name'],
                $data['surname'],
            );

            $response = $this->commandBus->dispatch($updateProfileCommand);

            return $this->successResponse('Profile updated successfully.', $response->toArray());
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function getProfile(Request $request)
    {
        try {
            $userId = $request->user()->id;

            $getProfileQuery = new GetUserProfile($userId);

            $response = $this->queryBus->ask($getProfileQuery);

            return $this->successResponse('Profile retrieved successfully.', $response->toArray());
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
