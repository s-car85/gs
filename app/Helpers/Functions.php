<?php

namespace App\Helpers;

use App\SetImages;
class Functions
{
    public $belong;
    public $id;

    public function __construct($belong, $id = '0')
    {
        $this->belong = $belong;
        $this->id = $id;
    }
    /**
     * @param $belong
     * @param $id
     * @return mixed
     */
    public function imageGet(){
        //dd($this->belong);
        preg_match('/([a-z]*)@/i', $this->belong, $matches);
        $controllerName = $matches[1];
        $json = array('controller' => $controllerName, 'item' => $this->id);
        $where = json_encode($json);
        $get = SetImages::where('belong', $where)->first();

        return $get;
    }

    public function imageSet(){
        preg_match('/([a-z]*)@/i', $this->belong, $matches);
        $controllerName = $matches[1];
        $json = array('controller' => $controllerName, 'item' => $this->id);

        return json_encode($json);
    }
}
