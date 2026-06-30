<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Política de cookies
    |--------------------------------------------------------------------------
    | Enlace a la página de política. Se muestra en el banner y el modal.
    | Puede ser:
    |   - string: misma URL para todos los idiomas → '/cookies' o 'https://...'
    |   - array por locale: ['es' => '/cookies', 'en' => '/en/cookies']
    | Si es null, no se muestra el enlace.
    */
    'policy_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Delay antes de mostrar el banner (ms)
    |--------------------------------------------------------------------------
    | Da tiempo al render del DOM y evita el "salto" en el primer paint.
    */
    'delay' => 800,

    /*
    |--------------------------------------------------------------------------
    | Categorías de cookies disponibles
    |--------------------------------------------------------------------------
    | 'essential' siempre va y no es desactivable. El resto son opt-in.
    | Cada entrada define el COMPORTAMIENTO (required + default). El TEXTO
    | (label + description) sale de las traducciones:
    |   lang/{locale}/wirecookies.php → 'categories.{clave}.label|description'
    | Puedes sobrescribir el texto de una categoría añadiéndole aquí
    | 'label' / 'description' (tendrán prioridad sobre la traducción).
    */
    'categories' => [
        'essential' => [
            'required' => true,
            'default'  => true,
        ],
        'analytics' => [
            'required' => false,
            'default'  => false,
        ],
        'marketing' => [
            'required' => false,
            'default'  => false,
        ],
        'functional' => [
            'required' => false,
            'default'  => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Persistencia
    |--------------------------------------------------------------------------
    | Clave en localStorage donde se guardan las preferencias del usuario.
    */
    'storage_key' => 'cookie-preferences',
];
