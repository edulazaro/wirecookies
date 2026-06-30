<?php

return [
    'title'            => 'Cookie settings',
    'description'      => 'We use our own and third-party cookies to analyze site usage and improve our services. You can accept all, reject them, or set your preferences.',
    'accept_all'       => 'Accept all',
    'reject_all'       => 'Reject all',
    'configure'        => 'Configure',
    'save_preferences' => 'Save preferences',
    'reject_optional'  => 'Reject optional',
    'more_policy'      => 'Learn more',
    'view_full_policy' => 'View full policy',
    'modal_title'      => 'Cookie preferences',
    'always_active'    => 'Always active',

    /*
    | Text for each category. Keys match `config('wirecookies.categories')`.
    | A project may override label/description per category in the config;
    | otherwise these are used.
    */
    'categories' => [
        'essential' => [
            'label'       => 'Essential cookies',
            'description' => 'Required for the basic operation of the site: session, authentication and security. They cannot be disabled.',
        ],
        'analytics' => [
            'label'       => 'Analytics cookies',
            'description' => 'Help us understand how the site is used and detect technical issues.',
        ],
        'marketing' => [
            'label'       => 'Marketing cookies',
            'description' => 'Let us measure campaign effectiveness and show relevant content on other platforms.',
        ],
        'functional' => [
            'label'       => 'Functional cookies',
            'description' => 'Remember preferences such as language or personal settings.',
        ],
    ],
];
