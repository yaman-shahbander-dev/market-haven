<?php

namespace App\Admin\v1\Http\Location\Controllers;

use App\Admin\v1\Http\Location\Resources\AddressResource;
use App\Http\Controllers\Controller;
use Domain\Location\Actions\Shared\Address\GetAddressesAction;
use Domain\Location\Actions\Shared\Address\ShowAddressAction;
use Domain\Location\Models\Address;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Address::class));

        $addresses = GetAddressesAction::run();

        return AddressResource::paginatedCollection($addresses);
    }

    public function show(Address $address): JsonResponse
    {
        $this->authorize('view', app(Address::class));

        $address = ShowAddressAction::run($address->id);

        return $address
            ? $this->okResponse(AddressResource::make($address))
            : $this->notFoundResponse();
    }
}
