<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table ='contacts';
    public $timestamps=true;
    protected $fillable = array('name','cell_phone','email','photo','contact_list_id');




}
