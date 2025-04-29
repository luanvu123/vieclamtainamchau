<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

  protected $fillable = [
    'logo', 'title', 'subtitle', 'phone', 'gmail', 'copyright',
    'newspaper', 'footer_company', 'url_facebook', 'url_youtube',
    'url_partner', 'number_job_seeker_1', 'number_employer_1',
    'whatsapp', 'wechat', 'facebook', 'email', 'zalo',
    'facebook_candidate', 'email_candidate'
];

}
