<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class TopicDeleteRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $topico = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'topico' => ['exists:unique_name-topics']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'topico' => 'Tópico não existe'
        ];
    }
}