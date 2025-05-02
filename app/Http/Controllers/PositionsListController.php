<?php

namespace App\Http\Controllers;

use App\Http\Resources\PositionCollection;
use App\Models\Position;
use App\Services\PositionService;

class PositionsListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PositionService $service)
    {
        $positions = $service->getPositions();

        return new PositionCollection($positions);
    }
}
