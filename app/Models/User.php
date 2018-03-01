<?php

namespace App\Models;

use App\Models\Additional\ApiEloquentTrait;
use App\Models\Additional\ApiModelInterface;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, ApiModelInterface
{
    use HasApiTokens, Authenticatable, Authorizable, ApiEloquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
    ];
}
