<?php

namespace Modules\ContactUs\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactPages extends Model
{
    use HasFactory;

    protected $fillable = ['id','description_th','description_en','head_office_th', 'head_office_en','factory_th', 'factory_en',
    'fb', 'line', 'youtube', 'phone_head_office', 'phone_factory', 'email_head_office', 'email_factory', 'gmaps', 'status', 
    'created_at', 'updated_at'];
    protected $table = "contact_page";
    protected $primaryKey = "id";

    protected static function newFactory()
    {
        return \Modules\ContactUs\Database\factories\ContactPagesFactory::new();
    }
}
