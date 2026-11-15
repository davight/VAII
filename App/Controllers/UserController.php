<?php

namespace App\Controllers;

use App\Models\Location;
use App\Models\Report;
use App\Models\User;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class UserController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        return $this->html(['users' => User::getAll(orderBy: 'username')]);
    }

    public function detail(Request $request): Response
    {
        $user = $this->findUser($request->value('id'));
        return $this->html([
            'account' => $user,
            'locations' => $user->getLocations(),
            'reports' => Report::getAll('user_id = ?', [$user->id], 'id DESC'),
        ]);
    }

    public function create(Request $request): Response
    {
        $user = new User();
        if ($request->isPost()) {
            $user->setFromRequest($request);
            $user->save();
            $user->setLocations($this->postedLocationIds($request));
            return $this->redirect($this->url('user.index'));
        }
        return $this->form($user, 'Nový používateľ', $this->url('user.create'));
    }

    public function edit(Request $request): Response
    {
        $id = $request->value('id');
        $user = $this->findUser($id);
        if ($request->isPost()) {
            $user->setFromRequest($request);
            $user->id = (int)$id;
            $user->save();
            $user->setLocations($this->postedLocationIds($request));
            return $this->redirect($this->url('user.index'));
        }
        return $this->form($user, 'Upraviť používateľa', $this->url('user.edit', ['id' => $id]));
    }

    public function delete(Request $request): Response
    {
        if ($request->isPost()) {
            // FK: user_locations rows are cascaded, reports.user_id is set to NULL
            $this->findUser($request->post('id'))->delete();
        }
        return $this->redirect($this->url('user.index'));
    }

    private function form(User $user, string $title, string $action): Response
    {
        return $this->html([
            'account' => $user,
            'title' => $title,
            'action' => $action,
            'allLocations' => Location::getAll(orderBy: 'name'),
            'selectedIds' => array_map(fn(Location $l) => $l->id, $user->getLocations()),
        ], 'form');
    }

    private function findUser(mixed $id): User
    {
        $user = User::getOne($id);
        if ($user === null) {
            throw new HttpException(404, 'Používateľ neexistuje.');
        }
        return $user;
    }

    private function postedLocationIds(Request $request): array
    {
        $ids = $request->post('locations');
        return is_array($ids) ? $ids : [];
    }
}
