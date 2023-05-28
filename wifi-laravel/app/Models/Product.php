<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['code',
        'name',
        'price',
        'size',
        'quantity_exists',
        'description',
        'flag_promoted',
        'coverage_density_id',
        'frequency_band_id',
        'guarantee_id',
        'made_in_id',
        'manufacture_id',
        'promotion_id',
        'speed_wifi_id',
        'standard_network_id',
        'type_anteing_id',
        'type_device_id',
        'user_connect_id',
        'button_support_id',
        'port_id',
        'anteing_id',
        ];
//    protected $guarded = [];
    public function anteing(): BelongsTo {
        return $this->belongsTo(Anteing::class, 'anteing_id', 'id');
    }

    public function buttonSupport(): BelongsTo {
        return $this->belongsTo(ButtonSupport::class, 'button_support_id', 'id');
    }

    public function coverageDensity(): BelongsTo {
        return $this->belongsTo(CoverageDensity::class, 'coverage_density_id', 'id');
    }

    public function frequencyBand(): BelongsTo {
        return $this->belongsTo(FrequencyBand::class, 'frequency_band_id', 'id');
    }

    public function guarantee(): BelongsTo {
        return $this->belongsTo(Guarantee::class, 'guarantee_id', 'id');
    }

    public function madeIn(): BelongsTo {
        return $this->belongsTo(MadeIn::class, 'made_in_id', 'id');
    }

    public function manufacture(): BelongsTo {
        return $this->belongsTo(Manufacture::class, 'manufacture_id', 'id');
    }

    public function port(): BelongsTo {
        return $this->belongsTo(Port::class, 'port_id', 'id');
    }

    public function promotion(): BelongsTo {
        return $this->belongsTo(Promotion::class, 'promotion_id', 'id');
    }

    public function speedWifi(): BelongsTo {
        return $this->belongsTo(SpeedWifi::class, 'speed_wifi_id', 'id');
    }

    public function standardNetwork(): BelongsTo {
        return $this->belongsTo(StandardNetwork::class, 'standard_network_id', 'id');
    }

    public function typeAnteing(): BelongsTo {
        return $this->belongsTo(TypeAnteing::class, 'type_anteing_id', 'id');
    }

    public function typeDevice(): BelongsTo {
        return $this->belongsTo(TypeDevice::class, 'type_device_id', 'id');
    }

    public function userConnect(): BelongsTo {
        return $this->belongsTo(UserConnect::class, 'user_connect_id', 'id');
    }

    public function image(): HasMany {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }
}
