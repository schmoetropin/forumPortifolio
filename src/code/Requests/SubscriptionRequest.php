<?php
declare(strict_types=1);

namespace Src\Code\Requests;

use Src\Core\FormValidation;

class SubscriptionRequest extends FormValidation
{
    /**
     * @var string
     */
    public string $increverDesiscrever = '';
    public string $comunidade = '';

    /**
     * @return array
     */
    protected function validation(): array
    {
        return [
            'increverDesiscrever' => ['required', 'exact:desiscrever|inscrever'],
            'comunidade' => ['exists:unique_name-communities']
        ];
    }

    /**
     * @return array
     */     
    protected function fieldName(): array
    {
        return [
            'increverDesiscrever' => 'Inscrição',
            'comunidade' => 'Erro comunidade'
        ];
    }
}