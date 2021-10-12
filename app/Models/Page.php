<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Page
 *
 * @property int         $id
 * @property string      $title
 * @property string      $image
 * @property string      $content
 * @property string      $slug
 * @property int         $order
 * @property int         $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page whereContent($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereImage($value)
 * @method static Builder|Page whereOrder($value)
 * @method static Builder|Page whereSlug($value)
 * @method static Builder|Page whereStatus($value)
 * @method static Builder|Page whereTitle($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Page extends Model
{
    use HasFactory;
}
