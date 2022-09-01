<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class TopicEditContentRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $topPagId = '';
    public string $editarConteudo = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'topPagId' => ['exists:unique_name-topics'],
            'editarConteudo' => ['required', 'min:4']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'topPagId' => 'Tópico não existe',
            'editarConteudo' => 'Conteúdo do tópico'
        ];
    }
}