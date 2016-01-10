<?php

namespace App;

use Log;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Receive[] $receives
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasRoles;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function receives()
    {
        return $this->hasMany(Receive::class);
    }

    public static function deleteByCondition($id)
    {
        $query = self::with(array(
                'receives'
            ))
            ->whereId($id)
            ->first();

        if($query->receives()->count()){

            Log::info('user activity: delete user is unsuccess.', [
                'user_id' => $query->id,
                'receives' => $query->receives()->count(),
            ]);

            return [
                'status' => false,
                'title' => trans('user.label.name'),
                'message' => trans('user.message_alert.delete_unsuccess'),
            ];
        }

        Log::info('user activity: delete user is success.', [
            $query->toArray(),
        ]);

        $response = $query->delete();

        return [
            'status' => $response,
            'title' => trans('user.label.name'),
            'message' => trans('user.message_alert.delete_success'),
        ];
    }
}