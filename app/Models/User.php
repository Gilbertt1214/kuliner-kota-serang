<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Events\UserSuspended;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_suspended',
        'suspended_until',
        'suspension_reason',
        'warning_count',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPengusaha()
    {
        return $this->role === 'pengusaha';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewReports()
    {
        return $this->hasMany(ReviewReport::class, 'reporter_id');
    }

    public function userWarnings()
    {
        return $this->hasMany(UserWarning::class);
    }

    public function activeWarnings()
    {
        return $this->hasMany(UserWarning::class)->where('is_active', true);
    }

    // Suspension methods
    public function isSuspended()
    {
        if (!$this->is_suspended) {
            return false;
        }

        if ($this->suspended_until && now()->gt($this->suspended_until)) {
            $this->update([
                'is_suspended' => false,
                'suspended_until' => null,
                'suspension_reason' => null
            ]);
            return false;
        }

        return true;
    }

    public function suspend($reason, $duration = null)
    {
        $this->update([
            'is_suspended' => true,
            'suspended_until' => $duration ? now()->add($duration) : null,
            'suspension_reason' => $reason
        ]);
        
        // Trigger event to invalidate all sessions
        event(new UserSuspended($this));
    }

    public function unsuspend()
    {
        $this->update([
            'is_suspended' => false,
            'suspended_until' => null,
            'suspension_reason' => null
        ]);
    }

    public function addWarning()
    {
        $this->increment('warning_count');

        // Auto-suspend after 3 warnings
        if ($this->warning_count >= 3) {
            $this->suspend('Terlalu banyak pelanggaran (3 peringatan)', '30 days');
        }
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_suspended' => 'boolean',
            'suspended_until' => 'datetime',
        ];
    }
}
