<?php namespace App;

//use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseModel extends Model{

    //use QueryCacheable;

   // public $cacheFor = 3600; // cache time, in seconds

	public static function boot(){
		parent::boot();
		// Сортировка
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('sort', 'asc');
		});
	}

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('active', 1);
    }
}

 
