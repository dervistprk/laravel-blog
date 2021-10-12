<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Config
 *
 * @property int         $id
 * @property string      $title
 * @property string|null $logo
 * @property string|null $favicon
 * @property int         $active
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $github
 * @property string|null $linkedin
 * @property string|null $youtube
 * @property string|null $instagram
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Config newModelQuery()
 * @method static Builder|Config newQuery()
 * @method static Builder|Config query()
 * @method static Builder|Config whereActive($value)
 * @method static Builder|Config whereCreatedAt($value)
 * @method static Builder|Config whereFacebook($value)
 * @method static Builder|Config whereFavicon($value)
 * @method static Builder|Config whereGithub($value)
 * @method static Builder|Config whereId($value)
 * @method static Builder|Config whereInstagram($value)
 * @method static Builder|Config whereLinkedin($value)
 * @method static Builder|Config whereLogo($value)
 * @method static Builder|Config whereTitle($value)
 * @method static Builder|Config whereTwitter($value)
 * @method static Builder|Config whereUpdatedAt($value)
 * @method static Builder|Config whereYoutube($value)
 * @mixin Eloquent
 */
class Config extends Model
{
    use HasFactory;
}
