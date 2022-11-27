<?php

namespace Modules\ContactUs\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactSubject extends Model
{
    use HasFactory;

    protected $fillable = ['id','subject','subject_en','to_email','cc_email', 'sequence','status','created_at','updated_at'];
    protected $table = "contact_subject";
    protected $primaryKey = "id";
    
    protected static function newFactory()
    {
        return \Modules\ContactUs\Database\factories\ContactSubjectFactory::new();
    }
}
