<?php

namespace App\Admin\Src\Forms\Provider;

use App\Src\FqUser\Domain\Model\FqUserEntity;
use App\Src\FqUser\Domain\Model\FqUserRoleType;
use App\Src\FqUser\Infra\Repository\FqUserRepository;
use App\Src\Provider\Domain\Model\ProviderSpecification;
use App\Admin\Src\Forms\Form;

class ProviderSearchForm extends Form
{

    /**
     * @var ProviderSpecification
     */
    public $provider_specification;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword'     => 'nullable|string',
            'provider_id' => 'nullable|integer',
            'company_type' => 'nullable|integer',
            'status' => 'nullable|integer',
        ];
    }

    protected function messages()
    {
        return [
            'required'    => ':attribute必填。',
            'date_format' => ':attribute格式错误',
            'integer'     => ':attribute必须是数字',
            'string'      => ':attribute必须是字符串',
        ];
    }

    public function attributes()
    {
        return [
            'keyword'     => '关键字',
            'provider_id' => '唯一标识',
            'company_type' => '公司类型',
            'status' => '公司状态',
        ];
    }

    public function validation()
    {
        $this->provider_specification = new ProviderSpecification();
        $this->provider_specification->keyword = array_get($this->data, 'keyword');

        $user_id = request()->user()->id;
        $fq_user_repository = new FqUserRepository();
        /** @var FqUserEntity $fq_user_entity */
        $fq_user_entity = $fq_user_repository->fetch($user_id);

        $this->provider_specification->company_type = array_get($this->data, 'company_type');
        $this->provider_specification->status = array_get($this->data, 'status');
        if ($fq_user_entity->role_type == FqUserRoleType::PROVIDER) {
            $this->provider_specification->provider_id = $fq_user_entity->role_id;
            if (empty($this->provider_specification->provider_id)) {
                $this->provider_specification->provider_id = 999999;
            }
        } else {
            $this->provider_specification->provider_id = array_get($this->data, 'provider_id');
        }

    }
}