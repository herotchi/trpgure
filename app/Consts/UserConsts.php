<?php

namespace App\Consts;

class UserConsts
{
    public const USER_NAME_LENGTH_MIN = 4;
    public const USER_NAME_LENGTH_MAX = 12;
    public const LOGIN_ID_LENGTH_MIN = 6;
    public const LOGIN_ID_LENGTH_MAX = 20;
    public const PASSWORD_LENGTH_MIN = 6;
    public const PASSWORD_LENGTH_MAX = 20;
    public const FRIEND_CODE_LENGTH = 12;
    public const FRIEND_CODE_STRING = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const FRIEND_CODE_GENERATE_LIMIT = 10;
    public const PUBLIC_FLG_PUBLIC = 1;
    public const PUBLIC_FLG_HIDDEN = 2;
    public const PUBLIC_FLG_LIST = [
        self::PUBLIC_FLG_PUBLIC => '公開',
        self::PUBLIC_FLG_HIDDEN => '非公開'
    ];

}
