<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_message';
    public $timestamps = false;
    protected  $primaryKey ='chat_message_id';
}
