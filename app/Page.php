<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use TCG\Voyager\Traits\Translatable;

class Page extends Model {

    use Translatable;

   // use QueryCacheable;

    public $cacheFor = 3600; // cache time, in seconds

    protected $translatable = ['name', 'alias', 'text'];

    protected $guarded = [];

    protected $fillable = ['text'];

    /**
     * Scope a query to only include active pages.
     *
     * @param  $query  \Illuminate\Database\Eloquent\Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutsort($query)
    {
        return $query->newQueryWithoutScope('order');
    }

    /*public function getChangedtextAttribute() {

        return \helper::getChangedText($this->text);
    }*/

    public function findPageByParams($slug_params) {
        $slug = array_pop($slug_params);
        $page = $this->where('slug', $slug, 'and')->where('active', '=', '1')->firstOrFail();
        $parents = $page->getParentsAttribute();
        $aliases = $breads = [];
        $url = '';
        $breads_ar[$slug] = $page->name;
        $page->first_level = $page;
        foreach ($parents as $parent) {
            if ($parent->alias != '/') {
                $aliases[] = $parent->alias;
                $page->first_level = $parent;
            }
            $breads_ar[$parent->alias] = $parent->name;
        }

        if (array_reverse($aliases) != $slug_params) {
            return false;
        }

        $breads_ar = array_reverse($breads_ar);
        foreach ($breads_ar as $slug => $name) {
            if ($slug == '/') {
                continue;
            }
            $breads[] = ['url' => $url .= $slug.'/', 'name' => $name];
        }
        $page->breads = $breads;

        return $page;
    }

    public function findPageByID($id) {
        $page = $this->where('id', $id, 'and')->where('active', '=', 1)->firstOrFail();
        $parents = $page->getParentsAttribute();
        $aliases = $breads = [];
        $url = '';
        $breads_ar[$page->alias] = $page->name;
        $page->first_level = $page;
        foreach ($parents as $parent) {
            if ($parent->alias != '/') {
                $aliases[] = $parent->alias;
                $page->first_level = $parent;
            }
            $breads_ar[$parent->alias] = $parent->name;
        }

        $breads_ar = array_reverse($breads_ar);
        foreach ($breads_ar as $slug => $name) {
            if ($slug == '/') {
                continue;
            }
            $breads[] = ['url' => $url .= $slug.'/', 'name' => $name];
        }
        $page->breads = $breads;

        return $page;
    }

   /* public function parent() {
        return $this->belongsTo('App\Page', 'parent_id');
    }

    public function children() {
        return $this->hasMany('App\Page', 'parent_id')->orderBy('sort');
    }

    public function getParentsAttribute() {
        $parents = collect([]);
        $parent = $this->parent;
        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function Category() {
        return $this->hasMany($this, 'parent_id');
    }

    public function rootCategories() {
        return $this->where('parent_id', null)->with('Category')->get();
    }*/

    public static function getMainPage() {

        return static::where('slug', '/')->first();
    }

    public static function findByAlias($alias) {

        return static::where('slug', $alias)->where('active', '=', 1)->firstOrFail();
    }

  /*  public static function getParent($page_id) {
        return static::where('id', $page_id, 'and')->where('status', '=', static::STATUS_ACTIVE)->firstOrFail();
    }*/

    public function getShowinmenuAttribute() {
        if ($this->in_menu == 1) {
            return true;
        } else {
            return false;
        }
    }

   /* public function TreeChilren($page_id = false) {
        $arr = self::orderBy('sort')->get();
        if ($page_id) {
            // Запускаем рекурсивную постройку дерева и отдаем на выдачу
            return self::buildTree($arr, $page_id);
        } else {
            return self::buildTree($arr, 0);
        }
    }*/

  /*  public static function buildTree($arr, $pid = 0) {
        // Находим всех детей раздела
        $found = $arr->filter(function ($item) use ($pid) {
            return $item->parent_id == $pid;
        });
        // Каждому детю запускаем поиск его детей
        foreach ($found as $key => $cat) {
            $sub = self::buildTree($arr, $cat->id);
            $cat->sub = $sub;
        }

        return $found;
    }*/

  /*  public function getPathAttribute() {
        if (mb_strpos($this->alias, 'http') !== false) {
            return $this->alias;
        }
        if (mb_substr($this->alias, 0, 1) == '/') {
            return $this->alias;
        }
        $aliases = [];
        $aliases[] = $this->alias;
        $parent = $this->parent;
        while (!is_null($parent) and $parent->alias != '/') {
            $aliases[] = $parent->alias;
            $parent = $parent->parent;
        }

        $aliases = array_reverse($aliases);
        $path = '/'.implode('/', $aliases);

        return $path;
    }*/
}