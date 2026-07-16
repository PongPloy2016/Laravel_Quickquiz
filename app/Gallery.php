<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'tbl_gallery';

    public $timestamps = false;

    protected $fillable = [
        'cat_id',
        'video_title',
        'video_url',
        'video_id',
        'video_thumbnail',
        'video_duration',
        'video_description',
        'video_type',
        'video_status',
        'size',
        'total_views',
    ];

    /**
     * Resolve the thumbnail URL for this video.
     *
     * Priority:
     *   1. Stored thumbnail → served via symlinked public/video_image/
     *   2. YouTube video   → YouTube CDN mqdefault thumbnail
     *   3. Fallback        → placeholder
     */
    public function getThumbnailUrl(): string
    {
        if (!empty($this->video_thumbnail)) {
            // Thumbnails live in /ecommerce/upload/video_image/
            // exposed at public/video_image/ via symlink
            return asset('video_image/' . $this->video_thumbnail);
        }

        if ($this->video_type === 'youtube' && !empty($this->video_id)) {
            return "https://img.youtube.com/vi/{$this->video_id}/mqdefault.jpg";
        }

        return 'https://via.placeholder.com/480x270/1a1a35/6c47ff?text=Video';
    }
}
