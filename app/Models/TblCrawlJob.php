<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use App\Models\TblTopicCategory as TopicCategory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblTopic
 * 
 * @property int $id
 * @property string $name
 * @property string $keywords
 * @property string $google_keywords
 * @property string $exclude_url
 * @property string $last_pastebin_key
 * @property string $last_public_pastebin
 *
 * @package App\Models
 */
class TblCrawlJob extends Model
{
	protected $table = 'tbl_crawl_jobs';
	public $timestamps = True;

	protected $fillable = [
		'topic_id',
		'status',
		'no_of_sites',
		'site_completed',
		'completed_at',
	];

	public function Topics(){
        return $this->belongsTo(TblTopic::class, 'topic_id');
    }
}
