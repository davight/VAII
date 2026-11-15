<?php

namespace App\Controllers;

use App\Models\Location;
use App\Models\Sensor;
use App\Models\SensorData;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class SensorController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        $sensors = Sensor::getAll(orderBy: 'location_id, metric');
        $locations = [];
        foreach (Location::getAll() as $location) {
            $locations[$location->id] = $location;
        }
        return $this->html(['sensors' => $sensors, 'locations' => $locations]);
    }

    public function detail(Request $request): Response
    {
        $sensor = $this->findSensor($request->value('id'));
        return $this->html([
            'sensor' => $sensor,
            'location' => Location::getOne($sensor->locationId),
            'data' => SensorData::getAll('sensor_id = ?', [$sensor->id], 'measured_at DESC'),
        ]);
    }

    public function create(Request $request): Response
    {
        $sensor = new Sensor();
        if ($request->isPost()) {
            $sensor->setFromRequest($request);
            $sensor->save();
            return $this->redirect($this->url('sensor.index'));
        }
        return $this->form($sensor, 'Nový senzor', $this->url('sensor.create'));
    }

    public function edit(Request $request): Response
    {
        $id = $request->value('id');
        $sensor = $this->findSensor($id);
        if ($request->isPost()) {
            $sensor->setFromRequest($request);
            $sensor->id = (int)$id;
            $sensor->save();
            return $this->redirect($this->url('sensor.index'));
        }
        return $this->form($sensor, 'Upraviť senzor', $this->url('sensor.edit', ['id' => $id]));
    }

    public function delete(Request $request): Response
    {
        if ($request->isPost()) {
            $this->findSensor($request->post('id'))->delete();
        }
        return $this->redirect($this->url('sensor.index'));
    }

    /**
     * Adds a measurement to a sensor (POST only).
     */
    public function addData(Request $request): Response
    {
        $sensor = $this->findSensor($request->value('id'));
        if ($request->isPost()) {
            $data = new SensorData();
            $data->sensorId = $sensor->id;
            $data->value = (float)$request->post('value');
            $time = $request->post('measuredAt');
            $data->measuredAt = $time ? date('Y-m-d H:i:s', strtotime($time)) : date('Y-m-d H:i:s');
            $data->save();
        }
        return $this->redirect($this->url('sensor.detail', ['id' => $sensor->id]));
    }

    /**
     * Deletes a measurement (POST only).
     */
    public function deleteData(Request $request): Response
    {
        $sensorId = $request->value('id');
        if ($request->isPost()) {
            $data = SensorData::getOne($request->post('dataId'));
            if ($data !== null) {
                $data->delete();
            }
        }
        return $this->redirect($this->url('sensor.detail', ['id' => $sensorId]));
    }

    private function form(Sensor $sensor, string $title, string $action): Response
    {
        return $this->html([
            'sensor' => $sensor,
            'title' => $title,
            'action' => $action,
            'locations' => Location::getAll(orderBy: 'name'),
        ], 'form');
    }

    private function findSensor(mixed $id): Sensor
    {
        $sensor = Sensor::getOne($id);
        if ($sensor === null) {
            throw new HttpException(404, 'Senzor neexistuje.');
        }
        return $sensor;
    }
}
