<?php

namespace App\Src\Developer\Domain\Model;

use App\Foundation\Domain\Enum;

/**
 * 装修阶段
 * Class DeveloperProjectStageDecorateType
 * @package App\Src\Developer\Domain\Model
 */
class DeveloperProjectStageDecorateType extends Enum
{
    const NOTBEGIN = 1;//未开始
    const HAVEINHAND = 2;//进行中
    const END = 3;//结束
    const UNKNOWN = 4;//未知


    /**
     * OperationModelType type.
     *
     * @var int
     */
    public $type;

    /**
     * Define property name of enum value.
     *
     * @var string
     */
    protected $enum = 'type';

    /**
     * Acceptable operation  model type.
     *
     * @var array
     */
    protected static $enums = [
        self::NOTBEGIN   => '未开始',
        self::HAVEINHAND => '进行中',
        self::END        => '结束',
        self::UNKNOWN    => '未知',
    ];
}