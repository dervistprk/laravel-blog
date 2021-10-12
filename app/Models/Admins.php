<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admins
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string      $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Admins newModelQuery()
 * @method static Builder|Admins newQuery()
 * @method static Builder|Admins query()
 * @method static Builder|Admins whereCreatedAt($value)
 * @method static Builder|Admins whereEmail($value)
 * @method static Builder|Admins whereId($value)
 * @method static Builder|Admins whereName($value)
 * @method static Builder|Admins wherePassword($value)
 * @method static Builder|Admins whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Admins extends Authenticatable
{
    protected $table = 'admins';
    use HasFactory;
}
