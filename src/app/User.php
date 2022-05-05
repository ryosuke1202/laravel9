<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sex',
        'email',
        'zip_code',
        'prefecture',
        'city',
        'building',
        'password',
        'phone',
        'status',
        'role_id',
    ];

    const NORMAL_USER = 1;//一般ユーザー
    const ADMIN_USER = 2;//管理者
    const GENDER_MAN = 1;//男性
    const GENDER_WOMAN = 2;//女性
    const GENDER_NO_SETTING = 3;//設定なし
    const NO_LIMIT = 0;//制限なし
    const NOT_AVAILABLE = 1;//利用不可
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserCollection()
    {
        $rows = $this->paginate(10);
        foreach ($rows as $row) {
            if ($row->sex === self::GENDER_MAN) {
                $row->sex = '男性';
            }
            if ($row->sex === self::GENDER_WOMAN) {
                $row->sex = '女性';
            }
            if ($row->sex === self::GENDER_NO_SETTING) {
                $row->sex = '設定なし';
            }
            if ($row->role_id === self::NORMAL_USER) {
                $row->role_id = '一般ユーザー';
            } else {
                $row->role_id = '管理者';
            }
            if ($row->status === self::NO_LIMIT) {
                $row->status = '制限なし';
            }
            if ($row->status === self::NOT_AVAILABLE) {
                $row->status = '利用不可';
            }
        }
        return $rows;
    }

    public function csvHeader()
    {
        return [
            'id',
            '名前',
            '性別',
            'メールアドレス',
            '郵便番号',
            '都道府県',
            '市区町村',
            '番地以降',
            '権限',
            '作成日',
        ];
    }

    public function csvUser($row)
    {
        return [
            $row['id'],
            $row['name'],
            $row['sex'],
            $row['email'],
            $row['zip_code'],
            $row['prefecture'],
            $row['city'],
            $row['building'],
            $row['role_id'],
            $row['created_at'],
        ];
    }

    public static function setUserInf($user)
    {
        if ($user->sex === self::GENDER_MAN) {
            $user->sex = '男性';
        }
        if ($user->sex === self::GENDER_WOMAN) {
            $user->sex = '女性';
        }
        if ($user->sex === self::GENDER_NO_SETTING) {
            $user->sex = '設定なし';
        }
        if ($user->role_id === self::NORMAL_USER) {
            $user->role_id = '一般ユーザー';
        } else {
            $user->role_id = '管理者';
        }
        if ($user->status === self::NO_LIMIT) {
            $user->status = '制限なし';
        }
        if ($user->status === self::NOT_AVAILABLE) {
            $user->status = '利用不可';
        }
    }
}
