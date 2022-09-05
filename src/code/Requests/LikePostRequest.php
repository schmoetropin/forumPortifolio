<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class LikePostRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $likePost = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'likePost' => ['exists:id-posts']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'likePost' => 'Post não encontrado'
        ];
    }
}