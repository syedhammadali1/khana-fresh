<?php

return [
    [
        'name' => 'Dashboard',
        'url' => '/',
        'key' => 'dashboard',
        'group' => '',
        'iconClass' => 'lni lni-anchor'
    ],
    // [
    //     'name' => 'Roles',
    //     'url' => '/roles',
    //     'key' => ['roles.create', 'roles.list'],
    //     'iconClass' => 'lni lni-shield',
    //     'group' => '',
    //     'child' => [
    //         [
    //             'name' => 'Add Role',
    //             'key' => 'add',
    //             'url' => '/roles/create',
    //             'key' => 'roles.create',
    //         ],
    //         [
    //             'key' => 'list',
    //             'name' => 'Role List',
    //             'url' => '/roles',
    //             'key' => 'roles.list',
    //         ]
    //     ]
    // ],
    [
        'name' => 'Users',
        'url' => '/users',
        'key' => ['users.create', 'users.list'],
        'group' => '',
        'child' => [
            [
                'name' => 'Add',
                'url' => '/users/create',
                'key' => 'users.create',
            ],
            [
                'name' => 'List',
                'url' => '/users',
                'key' => 'users.list',
            ],
        ]
    ],
    [
        'name' => 'Pages',
        'url' => '/pages',
        'key' => ['pages.create', 'pages.list'],
        'group' => '',
        'child' => [
            [
                'name' => 'Add',
                'url' => '/pages/create',
                'key' => 'pages.create',
            ],
            [
                'name' => 'List',
                'url' => '/pages',
                'key' => 'pages.list',
            ],
        ]
    ],
    // [
    //     'name' => 'Widgets',
    //     'url' => '/widgets',
    //     'key' => 'widgets',
    //     'group' => '',
    //     'iconClass' => 'lni lni-anchor'
    // ],
    // [
    //     'name' => 'eCommerce',
    //     'url' => '/ecommerce',
    //     'key' => 'ecommerce',
    //     'group' => '',
    //     'child' => [
    //         [
    //             'name' => 'Products',
    //             'url' => '/ecommerce-products',
    //             'key' => 'ecommerce-products',
    //             'iconClass' => 'bx bx-message-add'
    //         ],
    //         [
    //             'name' => 'Product Details',
    //             'url' => '/ecommerce-products-details',
    //             'key' => 'ecommerce-products-details',
    //         ]
    //     ]
    // ],
    // [
    //     'name' => 'Menu Levels',
    //     'url' => '/ecommerce',
    //     'key' => 'ecommerce',
    //     'group' => '',
    //     'child' => [
    //         [
    //             'name' => 'Level One',
    //             'url' => '/ecommerce-products',
    //             'key' => 'ecommerce-products',
    //             'child' => [
    //                 [
    //                     'name' => 'Level Two',
    //                     'url' => '/ecommerce-products',
    //                     'key' => 'ecommerce-products',
    //                     'child' => [
    //                         [
    //                             'name' => 'Level Three',
    //                             'url' => '/ecommerce-products',
    //                             'key' => 'ecommerce-products',
    //                             'iconClass' => 'bx bx-caret-up-circle',
    //                         ],
    //                     ],
    //                 ]
    //             ],
    //         ]
    //     ],
    // ]
];
