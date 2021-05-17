<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass fillable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ending',
        'destination',
        'description'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'address',
        'host'
    ];

    /**
     * Get the user who created the link.
     */
    public function user() {
        $this->belongsTo(User::class);
    }


    /**
     * Get full address of a link.
     *
     * @return string
     */
    public function getAddressAttribute()
    {
        return request()->getHttpHost() . "/" . $this->ending;
    }

    /**
     * Get host name.
     *
     * @return string
     */
    public function getHostAttribute()
    {
        return request()->getHttpHost();
    }

    /**
     * Get metrics of a link based on the specified column name.
     *
     * @param $column
     * @return Collection
     */
    public function metrics($column, $countByDay=false)
    {   
        if ($countByDay) {
            return $this->visitors()
                ->selectRaw("COUNT(*) total, DATE(created_at) date")
                ->groupBy('date')
                ->get()
                ->mapWithKeys(function ($item) use ($column) {
                    return [$item['date'] => $item['total']];
                });
        }

        return $this->visitors()->groupBy($column)
            ->selectRaw("count(*) as total, {$column}")
            ->get()
            ->mapWithKeys(function ($item) use ($column) {
                return [$item[$column] => $item['total']];
            });
    }

    /**
     * Get visitors of this link.
     */
    public function visitors()
    {
        return $this->hasMany(Visitor::class)->orderBy('created_at');
    }
}
