<?php namespace App\Src\FqUser\Domain\Model;

use App\Foundation\Domain\Entity;

class WeixinLoginEntity extends Entity
{
    /**
     * @var int
     */
    public $id;

    public $identity_key = 'id';
    /**
     * @var string
     */
    public $mobile;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $reg_id;

    /**
     * @var string
     */
    public $ver_code;

    /**
     * @var string
     */
    public $ip;


    public function __construct()
    {
    }

}
