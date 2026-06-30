<?php

return [
    'title'            => 'Configuración de cookies',
    'description'      => 'Usamos cookies propias y de terceros para analizar el uso de la web y mejorar nuestros servicios. Puedes aceptarlas todas, rechazarlas o configurar tus preferencias.',
    'accept_all'       => 'Aceptar todo',
    'reject_all'       => 'Rechazar todo',
    'configure'        => 'Configurar',
    'save_preferences' => 'Guardar preferencias',
    'reject_optional'  => 'Rechazar opcionales',
    'more_policy'      => 'Más información',
    'view_full_policy' => 'Ver política completa',
    'modal_title'      => 'Preferencias de cookies',
    'always_active'    => 'Siempre activas',

    /*
    | Texto de cada categoría. Las claves coinciden con las de
    | `config('wirecookies.categories')`. Un proyecto puede sobrescribir
    | label/description por categoría en el config; si no, se usan estos.
    */
    'categories' => [
        'essential' => [
            'label'       => 'Cookies esenciales',
            'description' => 'Necesarias para el funcionamiento básico del sitio: sesión, autenticación y seguridad. No se pueden desactivar.',
        ],
        'analytics' => [
            'label'       => 'Cookies de análisis',
            'description' => 'Nos ayudan a entender cómo se usa la web y detectar problemas técnicos.',
        ],
        'marketing' => [
            'label'       => 'Cookies de marketing',
            'description' => 'Permiten medir la eficacia de campañas y mostrar contenido relevante en otras plataformas.',
        ],
        'functional' => [
            'label'       => 'Cookies funcionales',
            'description' => 'Recuerdan preferencias como idioma o configuración personal.',
        ],
    ],
];
