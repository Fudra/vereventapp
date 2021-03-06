<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'name',
	    'email',
	    'password',
	    'active',
	    'activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
	    'remember_token',
    ];

	/**
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'photo_url',
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=mm';
    }


    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

	/**
	 * @param Builder $builder
	 * @param $email
	 * @param $token
	 *
	 * @return Builder
	 */
	public function scopeByActivationColumns(Builder $builder, $email, $token) {
		return $builder->where( 'email', $email )->where( 'activation_token', $token);
	}

	public function scopeActive( Builder $builder ) {
		return $builder->where('active', 1);
	}

	/**
	 * @param Builder $builder
	 * @param $email
	 *
	 * @return Builder
	 */
	public function scopeByEmail( Builder $builder, $email ) {
		return $builder->where('email', $email);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events() {
		return $this->hasMany(Event::class);
	}

	/**
	 * Generate unique id for this entry
	 */
	protected static function boot() {
		parent::boot();

		static::creating( function ( $user ) {
			$user->identifier = uniqid( true );
		} );
	}
}
