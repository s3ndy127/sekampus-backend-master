<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CategoryKomunitas extends Model {
	use CrudTrait;

	protected $table = 'category_sekomunitas';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'name',
		'description',
		'image',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];
	// protected $dates = [];

	public function komunitas() {
		return $this->hasMany('App\Models\Komunitas', 'category_id', 'id');
	}

	public function scopeNPerGroup($query, $relatedTable = NULL, $group, $n = 10) {
		// queried table
		$table = ($this->getTable());

		$newQuery = $this->newQueryWithoutScopes();

		// initialize MySQL variables inline
		$newQuery->from(\DB::raw("(select @num:=0, @group:=0) as vars, {$table}"));
		$groupTable = $relatedTable ?: $table;

		// if no columns already selected, let's select *
		if (!$query->getQuery()->columns) {
			$newQuery->select("{$table}.*");
		}

		// make sure column aliases are unique
		$groupAlias = "{$table}_grp"; //. md5(time());
		$numAlias = "{$table}_rn"; // . md5(time());

		// apply mysql variables
		$newQuery->addSelect(\DB::raw(
			"@num := if(@group = {$groupTable}.{$group}, @num+1, 1) as {$numAlias}, @group := {$groupTable}.{$group} as {$groupAlias}"
		));

		// make sure first order clause is the group order
		$newQuery->getQuery()->orders = (array) $query->getQuery()->orders;
		array_unshift($newQuery->getQuery()->orders, [
			'column' => "{$groupTable}.{$group}",
			'direction' => 'asc',
		]);

		if ($relatedTable) {
			$newQuery->addSelect("{$groupTable}.{$group}");
			$newQuery->mergeBindings($query->getQuery());
			$newQuery->getQuery()->joins = (array) $query->getQuery()->joins;
			$query->whereRaw("{$table}.{$group} = {$groupTable}.{$group}");
		}

		// prepare subquery
		$subQuery = $query->toSql();
		$query->from(\DB::raw("({$newQuery->toSql()}) as {$table}"))
			->where($numAlias, '<=', $n);

	}

	public function setImageAttribute($value) {
		$attribute_name = "image";
		$disk = "uploads";
		$destination_path = "/category_komunitas";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}
}
