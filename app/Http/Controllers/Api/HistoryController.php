<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 05.02.2018
 * Time: 17:43
 */

namespace App\Http\Controllers\Api;

use App\Services\HistoryService;

/**
 * Class HistoryController
 * @package App\Http\Controllers\Api
 */
class HistoryController extends AbstractController
{
    /**
     * @var string $_serviceClass
     */
    protected static $_serviceClass = HistoryService::class;
}