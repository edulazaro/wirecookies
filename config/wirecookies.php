<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Política de cookies
    |--------------------------------------------------------------------------
    | URL absoluta o ruta nombrada de la página de política. Se enlaza desde
    | el banner y el modal. Si es null, no se muestra el enlace.
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
    | Cada entrada: label + descripción + default activado.
    */
    'categories' => [
        'essential' => [
            'label' => 'Cookies esenciales',
            'description' => 'Necesarias para el funcionamiento básico del sitio: sesión, autenticación y seguridad. No se pueden desactivar.',
            'required' => true,
            'default' => true,
        ],
        'analytics' => [
            'label' => 'Cookies de análisis',
            'description' => 'Nos ayudan a entender cómo se usa la web y detectar problemas técnicos.',
            'required' => false,
            'default' => false,
        ],
        'marketing' => [
            'label' => 'Cookies de marketing',
            'description' => 'Permiten medir la eficacia de campañas y mostrar contenido relevante en otras plataformas.',
            'required' => false,
            'default' => false,
        ],
        'functional' => [
            'label' => 'Cookies funcionales',
            'description' => 'Recuerdan preferencias como idioma o configuración personal.',
            'required' => false,
            'default' => false,
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
