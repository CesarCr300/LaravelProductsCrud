<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblProduct
 * 
 * @property int $id
 * @property string|null $name
 * @property string $description
 * @property float|null $price
 * @property int|null $stock_quantity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class TblProduct extends Model
{
	protected $table = 'tbl_products';

	protected $casts = [
		'price' => 'float',
		'stock_quantity' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'price',
		'stock_quantity'
	];
}
