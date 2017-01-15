<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * Mass assignable attributes
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'campaign_slug', 'goal_price', 'image_name', 'story', 'deadline'];

    /**
     * Fields to be treated as Carbon
     *
     * @var array
     */
    protected $dates = ['deadline'];

    /**
     * @var array
     */
    public static $create_campaign_whitelist = ['user_id', 'title', 'goal_price', 'story', 'deadline'];

    /**
     * @var array
     */
    public static $image_dimension = ['width' => 668, 'height' => 445];

    /**
     * @var int
     */
    protected $campaign_slug_length = 255;

    /**
     * @param $date
     */
    protected function setDeadlineAttribute($date)
    {
        $this->attributes['deadline'] = Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * @param array $attributes
     * @return static
     */
    public static function create(array $attributes = [])
    {
        $attributes = array_only($attributes, self::$create_campaign_whitelist);
        $attributes['campaign_slug']= self::generateUniqueCampaignSlug(isset($attributes['title']) ? $attributes['title'] : '');
        return parent::create($attributes);
    }

    /**
     * @param string $campaign_title
     * @return string
     */
    private static function generateUniqueCampaignSlug($campaign_title = '')
    {
        $campaign_slug = str_slug($campaign_title);

        $i = 1;

        do {
            if ($i == 1) {
                $new_campaign_slug = $campaign_slug;
            } else {
                $new_campaign_slug = substr($campaign_slug, 0, $this->campaign_slug_length - $i);
                $new_campaign_slug .= $i;
            }

            $slug_exists = self::where('campaign_slug', $new_campaign_slug)->exists();

            $i++;
        } while($slug_exists);

        return $new_campaign_slug;
    }
}
