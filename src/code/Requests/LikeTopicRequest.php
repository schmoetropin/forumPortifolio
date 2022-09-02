<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class LikeTopicRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $likeTopico = '';
    public string $opcaoLikeUnlike = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'likeTopico' => ['exists:unique_name-topics'],
            'opcaoLikeUnlike' => ['exact:like|unlike']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'likeTopico' => 'Tópico não encontrado',
            'opcaoLikeUnlike' => 'Erro opção'
        ];
    }
}