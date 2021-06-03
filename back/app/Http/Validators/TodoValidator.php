<?php

namespace App\Http\Validators;

class TodoValidator
{

    public static $attributes = [
        'title' => 'title',
        'description' => 'description',
        'finished' => 'finished'
    ];

    /**
     * Validators dos attibutes
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'description' => 'string|nullable',
        'finished' => 'integer|nullable'
    ];

    public static $messages = [
        'required' => 'Atributo é obrigatório.',
        'email' => 'E-mail inválido.',
        'string' => 'Formato aceito: apenas String.',
        'integer' => 'Formato aceito: apenas Inteiro.',
        'int' => 'Formato aceito: apenas Inteiro.',
        'boolean' => 'Formato aceito: apenas boleano (true or false).',
        'uuid' => 'Formato aceito: apenas UUID',
        'date' => 'Formato de data inválido: yyyy-mm-dd',
        'confirmed' => 'Dados :attribute não são iguais',
        'min' => 'Mínimo de caracteres :min',
        'max' => 'Máximo de caracteres :max',
    ];
}