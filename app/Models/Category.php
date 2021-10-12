<?php

namespace App\Models;

use App\Models\Article;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @property int         $id
 * @property string      $name
 * @property string      $image
 * @property string      $slug
 * @property int         $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereImage($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereStatus($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function articleCount()
    {
        return $this->hasMany(Article::class, 'category_id', 'id')->where('status', 1)->count();
    }

    public function articleCountPassive()
    {
        return $this->hasMany(Article::class, 'category_id', 'id')->where('status', 0)->count();
    }

    public function totalArticleCount()
    {
        return $this->hasMany(Article::class, 'category_id', 'id')->count();
    }
}
