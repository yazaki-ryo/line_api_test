<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default permissions per role.
    |--------------------------------------------------------------------------
    |
    */

    'roles' => [
        'system' => [
            'system-admin' => 'システム管理者',
        ],
        'general' => [
            'company-admin' => '企業管理者',
            'store-user' => '店舗担当者',
        ],
    ],

    'default' => [
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
//                 'own-company-customers.restore',

                'own-company-self-store-customers.select',
                'own-company-self-store-customers.create',
                'own-company-self-store-customers.update',
                'own-company-self-store-customers.delete',
//                 'own-company-self-store-customers.restore',

                // Reservations
                'own-company-reservations.select',
                'own-company-reservations.create',
                'own-company-reservations.update',
                'own-company-reservations.delete',
//                 'own-company-reservations.restore',

                'own-company-self-store-reservations.select',
                'own-company-self-store-reservations.create',
                'own-company-self-store-reservations.update',
                'own-company-self-store-reservations.delete',
//                 'own-company-self-store-reservations.restore',

                // Visited Histories
                'own-company-customers-visited_histories.select',
                'own-company-customers-visited_histories.create',
                'own-company-customers-visited_histories.update',
                'own-company-customers-visited_histories.delete',
//                 'own-company-customers-visited_histories.restore',

                // Postcards
                'own-company-customers-postcards.export',

                // Settings
                'self-settings.printings.update',

                // Stores
                'own-company-stores.select',
                'own-company-stores.create',
                'own-company-stores.update',
                'own-company-stores.delete',
//                 'own-company-stores.restore',

                'own-company-self-store.select',
                'own-company-self-store.update',
                'own-company-self-store.delete',
//                 'own-company-self-store.restore',

                // Tags
                'own-company-tags.select',
                'own-company-tags.create',
                'own-company-tags.update',
                'own-company-tags.delete',
//                 'own-company-tags.restore',

                'own-company-self-store-tags.select',
                'own-company-self-store-tags.create',
                'own-company-self-store-tags.update',
                'own-company-self-store-tags.delete',
//                 'own-company-self-store-tags.restore',

                // Users
                'own-company-users.select',
                'own-company-users.create',
                'own-company-users.update',
                'own-company-users.delete',
//                 'own-company-users.restore',

                'own-company-self-store-users.select',
                'own-company-self-store-users.create',
                'own-company-self-store-users.update',
                'own-company-self-store-users.delete',
//                 'own-company-self-store-users.restore',
            ],

            'store-user' => [
                // Company
                'own-company.select',

                // Customers
                'own-company-self-store-customers.select',
                'own-company-self-store-customers.create',
                'own-company-self-store-customers.update',

                // Visited Histories
                'own-company-self-store-customers-visited_histories.select',
                'own-company-self-store-customers-visited_histories.create',
                'own-company-self-store-customers-visited_histories.update',
                'own-company-self-store-customers-visited_histories.delete',
//                 'own-company-self-store-customers-visited_histories.restore',

                // Postcards 
                // Store user is not output postcards
                // 'own-company-self-store-customers-postcards.export',

                // Reservations
                'own-company-self-store-reservations.select',
                'own-company-self-store-reservations.create',
                'own-company-self-store-reservations.update',

                // Settings
                'self-settings.printings.update',

                // Store
                'own-company-self-store.select',
                'own-company-self-store.update',

                // Tags
                'own-company-self-store-tags.select',
                'own-company-self-store-tags.create',
                'own-company-self-store-tags.update',

                // Users
                'own-company-self-store-users.select',
            ],
        ],

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
    ],

    'groups' => [
        'companies' => [
            'select' => [
                'companies.select',
                'own-company.select',
            ],
            'create' => [
                'companies.create',
            ],
            'update' => [
                'companies.update',
                'own-company.update',
            ],
            'delete' => [
                'companies.delete',
                'own-company.delete',
            ],
            'restore' => [
                'companies.restore',
                'own-company.restore',
            ],
        ],

        'customers' => [
            'select' => [
                'customers.select',
                'own-company-customers.select',
                'own-company-self-store-customers.select',
            ],
            'create' => [
                'customers.create',
                'own-company-customers.create',
                'own-company-self-store-customers.create',
            ],
            'update' => [
                'customers.update',
                'own-company-customers.update',
                'own-company-self-store-customers.update',
            ],
            'delete' => [
                'customers.delete',
                'own-company-customers.delete',
                'own-company-self-store-customers.delete',
            ],
            'restore' => [
                'customers.restore',
                'own-company-customers.restore',
                'own-company-self-store-customers.restore',
            ],
            'postcards' => [
                'export' => [
                    'customers-postcards.export',
                    'own-company-customers-postcards.export',
                    'own-company-self-store-customers-postcards.export',
                ],
            ],
            'visited_histories' => [
                'select' => [
                    'customers-visited_histories.select',
                    'own-company-customers-visited_histories.select',
                    'own-company-self-store-customers-visited_histories.select',
                ],
                'create' => [
                    'customers-visited_histories.create',
                    'own-company-customers-visited_histories.create',
                    'own-company-self-store-customers-visited_histories.create',
                ],
                'update' => [
                    'customers-visited_histories.update',
                    'own-company-customers-visited_histories.update',
                    'own-company-self-store-customers-visited_histories.update',
                ],
                'delete' => [
                    'customers-visited_histories.delete',
                    'own-company-customers-visited_histories.delete',
                    'own-company-self-store-customers-visited_histories.delete',
                ],
                'restore' => [
                    'customers-visited_histories.restore',
                    'own-company-customers-visited_histories.restore',
                    'own-company-self-store-customers-visited_histories.restore',
                ],
            ],
        ],

        'reservations' => [
            'select' => [
                'reservations.select',
                'own-company-reservations.select',
                'own-company-self-store-reservations.select',
            ],
            'create' => [
                'reservations.create',
                'own-company-reservations.create',
                'own-company-self-store-reservations.create',
            ],
            'update' => [
                'reservations.update',
                'own-company-reservations.update',
                'own-company-self-store-reservations.update',
            ],
            'delete' => [
                'reservations.delete',
                'own-company-reservations.delete',
                'own-company-self-store-reservations.delete',
            ],
            'restore' => [
                'reservations.restore',
                'own-company-reservations.restore',
                'own-company-self-store-reservations.restore',
            ],
        ],

        'settings' => [
            //
        ],

        'stores' => [
            'select' => [
                'stores.select',
                'own-company-stores.select',
                'own-company-self-store.select',
            ],
            'create' => [
                'stores.create',
                'own-company-stores.create',
            ],
            'update' => [
                'stores.update',
                'own-company-stores.update',
                'own-company-self-store.update',
            ],
            'delete' => [
                'stores.delete',
                'own-company-stores.delete',
                'own-company-self-store.delete',
            ],
            'restore' => [
                'stores.restore',
                'own-company-stores.restore',
                'own-company-self-store.restore',
            ],
        ],

        'tags' => [
            'select' => [
                'tags.select',
                'own-company-tags.select',
                'own-company-self-store-tags.select',
            ],
            'create' => [
                'tags.create',
                'own-company-tags.create',
                'own-company-self-store-tags.create',
            ],
            'update' => [
                'tags.update',
                'own-company-tags.update',
                'own-company-self-store-tags.update',
            ],
            'delete' => [
                'tags.delete',
                'own-company-tags.delete',
                'own-company-self-store-tags.delete',
            ],
            'restore' => [
                'tags.restore',
                'own-company-tags.restore',
                'own-company-self-store-tags.restore',
            ],
        ],

        'users' => [
            'select' => [
                'users.select',
                'own-company-users.select',
                'own-company-self-store-users.select',
            ],
            'create' => [
                'users.create',
                'own-company-users.create',
                'own-company-self-store-users.create',
            ],
            'update' => [
                'users.update',
                'own-company-users.update',
                'own-company-self-store-users.update',
            ],
            'delete' => [
                'users.delete',
                'own-company-users.delete',
                'own-company-self-store-users.delete',
            ],
            'restore' => [
                'users.restore',
                'own-company-users.restore',
                'own-company-self-store-users.restore',
            ],
        ],
    ],

    'seeds' => [
        'companies' => [
            // all
            [
                'name'  => '全企業情報閲覧',
                'slug'  => 'companies.select',
            ],
            [
                'name'  => '全企業情報作成',
                'slug'  => 'companies.create',
            ],
            [
                'name'  => '全企業情報更新',
                'slug'  => 'companies.update',
            ],
            [
                'name'  => '全企業情報削除',
                'slug'  => 'companies.delete',
            ],
            [
                'name'  => '全企業情報復旧',
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
                'name'  => '全顧客情報閲覧',
                'slug'  => 'customers.select',
            ],
            [
                'name'  => '全顧客情報作成',
                'slug'  => 'customers.create',
            ],
            [
                'name'  => '全顧客情報更新',
                'slug'  => 'customers.update',
            ],
            [
                'name'  => '全顧客情報削除',
                'slug'  => 'customers.delete',
            ],
            [
                'name'  => '全顧客情報復旧',
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

            // visited_histories
            // all
            [
                'name'  => '全顧客来店履歴閲覧',
                'slug'  => 'customers-visited_histories.select',
            ],
            [
                'name'  => '全顧客来店履歴作成',
                'slug'  => 'customers-visited_histories.create',
            ],
            [
                'name'  => '全顧客来店履歴更新',
                'slug'  => 'customers-visited_histories.update',
            ],
            [
                'name'  => '全顧客来店履歴削除',
                'slug'  => 'customers-visited_histories.delete',
            ],
            [
                'name'  => '全顧客来店履歴復旧',
                'slug'  => 'customers-visited_histories.restore',
            ],

            // 自社店舗
            [
                'name'  => '自社顧客来店履歴閲覧',
                'slug'  => 'own-company-customers-visited_histories.select',
            ],
            [
                'name'  => '自社顧客来店履歴作成',
                'slug'  => 'own-company-customers-visited_histories.create',
            ],
            [
                'name'  => '自社顧客来店履歴更新',
                'slug'  => 'own-company-customers-visited_histories.update',
            ],
            [
                'name'  => '自社顧客来店履歴削除',
                'slug'  => 'own-company-customers-visited_histories.delete',
            ],
            [
                'name'  => '自社顧客来店履歴復旧',
                'slug'  => 'own-company-customers-visited_histories.restore',
            ],

            // 自店舗
            [
                'name'  => '自店舗顧客来店履歴閲覧',
                'slug'  => 'own-company-self-store-customers-visited_histories.select',
            ],
            [
                'name'  => '自店舗顧客来店履歴作成',
                'slug'  => 'own-company-self-store-customers-visited_histories.create',
            ],
            [
                'name'  => '自店舗顧客来店履歴更新',
                'slug'  => 'own-company-self-store-customers-visited_histories.update',
            ],
            [
                'name'  => '自店舗顧客来店履歴削除',
                'slug'  => 'own-company-self-store-customers-visited_histories.delete',
            ],
            [
                'name'  => '自店舗顧客来店履歴復旧',
                'slug'  => 'own-company-self-store-customers-visited_histories.restore',
            ],

            // postcards
            // all
            [
                'name'  => '全顧客ハガキ印刷',
                'slug'  => 'customers-postcards.export',
            ],

            // 自社店舗
            [
                'name'  => '自社顧客ハガキ印刷',
                'slug'  => 'own-company-customers-postcards.export',
            ],

            // 自店舗
            [
                'name'  => '自店舗顧客ハガキ印刷',
                'slug'  => 'own-company-self-store-customers-postcards.export',
            ],
        ],

        'reservations' => [
            // all
            [
                'name'  => '全予約閲覧',
                'slug'  => 'reservations.select',
            ],
            [
                'name'  => '全予約作成',
                'slug'  => 'reservations.create',
            ],
            [
                'name'  => '全予約更新',
                'slug'  => 'reservations.update',
            ],
            [
                'name'  => '全予約削除',
                'slug'  => 'reservations.delete',
            ],
            [
                'name'  => '全予約復旧',
                'slug'  => 'reservations.restore',
            ],

            // 自社
            [
                'name'  => '自社予約閲覧',
                'slug'  => 'own-company-reservations.select',
            ],
            [
                'name'  => '自社予約作成',
                'slug'  => 'own-company-reservations.create',
            ],
            [
                'name'  => '自社予約更新',
                'slug'  => 'own-company-reservations.update',
            ],
            [
                'name'  => '自社予約削除',
                'slug'  => 'own-company-reservations.delete',
            ],
            [
                'name'  => '自社予約復旧',
                'slug'  => 'own-company-reservations.restore',
            ],

            // 自店舗
            [
                'name'  => '自店舗予約閲覧',
                'slug'  => 'own-company-self-store-reservations.select',
            ],
            [
                'name'  => '自店舗予約作成',
                'slug'  => 'own-company-self-store-reservations.create',
            ],
            [
                'name'  => '自店舗予約更新',
                'slug'  => 'own-company-self-store-reservations.update',
            ],
            [
                'name'  => '自店舗予約削除',
                'slug'  => 'own-company-self-store-reservations.delete',
            ],
            [
                'name'  => '自店舗予約復旧',
                'slug'  => 'own-company-self-store-reservations.restore',
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
                'name'  => '全店舗情報閲覧',
                'slug'  => 'stores.select',
            ],
            [
                'name'  => '全店舗情報作成',
                'slug'  => 'stores.create',
            ],
            [
                'name'  => '全店舗情報更新',
                'slug'  => 'stores.update',
            ],
            [
                'name'  => '全店舗情報削除',
                'slug'  => 'stores.delete',
            ],
            [
                'name'  => '全店舗情報復旧',
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
                'name'  => '全タグ閲覧',
                'slug'  => 'tags.select',
            ],
            [
                'name'  => '全タグ作成',
                'slug'  => 'tags.create',
            ],
            [
                'name'  => '全タグ更新',
                'slug'  => 'tags.update',
            ],
            [
                'name'  => '全タグ削除',
                'slug'  => 'tags.delete',
            ],
            [
                'name'  => '全タグ復旧',
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
                'name'  => '全ユーザー情報閲覧',
                'slug'  => 'users.select',
            ],
            [
                'name'  => '全ユーザー情報作成',
                'slug'  => 'users.create',
            ],
            [
                'name'  => '全ユーザー情報更新',
                'slug'  => 'users.update',
            ],
            [
                'name'  => '全ユーザー情報削除',
                'slug'  => 'users.delete',
            ],
            [
                'name'  => '全ユーザー情報復旧',
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
