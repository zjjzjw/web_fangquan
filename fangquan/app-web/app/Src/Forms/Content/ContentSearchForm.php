<?php

namespace App\Web\Src\Forms\Content;

use App\Src\Content\Domain\Model\ContentSpecification;
use App\Web\Src\Forms\Form;


class ContentSearchForm extends Form
{
    /**
     * @var ContentSpecification
     */
    public $content_specification;

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => 'nullable|string',
            'type'    => 'nullable|integer',
        ];
    }

    protected function messages()
    {
        return [
            'required' => ':attribute必填。',
            'integer'  => ':attribute必须整数',
        ];
    }

    public function validation()
    {
        $this->content_specification = new ContentSpecification();
        $this->content_specification->keyword = array_get($this->data, 'keyword');
        $this->content_specification->type = array_get($this->data, 'type');
    }
}