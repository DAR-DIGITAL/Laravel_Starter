<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    public const TABLE_NAME = 'users';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const LAST_NAME_COLUMN = 'last_name';
    public const EMAIL_COLUMN = 'email';
    public const GENDER_COLUMN = 'gender';
    public const CITY_COLUMN = 'city';
    public const COUNTRY_COLUMN = 'country';
    public const ADDRESS_COLUMN = 'address';
    public const PHONE_COLUMN = 'phone';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';
    public const DELETED_AT_COLUMN = 'deleted_at';
    public const BIRTHDAY_AT_COLUMN = 'birthday';
    public const REF_COLUMN = 'ref';
    public const PRIMARY_KEY_COLUMN = 'id';

    protected $guard_name = 'api';

    protected $dates = ['deleted_at', 'birthday'];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'city',
        'country',
        'address',
        'phone',
        'birthday',
        'ref'
    ];
    protected $hidden = [
        'password',
        'updated_at',
        'deleted_at'
    ];

public function setFirstNameAttribute($value)
{
    $this->attributes[self::FIRST_NAME_COLUMN] = $value;
}

public function getFirstNameAttribute($value)
{
    return $this->attributes[self::FIRST_NAME_COLUMN];
}

public function setLastNameAttribute($value)
{
    $this->attributes[self::LAST_NAME_COLUMN] = $value;
}

public function getLastNameAttribute($value)
{
    return $this->attributes[self::LAST_NAME_COLUMN];
}

public function setEmailAttribute($value)
{
    $this->attributes[self::EMAIL_COLUMN] = $value;
}

public function getEmailAttribute($value)
{
    return $this->attributes[self::EMAIL_COLUMN];
}

public function setGenderAttribute($value)
{
    $this->attributes[self::GENDER_COLUMN] = $value;
}

public function getGenderAttribute($value)
{
    return $this->attributes[self::GENDER_COLUMN];
}

public function setCityAttribute($value)
{
    $this->attributes[self::CITY_COLUMN] = $value;
}

public function getCityAttribute($value)
{
    return $this->attributes[self::CITY_COLUMN];
}

public function setCountryAttribute($value)
{
    $this->attributes[self::COUNTRY_COLUMN] = $value;
}

public function getCountryAttribute($value)
{
    return $this->attributes[self::COUNTRY_COLUMN];
}

public function setAddressAttribute($value)
{
    $this->attributes[self::ADDRESS_COLUMN] = $value;
}

public function getAddressAttribute($value)
{
    return $this->attributes[self::ADDRESS_COLUMN];
}

public function setPhoneAttribute($value)
{
    $this->attributes[self::PHONE_COLUMN] = $value;
}

public function getPhoneAttribute($value)
{
    return $this->attributes[self::PHONE_COLUMN];
}

public function setBirthdayAttribute($value)
{
    $this->attributes[self::BIRTHDAY_AT_COLUMN] = $value;
}

public function getBirthdayAttribute($value)
{
    return $this->attributes[self::BIRTHDAY_AT_COLUMN];
}

public function setRefAttribute($value)
{
    $this->attributes[self::REF_COLUMN] = $value;
}

public function getRefAttribute($value)
{
    return $this->attributes[self::REF_COLUMN];
}
}
