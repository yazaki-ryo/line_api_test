<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\Collection\DomainCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class EloquentCustomer extends Model
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'customers';

    /**
     * @var array
     */
    protected $fillable = [
//         'store_id',
        'prefecture_id',
        'sex_id',
//         'group_id',
//         'introducer_id',
        'name',
        'kana',
        'age',
        'office',
        'department',
        'position',

        'postal_code',
        'address',
        'building_name',
        'tel',
        'fax',
        'email',
        'mobile_phone',

        'mourning_flag',
        'likes_and_dislikes',
        'note',
//         'visited_cnt',
//         'cancel_cnt',
//         'noshow_cnt',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @var array
     */
    protected $dates = [
        //
    ];

    /**
     * @var array
     */
    protected $casts = [
        'mourning_flag' => 'bool',
        'visited_cnt'   => 'int',
        'cancel_cnt'    => 'int',
        'noshow_cnt'    => 'int',
    ];

    /**
     * @param  array  $models
     * @return DomainCollection
     */
    public function newCollection(array $models = []): DomainCollection
    {
        return new DomainCollection($models);
    }

    /**
     * @return HasOne
     */
    public function prefecture(): HasOne
    {
        return $this->hasOne(EloquentPrefecture::class, 'id', 'prefecture_id');
    }

    /**
     * @return HasOne
     */
    public function sex(): HasOne
    {
        return $this->hasOne(EloquentSex::class, 'id', 'sex_id');
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(EloquentStore::class, 'store_id', 'id');
    }

}
