<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 04.02.2018
 * Time: 0:55
 */

namespace App\Http\Controllers\Api;

use App\Services\QuestionService;

/**
 * Class QuestionController
 * @package App\Http\Controllers\Api
 */
class QuestionController extends AbstractController
{
    /**
     * @var string $_serviceClass
     */
    protected static $_serviceClass = QuestionService::class;
}