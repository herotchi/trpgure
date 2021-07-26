<?php

namespace App\Consts;

class CharacterConsts
{
    public const NAME_LENGTH_MIN = 1;
    public const NAME_LENGTH_MAX = 100;
    public const CHARACTER_SHEET_LENGTH_MIN = 1;
    public const CHARACTER_SHEET_LENGTH_MAX = 1000;

    public const GENRE_CTHULTH = 1;
    public const GENRE_EMOKLORE = 2;
    public const GENRE_SWORDWORLD = 3;
    public const GENRE_SHINOBIGAMI = 4;
    public const GENRE_LIST = [
        self::GENRE_CTHULTH => 'クトゥルフ',
        self::GENRE_EMOKLORE => 'エモクロア',
        self::GENRE_SWORDWORLD => 'ソードワールド',
        self::GENRE_SHINOBIGAMI => 'シノビガミ',
    ];

    public const SERVICE_IACHARA = 1;
    public const SERVICE_VAMPIRE = 2;
    public const SERVICE_EMOKLORE = 3;
    public const SERVICE_LIST = [
        self::SERVICE_IACHARA => 'いあきゃら',
        self::SERVICE_VAMPIRE => 'キャラクター保管庫',
        self::SERVICE_EMOKLORE => 'エモクロアCS',
    ];
    public const SERVICE_DOMAIN_LIST = [
        self::SERVICE_IACHARA => 'iachara.com',
        self::SERVICE_VAMPIRE => 'charasheet.vampire-blood.net',
        self::SERVICE_EMOKLORE => 'emoklore.charasheet.jp',
    ];

    // 表示件数
    public const PAGENATE_LIST_LIMIT = 5;
    public const PAGENATE_MANAGE_LIMIT = 5;

}
