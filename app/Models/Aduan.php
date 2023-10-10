<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    use HasFactory;
  protected $table = 'aduan';

  protected $guarded = ['id'];

  public $timestamps = true;

  public function scopeMonthlyData($query)
    {
        return $query->selectRaw('MONTH(created_at) as month, SUM(aduan) as total_amount')
            ->where('id_aduan', null)
            ->whereYear('created_at', Carbon::now()->year) // Filter tahun saat ini
            ->groupBy('month')
            ->orderBy('month');
    }
}
