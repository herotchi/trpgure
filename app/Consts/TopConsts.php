<?php

namespace App\Consts;

class TopConsts
{
    public const LIMIT = 5;
    public const TITLE_STRING_MAX = 40;
    public const PUBLIC_FLG_PUBLIC = 1;
    public const PUBLIC_FLG_HIDDEN = 2;
    public const PUBLIC_FLG_LIST = [
        self::PUBLIC_FLG_PUBLIC => '公開',
        self::PUBLIC_FLG_HIDDEN => '非公開'
    ];

}
