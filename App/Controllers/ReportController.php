<?php

namespace App\Controllers;

use Framework\Core\BaseController;
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
     * Default action, redirects to the report editor.
     *
     * @return Response The redirect response to the editor action.
     */
    public function index(Request $request): Response
    {
        return $this->redirect($this->url('report.editor'));
    }

    /**
     * Displays the report editor page.
     *
     * @return Response The response object containing the rendered HTML for the editor page.
     */
    public function editor(Request $request): Response
    {
        return $this->html();
    }
}
