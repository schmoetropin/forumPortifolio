<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class PostEditRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $editPostId = '';
    public string $editarPostTextarea = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'editPostId' => ['exists:id-posts'],
            'editarPostTextarea' => ['required', 'min:4', 'max:800']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'editPostId' => 'Post',
            'editarPostTextarea' => 'Conteudo do post'
        ];
    }
}