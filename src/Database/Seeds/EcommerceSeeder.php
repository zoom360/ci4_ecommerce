<?php

namespace Adnduweb\Ci4_ecommerce\Database\Seeds;

use joshtronic\LoremIpsum;

class EcommerceSeeder extends \CodeIgniter\Database\Seeder
{
    //\\Adnduweb\\Ci4_ecommerce\\Database\\Seeds\\BlogSeeder
    /**
     * @return mixed|void
     */
    function run()
    {

        $rowsGroups = [
            [
                'id'                => 1,
                'name'              => 'default',
                'description'       => 'default',
                'login_destination' => 'dashboard',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],

        ];

        // on insrére les groupes par défault
        $db = \Config\Database::connect();
        foreach ($rowsGroups as $row) {
            $tabRow =  $db->table('authf_groups')->where('name', $row['name'])->get()->getRow();
            if (empty($tabRow)) {
                // No langue - add the row
                $db->table('authf_groups')->insert($row);
            }
        }

        $lipsum = new LoremIpsum();
        // Define default project setting templates
        $rowsCat = [
            [
                'id_category' => 1,
                'id_parent'    => 0,
                'order'        => 1,
                'active'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            ]

        ];
        $rowsCatLang = [
            [
                'id_category'      => 1,
                'id_lang'           => 1,
                'name'              => 'Défaut',
                'description_short' => $lipsum->sentence(),
                'slug'              => 'default'
            ]

        ];

        // Check for and create project setting templates
        //$pages = new PagesModel();
        $db = \Config\Database::connect();
        foreach ($rowsCat as $row) {
            $article = $db->table('ec_category')->where('id_category', $row['id_category'])->get()->getRow();
            //print_r($article); exit;
            if (empty($article)) {
                // No setting - add the row
                $db->table('ec_category')->insert($row);
            }
        }

        foreach ($rowsCatLang as $rowLang) {
            $articlelang = $db->table('ec_category_lang')->where('id_category', $rowLang['id_category'])->get()->getRow();

            if (empty($articlelang)) {
                // No setting - add the row
                $db->table('ec_category_lang')->insert($rowLang);
            }
        }



        // gestionde l'application
        $rowsBlogTabs = [
            'id_parent'         => 20,
            'depth'             => 2,
            'left'              => 11,
            'right'             => 19,
            'position'          => 1,
            'section'           => 0,
            'module'            => 'Adnduweb\Ci4_ecommerce',
            'class_name'        => 'AdminEcommerce',
            'active'            =>  1,
            'icon'              => '',
            'slug'             => 'catalogue',
            'name_controller'       => ''
        ];

        $rowsBlogTabsLangs = [
            [
                'id_lang'         => 1,
                'name'             => 'catalogue',
            ],
            [
                'id_lang'         => 2,
                'name'             => 'catalogue',
            ],
        ];


        $rowsArticlesTabs = [
            'depth'             => 3,
            'left'              => 12,
            'right'             => 13,
            'position'          => 1,
            'section'           => 0,
            'module'            => 'Adnduweb\Ci4_ecommerce',
            'class_name'        => 'AdminProduct',
            'active'            =>  1,
            'icon'              => '',
            'slug'             => 'catalogue/product',
            'name_controller'       => ''
        ];

        $rowsArticlesTabsLangs = [
            [
                'id_lang'         => 1,
                'name'             => 'produits',
            ],
            [
                'id_lang'         => 2,
                'name'             => 'produits',
            ],
        ];

        $rowsCatTabs = [
            'depth'             => 3,
            'left'              => 14,
            'right'             => 15,
            'position'          => 1,
            'section'           => 0,
            'module'            => 'Adnduweb\Ci4_ecommerce',
            'class_name'        => 'AdminCategory',
            'active'            =>  1,
            'icon'              => '',
            'slug'             => 'catalogue/category',
            'name_controller'       => ''
        ];

        $rowsCatTabsLangs = [
            [
                'id_lang'         => 1,
                'name'             => 'catégories',
            ],
            [
                'id_lang'         => 2,
                'name'             => 'catégories',
            ],
        ];

        // $rowsTagsTabs = [
        //     'depth'             => 3,
        //     'left'              => 16,
        //     'right'             => 17,
        //     'position'          => 1,
        //     'section'           => 0,
        //     'module'            => 'Adnduweb\Ci4_ecommerce',
        //     'class_name'        => 'AdminTags',
        //     'active'            =>  1,
        //     'icon'              => '',
        //     'slug'             => 'blog/tags',
        //     'name_controller'       => ''
        // ];

        // $rowsTagsTabsLangs = [
        //     [
        //         'id_lang'         => 1,
        //         'name'             => 'tags',
        //     ],
        //     [
        //         'id_lang'         => 2,
        //         'name'             => 'tags',
        //     ],
        // ];

        // $rowsSettingsTabs = [
        //     'depth'             => 3,
        //     'left'              => 18,
        //     'right'             => 19,
        //     'position'          => 1,
        //     'section'           => 0,
        //     'module'            => 'Adnduweb\Ci4_ecommerce',
        //     'class_name'        => 'AdminBlogSettings',
        //     'active'            =>  1,
        //     'icon'              => '',
        //     'slug'             => 'blog/settings',
        //     'name_controller'       => ''
        // ];

        // $rowsSettingsTabsLangs = [
        //     [
        //         'id_lang'         => 1,
        //         'name'             => 'réglages',
        //     ],
        //     [
        //         'id_lang'         => 2,
        //         'name'             => 'settings',
        //     ],
        // ];


        $tabBlog = $db->table('tabs')->where('class_name', $rowsBlogTabs['class_name'])->get()->getRow();
        //print_r($tab); exit;
        if (empty($tabBlog)) {
            // No setting - add the row
            $db->table('tabs')->insert($rowsBlogTabs);
            $newInsert = $db->insertID();
            $i = 0;
            foreach ($rowsBlogTabsLangs as $rowLang) {
                $rowLang['tab_id']   = $newInsert;
                // No setting - add the row
                $db->table('tabs_langs')->insert($rowLang);
                $i++;
            }

            // on insere les articles
            $tabArticles = $db->table('tabs')->where('class_name', $rowsArticlesTabs['class_name'])->get()->getRow();
            //print_r($tab); exit;
            if (empty($tabArticles)) {
                // No setting - add the row
                $rowsArticlesTabs['id_parent']  = $newInsert;
                $db->table('tabs')->insert($rowsArticlesTabs);
                $newInsertArt = $db->insertID();
                $i = 0;
                foreach ($rowsArticlesTabsLangs as $rowLang) {
                    $rowLang['tab_id']   = $newInsertArt;
                    // No setting - add the row
                    $db->table('tabs_langs')->insert($rowLang);
                    $i++;
                }
            }

            // On Insére les categories
            $tabCategorie = $db->table('tabs')->where('class_name', $rowsCatTabs['class_name'])->get()->getRow();
            //print_r($tab); exit;
            if (empty($tabCategorie)) {
                // No setting - add the row
                $rowsCatTabs['id_parent']  = $newInsert;
                $db->table('tabs')->insert($rowsCatTabs);
                $newInsertCat = $db->insertID();
                $i = 0;
                foreach ($rowsCatTabsLangs as $rowLang) {
                    $rowLang['tab_id']   = $newInsertCat;
                    // No setting - add the row
                    $db->table('tabs_langs')->insert($rowLang);
                    $i++;
                }
            }

            // // On Insére les Tags
            // $tabTag = $db->table('tabs')->where('class_name', $rowsTagsTabs['class_name'])->get()->getRow();
            // //print_r($tab); exit;
            // if (empty($tabTag)) {
            //     // No setting - add the row
            //     $rowsTagsTabs['id_parent']  = $newInsert;
            //     $db->table('tabs')->insert($rowsTagsTabs);
            //     $newInsertTags = $db->insertID();
            //     $i = 0;
            //     foreach ($rowsTagsTabsLangs as $rowLang) {
            //         $rowLang['tab_id']   = $newInsertTags;
            //         // No setting - add the row
            //         $db->table('tabs_langs')->insert($rowLang);
            //         $i++;
            //     }
            // }

            // // On Insére les Settings
            // $tabSettings = $db->table('tabs')->where('class_name', $rowsSettingsTabs['class_name'])->get()->getRow();
            // //print_r($tab); exit;
            // if (empty($tabSettings)) {
            //     // No setting - add the row
            //     $rowsSettingsTabs['id_parent']  = $newInsert;
            //     $db->table('tabs')->insert($rowsSettingsTabs);
            //     $newInsertTags = $db->insertID();
            //     $i = 0;
            //     foreach ($rowsSettingsTabsLangs as $rowLang) {
            //         $rowLang['tab_id']   = $newInsertTags;
            //         // No setting - add the row
            //         $db->table('tabs_langs')->insert($rowLang);
            //         $i++;
            //     }
            // }
        }


        /**
         *
         * Gestion des permissions
         */
        $rowsPermissionsEcommerce = [
            [
                'name'              => 'EC_Product::views',
                'description'       => 'Voir les Produits',
                'is_natif'          => '0',
            ],
            [
                'name'              => 'EC_Product::create',
                'description'       => 'Créer des Produits',
                'is_natif'          => '0',
            ],
            [
                'name'              => 'EC_Product::edit',
                'description'       => 'Modifier les Produits',
                'is_natif'          => '0',
            ],
            [
                'name'              => 'EC_Product::delete',
                'description'       => 'Supprimer des articles',
                'is_natif'          => '0',
            ],
            [
                'name'              => 'EC_category::views',
                'description'       => 'Voir les categories',
                'is_natif'          => '0',
            ],
            [
                'name'              => 'EC_category::create',
                'description'       => 'Créer des categories',
                'is_natif'          => '0',
            ],
            [
                'name'              => 'EC_category::edit',
                'description'       => 'Modifier les categories',
                'is_natif'          => '0',
            ],
            [
                'name'              => 'EC_category::delete',
                'description'       => 'Supprimer des categories',
                'is_natif'          => '0',
            ],
            // [
            //     'name'              => 'Tags::views',
            //     'description'       => 'Voir les tags',
            //     'is_natif'          => '0',
            // ],
            // [
            //     'name'              => 'Tags::create',
            //     'description'       => 'Créer des tags',
            //     'is_natif'          => '0',
            // ],
            // [
            //     'name'              => 'Tags::edit',
            //     'description'       => 'Modifier les tags',
            //     'is_natif'          => '0',
            // ],
            // [
            //     'name'              => 'Tags::delete',
            //     'description'       => 'Supprimer des tags',
            //     'is_natif'          => '0',
            // ],
            // [
            //     'name'              => 'SettingsBlog::views',
            //     'description'       => 'Voir les réglages',
            //     'is_natif'          => '0',
            // ],
            // [
            //     'name'              => 'SettingsBlog::create',
            //     'description'       => 'Créer des réglages',
            //     'is_natif'          => '0',
            // ],
            // [
            //     'name'              => 'SettingsBlog::edit',
            //     'description'       => 'Modifier les réglages',
            //     'is_natif'          => '0',
            // ],
            // [
            //     'name'              => 'SettingsBlog::delete',
            //     'description'       => 'Supprimer des réglages',
            //     'is_natif'          => '0',
            // ]
        ];

        // On insére le role par default au user
        foreach ($rowsPermissionsEcommerce as $row) {
            $tabRow =  $db->table('auth_permissions')->where(['name' => $row['name']])->get()->getRow();
            if (empty($tabRow)) {
                // No langue - add the row
                $db->table('auth_permissions')->insert($row);
            }
        }

        //Gestion des module
        $rowsModulePages = [
            'name'       => 'ecommerce',
            'namespace'  => 'Adnduweb\Ci4_ecommerce',
            'active'     => 1,
            'version'    => '1.0.2',
            'created_at' =>  date('Y-m-d H:i:s')
        ];

        $tabRow =  $db->table('modules')->where(['name' => $rowsModulePages['name']])->get()->getRow();
        if (empty($tabRow)) {
            // No langue - add the row
            $db->table('modules')->insert($rowsModulePages);
        }
    }
}
