<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $response;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->response = app('EllipseSynergie\ApiResponse\Contracts\Response');
    }

    /**
     * @param $getThisFields
     * @param bool|FALSE $removeEmpty
     * @return array
     */
    protected function getDataFromFormRequest($getThisFields, $removeEmpty = FALSE)
    {
        $data = [];
        foreach ($getThisFields as $key) $data[$key] = $this->request->input($key);

        if ($removeEmpty) {
            foreach ($data as $key => $value) {
                if (!$value) unset($data[$key]);
            }
        }

        return $data;
    }
}
