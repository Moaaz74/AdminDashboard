<?php 
return [
    'template' => [
        'nav'           => TEMPLATE_PATH . 'nav.php',
        'content'       => TEMPLATE_PATH . 'content.php',
        'startbody'     => TEMPLATE_PATH . 'startbody.php',
        ':view'    => ':action_view',
    ],
    'header_resources' => [
        'css' => [
            'style'     => CSS . 'style.css',
        ]
        
    ],
    'footer_resources' => [
        
    ],
    'view_resources' => [
        'css' => [
            'ss'     => CSS . 'ss.css'
        ]
        
    ]
        ];