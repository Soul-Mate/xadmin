<?php

return [

    	/*
     * Laravel-admin name.
     */
    'name'      => 'XAdmin',

    /*
     * Logo in admin panel header.
     */
    'logo'      => '<b>X</b> Admin',

    /*
     * Mini-logo in admin panel header.
     */
    'logo-mini' => '<b>La</b>',

    /*
     * XAdmin url prefix.
     */
    'prefix'    => 'admin',

    /*
     * xadmin html title.
     */
    'title'  => 'XAdmin',



    /*
     * xadmin upload setting.
     */
    'upload'  => [

        'disk' => 'admin',

        'directory'  => [
            'image'  => 'image',
            'file'   => 'file',
        ],

        'host' => 'http://localhost:8000/upload/',
    ],

    'providers' =>  [
        Admin\Providers\AdminRouteServiceProvider::class,
        Admin\Providers\AdminAuthServiceProvider::class,
        Admin\Providers\AdminEventServiceProvider::class,
        Flash\FlashServiceProvider::class,
    ],

    'alias' =>  [
        'Flash'=>Flash\FlashFacade::class
    ],

    /*
     * By setting this option to open or close login log in xadmin.
     */
    'login_log'   => true,

    /*
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
     */
    'skin'    => 'skin-red-light',

    /*
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
     */
    'layout'  => ['sidebar-mini'],

    /*
     * Version displayed in footer.
     */
    'version'   => '1.0.0',
];
