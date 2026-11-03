<?php

namespace App\Controllers;

use App\Models\Report;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class ReportController
 * Handles actions related to weather reports.
 *
 * @package App\Controllers
 */
class ReportController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Lists all reports (Read).
     */
    public function index(Request $request): Response
    {
        return $this->html(['reports' => Report::getAll(orderBy: 'id DESC')]);
    }

    /**
     * Shows the form for a new report and stores it on POST (Create).
     */
    public function create(Request $request): Response
    {
        $report = new Report();
        if ($request->isPost()) {
            $report->setFromRequest($request);
            $report->save();
            return $this->redirect($this->url('report.index'));
        }
        return $this->html([
            'report' => $report,
            'title' => 'Nový report',
            'action' => $this->url('report.create'),
        ], 'form');
    }

    /**
     * Shows the form for an existing report and saves changes on POST (Update).
     *
     * @throws HttpException If the report does not exist.
     */
    public function edit(Request $request): Response
    {
        $id = $request->value('id');
        $report = Report::getOne($id);
        if ($report === null) {
            throw new HttpException(404, 'Report neexistuje.');
        }
        if ($request->isPost()) {
            $report->setFromRequest($request);
            $report->id = (int)$id;
            $report->save();
            return $this->redirect($this->url('report.index'));
        }
        return $this->html([
            'report' => $report,
            'title' => 'Upraviť report',
            'action' => $this->url('report.edit', ['id' => $id]),
        ], 'form');
    }

    /**
     * Deletes a report (Delete). Only accepts POST.
     *
     * @throws HttpException If the report does not exist.
     */
    public function delete(Request $request): Response
    {
        if ($request->isPost()) {
            $report = Report::getOne($request->post('id'));
            if ($report === null) {
                throw new HttpException(404, 'Report neexistuje.');
            }
            $report->delete();
        }
        return $this->redirect($this->url('report.index'));
    }

    /**
     * Displays the report editor page.
     *
     * @return Response The response object containing the rendered HTML for the editor page.
     * @throws HttpException If the report does not exist.
     */
    public function editor(Request $request): Response
    {
        $report = Report::getOne($request->value('id'));
        if ($report === null) {
            throw new HttpException(404, 'Report neexistuje.');
        }
        return $this->html(['report' => $report]);
    }
}
