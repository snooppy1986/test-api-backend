<?php


namespace App\Services;

use App\Exceptions\ItemNotFoundException;
use App\Models\Position;



class PositionService
{
    public function getPositions()
    {
        $positions = Position::all();

        if(!$positions){
            throw new ItemNotFoundException(message: 'Positions not found', code: 404);
        }

        return $positions;
    }
}
