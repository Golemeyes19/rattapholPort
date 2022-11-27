<?php

namespace Modules\ContactUs\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contacts extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','email', 'subject_id', 'subject','subject_en','message','reply', 'status','created_at','updated_at'];
    protected $table = "contact";
    protected $primaryKey = "id";
    
    protected static function newFactory()
    {
        return \Modules\ContactUs\Database\factories\ContactsFactory::new();
    }
}
