<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CiCategories extends Model
{
    protected $table = 'ci_categories';

    protected $fillable = ['belong', 'parent_id', 'depth', 'name',  'description', 'visible'];

    /**
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    public static function buildTree($elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'category_id');
    }

}
