<?php

namespace Modules\WebSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebSettings extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'companyname_th', 'companyname_en', 'link_login', 'phone_head_office', 'phone_factory', 'fb', 'line', 'youtube', 'email_head_office', 'email_factory', 'logo_header', 'privacy_th', 'privacy_en', 'created_at', 'updated_at', 'logo_footer','meta_title', 'meta_keywords', 'meta_description', 'seo_image', 'gmaps', 'google_analytics'];
    protected $table = "websetting";
    protected $primaryKey = "id";

    protected static function newFactory()
    {
        return \Modules\WebSetting\Database\factories\WebSettingsFactory::new();
    }
}
