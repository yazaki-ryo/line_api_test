<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default permissions per role.
    |--------------------------------------------------------------------------
    |
    */

    'default' => [
        /**
         * system
         */
        'system' => [
            'system-admin' => [
                // Companies
                'companies.select',
                'companies.create',
                'companies.update',
                'companies.delete',
                'companies.restore',

                // Customers
                'customers.select',
                'customers.create',
                'customers.update',
                'customers.delete',
                'customers.restore',

                // Stores
                'stores.select',
                'stores.create',
                'stores.update',
                'stores.delete',
                'stores.restore',

                // Users
                'users.select',
                'users.create',
                'users.update',
                'users.delete',
                'users.restore',
            ],
        ],

        'general' => [
            'company-admin' => [
                // Company
                'own-company.select',
                'own-company.update',

                // Customers
                'own-company-customers.select',
                'own-company-customers.create',
                'own-company-customers.update',
                'own-company-customers.delete',
                'own-company-customers.restore',

                // Settings
                'self-settings.printings.update',

                // Stores
                'own-company-stores.select',
//                 'own-company-stores.create',
                'own-company-stores.update',
//                 'own-company-stores.delete',
//                 'own-company-stores.restore',

                // Tags
                'own-company-tags.select',
                'own-company-tags.create',
                'own-company-tags.update',
                'own-company-tags.delete',

                // Users
                'own-company-users.select',
                'own-company-users.create',
                'own-company-users.update',
                'own-company-users.delete',
                'own-company-users.restore',
            ],

            /**
             * 店舗担当者
             */
            'store-user' => [
                // Company
                'own-company.select',

                // Customers
                'own-company-self-store-customers.select',
                'own-company-self-store-customers.create',
                'own-company-self-store-customers.update',

                // Settings
                'self-settings.printings.update',

                // Store
                'own-company-self-store.select',
                'own-company-self-store.update',

                // Tags
                'own-company-self-store-tags.select',
                'own-company-self-store-tags.create',
                'own-company-self-store-tags.update',
                'own-company-self-store-tags.delete',

                // Users
                'own-company-self-store-users.select',
            ],
        ],
    ],

    'seeds' => [
        'companies' => [
            // all
            [
                'name'  => '企業情報閲覧',
                'slug'  => 'companies.select',
            ],
            [
                'name'  => '企業情報作成',
                'slug'  => 'companies.create',
            ],
            [
                'name'  => '企業情報更新',
                'slug'  => 'companies.update',
            ],
            [
                'name'  => '企業情報削除',
                'slug'  => 'companies.delete',
            ],
            [
                'name'  => '企業情報復旧',
                'slug'  => 'companies.restore',
            ],

            // 自社
            [
                'name'  => '自社情報閲覧',
                'slug'  => 'own-company.select',
            ],
            [
                'name'  => '自社情報更新',
                'slug'  => 'own-company.update',
            ],
            [
                'name'  => '自社情報削除',
                'slug'  => 'own-company.delete',
            ],
            [
                'name'  => '自社情報復旧',
                'slug'  => 'own-company.restore',
            ],
        ],

        'customers' => [
            // all
            [
                'name'  => '顧客情報閲覧',
                'slug'  => 'customers.select',
            ],
            [
                'name'  => '顧客情報作成',
                'slug'  => 'customers.create',
            ],
            [
                'name'  => '顧客情報更新',
                'slug'  => 'customers.update',
            ],
            [
                'name'  => '顧客情報削除',
                'slug'  => 'customers.delete',
            ],
            [
                'name'  => '顧客情報復旧',
                'slug'  => 'customers.restore',
            ],

            // 自社
            [
                'name'  => '自社顧客情報閲覧',
                'slug'  => 'own-company-customers.select',
            ],
            [
                'name'  => '自社顧客情報作成',
                'slug'  => 'own-company-customers.create',
            ],
            [
                'name'  => '自社顧客情報更新',
                'slug'  => 'own-company-customers.update',
            ],
            [
                'name'  => '自社顧客情報削除',
                'slug'  => 'own-company-customers.delete',
            ],
            [
                'name'  => '自社顧客情報復旧',
                'slug'  => 'own-company-customers.restore',
            ],

            // 自店舗
            [
                'name'  => '自店舗顧客情報閲覧',
                'slug'  => 'own-company-self-store-customers.select',
            ],
            [
                'name'  => '自店舗顧客情報作成',
                'slug'  => 'own-company-self-store-customers.create',
            ],
            [
                'name'  => '自店舗顧客情報更新',
                'slug'  => 'own-company-self-store-customers.update',
            ],
            [
                'name'  => '自店舗顧客情報削除',
                'slug'  => 'own-company-self-store-customers.delete',
            ],
            [
                'name'  => '自店舗顧客情報復旧',
                'slug'  => 'own-company-self-store-customers.restore',
            ],
        ],

        'settings' => [
            [
                'name'  => '自身印刷設定更新',
                'slug'  => 'self-settings.printings.update',
            ],
        ],

        'stores' => [
            // all
            [
                'name'  => '店舗情報閲覧',
                'slug'  => 'stores.select',
            ],
            [
                'name'  => '店舗情報作成',
                'slug'  => 'stores.create',
            ],
            [
                'name'  => '店舗情報更新',
                'slug'  => 'stores.update',
            ],
            [
                'name'  => '店舗情報削除',
                'slug'  => 'stores.delete',
            ],
            [
                'name'  => '店舗情報復旧',
                'slug'  => 'stores.restore',
            ],

            // 自社店舗
            [
                'name'  => '自社店舗情報閲覧',
                'slug'  => 'own-company-stores.select',
            ],
            [
                'name'  => '自社店舗情報作成',
                'slug'  => 'own-company-stores.create',
            ],
            [
                'name'  => '自社店舗情報更新',
                'slug'  => 'own-company-stores.update',
            ],
            [
                'name'  => '自社店舗情報削除',
                'slug'  => 'own-company-stores.delete',
            ],
            [
                'name'  => '自社店舗情報復旧',
                'slug'  => 'own-company-stores.restore',
            ],

            // 自店舗
            [
                'name'  => '自店舗情報閲覧',
                'slug'  => 'own-company-self-store.select',
            ],
            [
                'name'  => '自店舗情報更新',
                'slug'  => 'own-company-self-store.update',
            ],
            [
                'name'  => '自店舗情報削除',
                'slug'  => 'own-company-self-store.delete',
            ],
            [
                'name'  => '自店舗情報復旧',
                'slug'  => 'own-company-self-store.restore',
            ],
        ],

        'tags' => [
            // all
            [
                'name'  => 'タグ閲覧',
                'slug'  => 'tags.select',
            ],
            [
                'name'  => 'タグ作成',
                'slug'  => 'tags.create',
            ],
            [
                'name'  => 'タグ更新',
                'slug'  => 'tags.update',
            ],
            [
                'name'  => 'タグ削除',
                'slug'  => 'tags.delete',
            ],
            [
                'name'  => 'タグ復旧',
                'slug'  => 'tags.restore',
            ],

            // 自社
            [
                'name'  => '自社タグ閲覧',
                'slug'  => 'own-company-tags.select',
            ],
            [
                'name'  => '自社タグ作成',
                'slug'  => 'own-company-tags.create',
            ],
            [
                'name'  => '自社タグ更新',
                'slug'  => 'own-company-tags.update',
            ],
            [
                'name'  => '自社タグ削除',
                'slug'  => 'own-company-tags.delete',
            ],
            [
                'name'  => '自社タグ復旧',
                'slug'  => 'own-company-tags.restore',
            ],

            // 自店舗
            [
                'name'  => '自店舗タグ閲覧',
                'slug'  => 'own-company-self-store-tags.select',
            ],
            [
                'name'  => '自店舗タグ作成',
                'slug'  => 'own-company-self-store-tags.create',
            ],
            [
                'name'  => '自店舗タグ更新',
                'slug'  => 'own-company-self-store-tags.update',
            ],
            [
                'name'  => '自店舗タグ削除',
                'slug'  => 'own-company-self-store-tags.delete',
            ],
            [
                'name'  => '自店舗タグ復旧',
                'slug'  => 'own-company-self-store-tags.restore',
            ],
        ],

        'users' => [
            // all
            [
                'name'  => 'ユーザー情報閲覧',
                'slug'  => 'users.select',
            ],
            [
                'name'  => 'ユーザー情報作成',
                'slug'  => 'users.create',
            ],
            [
                'name'  => 'ユーザー情報更新',
                'slug'  => 'users.update',
            ],
            [
                'name'  => 'ユーザー情報削除',
                'slug'  => 'users.delete',
            ],
            [
                'name'  => 'ユーザー情報復旧',
                'slug'  => 'users.restore',
            ],

            // 自社
            [
                'name'  => '自社ユーザー情報閲覧',
                'slug'  => 'own-company-users.select',
            ],
            [
                'name'  => '自社ユーザー情報作成',
                'slug'  => 'own-company-users.create',
            ],
            [
                'name'  => '自社ユーザー情報更新',
                'slug'  => 'own-company-users.update',
            ],
            [
                'name'  => '自社ユーザー情報削除',
                'slug'  => 'own-company-users.delete',
            ],
            [
                'name'  => '自社ユーザー情報復旧',
                'slug'  => 'own-company-users.restore',
            ],

            // 自店舗
            [
                'name'  => '自店舗ユーザー情報閲覧',
                'slug'  => 'own-company-self-store-users.select',
            ],
            [
                'name'  => '自店舗ユーザー情報作成',
                'slug'  => 'own-company-self-store-users.create',
            ],
            [
                'name'  => '自店舗ユーザー情報更新',
                'slug'  => 'own-company-self-store-users.update',
            ],
            [
                'name'  => '自店舗ユーザー情報削除',
                'slug'  => 'own-company-self-store-users.delete',
            ],
            [
                'name'  => '自店舗ユーザー情報復旧',
                'slug'  => 'own-company-self-store-users.restore',
            ],
        ],
    ],

];
