<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 04.02.2018
 * Time: 0:12
 */

namespace App\Services;

use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends AbstractService
{
    /**
     * @var string $_model
     */
    protected static $_modelClass = User::class;
}