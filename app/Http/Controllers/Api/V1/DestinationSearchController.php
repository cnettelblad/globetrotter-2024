<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;

class DestinationSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        return DestinationResource::collection(
            Destination::query()
                ->when(
                    $request->input('search'),
                    function ($query, $search) {
                        $query->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                )
                ->when(
                    $request->input('limit'),
                    function ($query, $limit) {
                        $query->limit($limit);
                    }
                )
                ->orderby('name')
                ->get()
        );
    }
}
