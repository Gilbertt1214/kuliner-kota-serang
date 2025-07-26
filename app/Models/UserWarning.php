<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWarning extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'review_report_id',
    'warning_type',
    'reason',
    'issued_by',
    'is_active'
  ];

  protected $casts = [
    'is_active' => 'boolean'
  ];

  // Relationships
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function reviewReport()
  {
    return $this->belongsTo(ReviewReport::class);
  }

  public function issuedBy()
  {
    return $this->belongsTo(User::class, 'issued_by');
  }

  // Scopes
  public function scopeActive($query)
  {
    return $query->where('is_active', true);
  }

  // Helper methods
  public function getWarningTypeLabelAttribute()
  {
    $types = [
      'first_warning' => 'Peringatan Pertama',
      'second_warning' => 'Peringatan Kedua',
      'final_warning' => 'Peringatan Terakhir'
    ];

    return $types[$this->warning_type] ?? $this->warning_type;
  }

  public function getWarningTypeColorAttribute()
  {
    $colors = [
      'first_warning' => 'yellow',
      'second_warning' => 'orange',
      'final_warning' => 'red'
    ];

    return $colors[$this->warning_type] ?? 'gray';
  }
}
