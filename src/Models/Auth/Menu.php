<?php

namespace Admin\Models\Auth;


/*
* 
* name 
* author Yuanchang
* date 
*/
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'admin_menu';

    protected $fillable = [
        'parent_id','title','order','icon','uri'
    ];

    public $rules = [
        'parent_id'=>'required',
        'title'=>'required',
        'order'=>'required',
        'icon'=>'required',
        'uri'=>'required',
    ];

    public $messages = [

    ];

    public function menuTree($menus,$parent_id = 0,$level = 0)
    {
        $tmp = [];
        foreach ($menus as $menu) {
            if ( $menu->parent_id == $parent_id ) {

                $menu->level = $level;

                $tmp [] = $menu;

                $menu->children = $this->menuTree($menus,$menu->id,$level+1);


            }
        }
        return $tmp;
    }

    public function orderTree($menus,$parent_id = 0,$level = 0)
    {
        static $tmp = [];

        foreach ($menus as $menu) {

            if ( $menu->parent_id == $parent_id ) {

                $menu->level = $level;

                $tmp [] = $menu;

                $this->orderTree($menus,$menu->id,$level+1);


            }
        }
        return $tmp;
    }
}