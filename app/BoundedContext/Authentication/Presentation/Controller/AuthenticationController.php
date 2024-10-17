<?php

namespace App\BoundedContext\Authentication\Presentation\Controller;

use App\BoundedContext\Authentication\Application\Query\GetUserAuthenticated;
use App\Shared\Application\Contract\QueryBusInterface;
use App\Shared\Presentation\Controller;
use App\Shared\Domain\Exception\BaseException;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function user(Request $request)
    {
        try {
            $userId = $request->user()->id;

            $getUserQuery = new GetUserAuthenticated($userId);

            $response = $this->queryBus->dispatch($getUserQuery);

            return $this->successResponse('La contraseña se ha cambiado correctamente.', $response->toArray());
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
