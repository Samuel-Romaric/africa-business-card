<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Image\Enums\Fit;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        'slug',
        'email',
        'role',
        'password',
        'is_blocked',
        'is_global_admin',
        'telephone',
        'num_cni',
        'whatsapp',
        'date_naissance',
        'age',
        'code',
        'diplome',
        'pays',
        'departement',
        'ville',
        'commune',
        'description',
        'is_blocked',
        'manager_id',
        'commercial_id',
        'business_id',
        'activity_sector_id',
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
        // return $this->getFirstMediaUrl('avatar', 'preview');
    }

    // public function registerMediaConversions(?Media $media = null): void
    // {
    //     $this->addMediaConversion('preview')
    //         ->fit(Fit::Contain, 400, 400)
    //         ->sharpen(10)
    //         ->nonQueued();
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

    function createOffer() {
        return $this->hasMany(Offer::class, 'created_by');
    }

    function validateOffer() {
        return $this->hasMany(Offer::class, 'validated_by');
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
            return 'bloqué';
        }

        return 'activé';
    }

    function getStatusClass() {
        if ($this->isBlocked()) {
            return 'status2-danger';
        }

        return 'status2-success';
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
