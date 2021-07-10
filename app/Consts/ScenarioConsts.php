<?php

namespace App\Consts;

class ScenarioConsts
{
    public const TITLE_LENGTH_MIN = 4;
    public const TITLE_LENGTH_MAX = 100;
    public const SUMMARY_LENGTH_MAX = 1000;
    public const REC_SKILL_LENGTH_MAX = 1000;
    public const CAUTION_LENGTH_MAX = 1000;
    public const GM_MEMO_LENGTH_MAX = 1000;

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

    public const PLATFORM_CCFOLIA = 1;
    public const PLATFORM_UDONARIUM = 2;
    public const PLATFORM_LIST = [
        self::PLATFORM_CCFOLIA => 'ココフォリア',
        self::PLATFORM_UDONARIUM => 'ユドナリウム'
    ];

    public const PUBLIC_FLG_PUBLIC = 1;
    public const PUBLIC_FLG_HIDDEN = 2;
    public const PUBLIC_FLG_LIST = [
        self::PUBLIC_FLG_PUBLIC => '公開',
        self::PUBLIC_FLG_HIDDEN => '非公開',
    ];

    // 推奨参加人数
    public const REC_NUMBER_LIST = [
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10
    ];

    // 表示件数
    public const PAGENATE_LIST_LIMIT = 5;
    public const PAGENATE_MANAGE_LIMIT = 5;

}
