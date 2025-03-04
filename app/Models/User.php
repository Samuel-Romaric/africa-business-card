<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password',
        'is_blocked',
        'is_global_admin',
    ];

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
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    public function getAvatarFullUrl()
    {
        if (is_null($this->getFirstMedia('avatar'))) {
            return asset('/admin/assets/img/avatar.png');
        }

        return $this->getFirstMedia('avatar')->getFullUrl();
    }

    // public function registerMediaConversions(?Media $media = null): void
    // {
    // $this->addMediaConversion('preview')
    //     ->fit(Fit::Contain, 300, 300)
    //     ->nonQueued();
    // }

    function offers() {
        return $this->hasMany(Offer::class, 'user_id');
    }

    function manager()  {
        return $this->belongsTo(Manager::class);
    }

    function business() {
        return $this->belongsTo(Business::class);
    }

    function commercial() {
        return $this->belongsTo(Commercial::class);
    }

    function adminSaler() {
        return $this->hasMany(Sale::class, 'admin_id');
    }

    function activitySector() {
        return $this->belongsTo(ActivitySector::class);
    }

    function getAtivitySector() {
        $acti = $this->activitySector()->first();
        return $acti;
    }

    function isBlocked() {
        if ($this->is_blocked == 1) {
            return true;
        }
        return false;
    }

    function getStatus() {
        if ($this->isBlocked()) {
            return 'Bloqué';
        }

        return 'Actif';
    }

    function getStatusClass() {
        if ($this->isBlocked()) {
            return 'status-danger';
        }

        return 'status-success';
    }

    function isManager() {
        if ($this->manager()->exists()) {
            return true;
        }
        
        return false;
    }

    function getFullName() {
        $fullname = $this->name.' '.$this->firstname;
        return $fullname;
    }

    function isGlobalAdmin() {
        if ($this->is_global_admin == 1) {
            return true;
        }
        return false;
    }

    function getPrivilege() {
        if ($this->isGlobalAdmin()) {
            return 'Super Admin';
        }
        return 'Admin';
    }
}
