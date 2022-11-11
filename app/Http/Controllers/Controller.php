<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @QA\Server(url="http://localhost/api"),
 * @OA\Info(
 *  title="Scrim API",
 *  description="This is an API for application Scrim.",
 *  version="1.0.0",
 *  @OA\Contact(name="API Support", email="alexander.davis.098@gmail.com"),
 *  @OA\License(name="MIT License", url="https://github.com/shunny2/scrim-backend/blob/master/LICENSE.md")
 * ),
 * @OA\SecurityScheme(
 *      type="http",
 *      scheme="bearer",
 *      securityScheme="bearerAuth"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
