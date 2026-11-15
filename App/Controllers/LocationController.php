<?php

namespace App\Controllers;

use App\Models\Location;
use App\Models\Sensor;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class LocationController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        return $this->html(['locations' => Location::getAll(orderBy: 'name')]);
    }

    public function detail(Request $request): Response
    {
        $location = $this->findLocation($request->value('id'));
        return $this->html([
            'location' => $location,
            'sensors' => Sensor::getAll('location_id = ?', [$location->id], 'metric'),
            'users' => $location->getUsers(),
        ]);
    }

    public function create(Request $request): Response
    {
        $location = new Location();
        if ($request->isPost()) {
            $location->setFromRequest($request);
            $location->save();
            return $this->redirect($this->url('location.index'));
        }
        return $this->html([
            'location' => $location,
            'title' => 'Nová lokalita',
            'action' => $this->url('location.create'),
        ], 'form');
    }

    public function edit(Request $request): Response
    {
        $id = $request->value('id');
        $location = $this->findLocation($id);
        if ($request->isPost()) {
            $location->setFromRequest($request);
            $location->id = (int)$id;
            $location->save();
            return $this->redirect($this->url('location.index'));
        }
        return $this->html([
            'location' => $location,
            'title' => 'Upraviť lokalitu',
            'action' => $this->url('location.edit', ['id' => $id]),
        ], 'form');
    }

    public function delete(Request $request): Response
    {
        if ($request->isPost()) {
            $this->findLocation($request->post('id'))->delete();
        }
        return $this->redirect($this->url('location.index'));
    }

    private function findLocation(mixed $id): Location
    {
        $location = Location::getOne($id);
        if ($location === null) {
            throw new HttpException(404, 'Lokalita neexistuje.');
        }
        return $location;
    }
}
