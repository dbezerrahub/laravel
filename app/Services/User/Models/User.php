<?php

namespace App\Services\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Services\User\DAO\UserDAO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Quais atributos podem ser preenchidos via array
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'client_secret'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id'                    => 'integer',
            'name'                  => 'string',
            'email'                 => 'string',
            'client_secret'         => 'string',
            'google_refresh_token'  => 'string',
            'google_access_token'   => 'string',
            'fcm_token'             => 'string',
            'email_verified_at'     => 'datetime'
        ];
    }

    public static function find_first($where) {
        return UserDAO::select('find_first', $where);
    }
    public static function find_all($where) {
        return UserDAO::select('find_all', $where);
    }
    public static function getByEmail($email) {
        $where = ['where', 'email', '=', $email];
        $user = self::find_first([$where]);
        return $user;
    }

    public static function getBy($attribute, $value) {
        $where = ['where', $attribute, '=', $value];
        $user = self::find_first([$where]);
        return $user;
    }
}
