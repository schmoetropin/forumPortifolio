<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class PostCreateRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $postConteudo = '';
    public string $nomeTopico = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'postConteudo' => ['required', 'min:4', 'max:800'],
            'nomeTopico' => ['exists:unique_name-topics']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'postConteudo' => 'Post',
            'nomeTopico' => 'Topico'
        ];
    }
}