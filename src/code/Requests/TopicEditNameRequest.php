<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class TopicEditNameRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $topPagId = '';
    public string $editarTitulo = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'topPagId' => ['exists:unique_name-topics'],
            'editarTitulo' => ['required', 'min:4', 'max:60']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'topPagId' => 'Tópico não existe',
            'editarTitulo' => 'Titulo do tópico'
        ];
    }
}