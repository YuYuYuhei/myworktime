<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'user_id',
        'punchIn',
        'punchOut',
        'memo',
    ];

    // protected $dates = [
    //     'punchIn',
    //     'punchOut',
    //     'workTimeInt',
    // ];

    public function users() {
        return $this->belongsTo(User::class);
    }
}





/*
   Memo
   protected $fillable
   →LaravelのDBでは各カラムにフィールドをたす際、基本的にMass assignableの設定がデフォ。この状態だとティンカー以外では値を挿入することができない。よって、$fillableで挿入可にする

   public function users()...
   →users functionはMigration名からの呼称だがmustではない。これはUser Modelとの関連を記載している

*/
