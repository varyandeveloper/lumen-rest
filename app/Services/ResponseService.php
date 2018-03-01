<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 03.02.2018
 * Time: 15:39
 */

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ResponseService
 * @package App\Services
 */
class ResponseService
{
    /**
     * @var array $_defaultHeaders
     */
    protected static $_defaultHeaders = [
        'Content-Type: application/json'
    ];

    /**
     * @param int $total
     * @param array $data
     * @param string $key
     * @param int $statusCode
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public static function multiple($total, $data, $key = 'items', $statusCode = 200, $headers = [])
    {
        return response()->json([
            'total' => $total,
            $key => $data,
        ], $statusCode, array_merge(static::$_defaultHeaders, $headers), JSON_PRETTY_PRINT);
    }

    /**
     * @param \stdClass|Collection|Model $data
     * @param string $key
     * @param int $statusCode
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public static function single($data, $key = 'item', $statusCode = 200, $headers = [])
    {
        return response()->json([
            $key => $data,
        ], $statusCode, array_merge(static::$_defaultHeaders, $headers), JSON_PRETTY_PRINT);
    }
}