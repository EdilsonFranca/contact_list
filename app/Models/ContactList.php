<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    protected $table ='contact_lists';
    public $timestamps=true;
    protected $fillable = array('name','phone','cpf','status');

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

}
