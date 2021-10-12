<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Article
 *
 * @property int                $id
 * @property int|null           $category_id
 * @property string             $title
 * @property string             $sub_title
 * @property string             $image
 * @property string             $content
 * @property int                $hit
 * @property int                $status 0:pasif 1:aktif
 * @property string             $slug
 * @property Carbon|null        $deleted_at
 * @property Carbon|null        $created_at
 * @property Carbon|null        $updated_at
 * @property-read Category|null $category
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static \Illuminate\Database\Query\Builder|Article onlyTrashed()
 * @method static Builder|Article query()
 * @method static Builder|Article whereCategoryId($value)
 * @method static Builder|Article whereContent($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDeletedAt($value)
 * @method static Builder|Article whereHit($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereImage($value)
 * @method static Builder|Article whereSlug($value)
 * @method static Builder|Article whereStatus($value)
 * @method static Builder|Article whereSubTitle($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Article withoutTrashed()
 * @mixin Eloquent
 */
class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'articles';

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
