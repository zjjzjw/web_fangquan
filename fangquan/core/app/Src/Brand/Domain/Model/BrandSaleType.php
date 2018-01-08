<?php namespace App\Src\Brand\Domain\Model;

use App\Foundation\Domain\Enum;

class BrandSaleType extends Enum
{

    const COMPANY = 1;
    const AREA = 2;
    const BAZAAR = 3;
    const PRODUCT = 4;

    /**
     * MsgStatus status.
     *
     * @var string
     */
    public $status;

    /**
     * Define property name of enum value.
     *
     * @var string
     */
    protected $enum = 'status';

    /**
     * Acceptable progress status.
     *
     * @var array
     */
    protected static $enums = [
        self::COMPANY => '工程销售负责人',
        self::AREA    => '区域销售负责人',
        self::BAZAAR  => '市场经理',
        self::PRODUCT => '产品经理',
    ];

}