Auth Manager for Yii 2 extend yii2-admin
======================
GUI manager for RBAC (Role Base Access Control) Yii2  based on RBAC Manager for Yii 2.

Documentation
-------------
Please follow the steps below for installation of Auth Manager.

Installation
------------

### Install With Composer

Run

```
php composer.phar require vthang87/yii2-authmanager:dev-master
```

Or, you may add

```
"vthang87/yii2-authmanager": "dev-master"
```

to the require section of your `composer.json` file and execute `php composer.phar update`.

Basic Configuration
-------------------

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    'modules' => [
        'admin' => [
            'class' => 'vthang87\authmanager\AuthManagerModule',
            ...
        ]
        ...
    ],
    ...
    'components' => [
        ...
        'authManager' => [
            'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        ]
    ],
    'as access' => [
        'class' => 'vthang87\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
];
```
See [Yii RBAC](http://www.yiiframework.com/doc-2.0/guide-security-authorization.html#role-based-access-control-rbac) for more detail.
You can then access Auth manager through the following URL:

```
http://localhost/path/to/index.php?r=admin
http://localhost/path/to/index.php?r=admin/route
http://localhost/path/to/index.php?r=admin/permission
http://localhost/path/to/index.php?r=admin/menu
http://localhost/path/to/index.php?r=admin/role
http://localhost/path/to/index.php?r=admin/assignment
http://localhost/path/to/index.php?r=admin/user
```

To use the menu manager , execute the migration here:
```
yii migrate --migrationPath=@vthang87/authmanager/migrations
```

If you use database (class 'yii\rbac\DbManager') to save rbac data, execute the migration here:
```
yii migrate --migrationPath=@yii/rbac/migrations
```

Customizing Assignment Controller
---------------------------------

Assignment controller properties may need to be adjusted to the User model of your app.
To do that, change them via `controllerMap` property. For example:

```php
    'modules' => [
        'admin' => [
            ...
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'vthang87\admin\controllers\AssignmentController',
                    /* 'userClassName' => 'app\models\User', */
                    'idField' => 'user_id',
                    'usernameField' => 'username',
                    'fullnameField' => 'profile.full_name',
                    'extraColumns' => [
                        [
                            'attribute' => 'full_name',
                            'label' => 'Full Name',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->full_name;
                            },
                        ],
                        [
                            'attribute' => 'dept_name',
                            'label' => 'Department',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->dept->name;
                            },
                        ],
                        [
                            'attribute' => 'post_name',
                            'label' => 'Post',
                            'value' => function($model, $key, $index, $column) {
                                return $model->profile->post->name;
                            },
                        ],
                    ],
                    'searchClass' => 'app\models\UserSearch'
                ],
            ],
            ...
        ]
        ...
    ],

```

- Required properties
    - **userClassName** Fully qualified class name of your User model
        Usually you don't need to specify it explicitly, since the module will detect it automatically
    - **idField** ID field of your User model
        The field that corresponds to Yii::$app->user->id.
        The default value is 'id'.
    - **usernameField** User name field of your User model
        The default value is 'username'.
- Optional properties
    - **fullnameField** The field that specifies the full name of the user used in "view" page.
        This can either be a field of the user model or of a related model (e.g. profile model).
        When the field is of a related model, the name should be specified with a dot-separated notation (e.g. 'profile.full_name').
        The default value is null.
    - **extraColumns** The definition of the extra columns used in the "index" page
        This should be an array of the definitions of the grid view columns.
        You may include the attributes of the related models as you see in the example above.
        The default value is an empty array.
    - **searchClass** Fully qualified class name of your model for searching the user model
        You have to supply the proper search model in order to enable the filtering and the sorting by the extra columns.
        The default value is null.


Customizing Layout
------------------

By default, the admin module will use the layout specified in the application level.
In that case you have to write the menu for this module on your own.

By specifying the `layout` property, you can use one of the built-in layouts of the module:
'left-menu', 'right-menu' or 'top-menu', all equipped with the menu for this module.

```php
    'modules' => [
        'admin' => [
            ...
            'layout' => 'left-menu', // defaults to null, using the application's layout without the menu
                                     // other available values are 'right-menu' and 'top-menu'
        ],
        ...
    ],
```

If you use one of them, you can also customize the menu. You can change menu label or disable it.

```php
    'modules' => [
        'admin' => [
            ...
            'layout' => 'left-menu',
            'menus' => [
                'assignment' => [
                    'label' => 'Grant Access' // change label
                ],
                'route' => null, // disable menu
            ],
        ],
        ...
    ],
```

While using a dedicated layout of the module, you may still want to have it wrapped in your application's main layout
that has your application's nav bar and your brand logo on it.
You can do it by specifying the `mainLayout` property with the application's main layout. For example:

```php
    'modules' => [
        'admin' => [
            ...
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            ...
        ],
        ...
    ],
```
Admin Module
------------
- `layout` default to 'left-menu'. Set to null if you want use your current layout.
- `menus` Change listed menu available for module.

Using module in configuration

```php
'modules' => [
    ...
    'admin' => [
        'class' => 'vthang87\admin\Module',
        'layout' => 'left-menu', // it can be '@path/to/your/layout'.
        'controllerMap' => [
            'assignment' => [
                'class' => 'vthang87\admin\controllers\AssignmentController',
                'userClassName' => 'app\models\User',
                'idField' => 'user_id'
            ],
            'other' => [
                'class' => 'path\to\OtherController', // add another controller
            ],
        ],
        'menus' => [
            'assignment' => [
                'label' => 'Grand Access' // change label
            ],
            'route' => null, // disable menu route
        ]
	],
],
```

Access Control Filter
---------------------
Access Control Filter (ACF) is a simple authorization method that is best used by applications that only need some simple access control.
As its name indicates, ACF is an action filter that can be attached to a controller or a module as a behavior.
ACF will check a set of access rules to make sure the current user can access the requested action.

The code below shows how to use ACF which is implemented as `mdm\admin\components\AccessControl`:

```php
'as access' => [
    'class' => 'vthang87\admin\components\AccessControl',
    'allowActions' => [
        'site/login',
        'site/error',
    ]
]
```

Filter ActionColumn Buttons
---------------------------
When you use `GridView`, you can also filtering button visibility.
```php
use vthang87\admin\components\Helper;

'columns' => [
    ...
    [
        'class' => 'yii\grid\ActionColumn',
        'template' => Helper::filterActionColumn('{view}{delete}{posting}'),
    ]
]
```
It will check authorization access of button and show or hide it.

To check access for route, you can use
```php
use vthang87\admin\components\Helper;

if(Helper::checkRoute('delete')){
    echo Html::a(Yii::t('authmanager', 'Delete'), ['delete', 'id' => $model->name], [
        'class' => 'btn btn-danger',
        'data-confirm' => Yii::t('authmanager', 'Are you sure to delete this item?'),
        'data-method' => 'post',
    ]);
}

```
Using Menu
==========

Menu manager used for build hierarchical menu. This is automatically look of user 
role and permision then return menus that he has access.

```php
use vthang87\admin\components\MenuHelper;
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
]);
```

Return of `mdm\admin\components\MenuHelper::getAssignedMenu()` has default format like:

```php
[
    [
        'label' => $menu['name'], 
        'url' => [$menu['route']],
        'items' => [
			[
				'label' => $menu['name'], 
				'url' => [$menu['route']]
            ],
            ....
        ]
    ],
    [
        'label' => $menu['name'], 
        'url' => [$menu['route']],
        'items' => [
			[
				'label' => $menu['name'], 
				'url' => [$menu['route']]
            ]
        ]
    ],
    ....
]
```

where `$menu` variable correspond with a record of table `menu`. You can customize 
return format of `mdm\admin\components\MenuHelper::getAssignedMenu()` by provide a callback to this method.
The callback must have format `function($menu){}`. E.g:

You can add html options attribute to Your menu, for example "title". When You create a menu, in field data (textarea) fill this :
```
return ['title'=>'Title of Your Link Here'];
```

and then in Your view:

```php
$callback = function($menu){
    $data = eval($menu['data']);
    return [
        'label' => $menu['name'], 
        'url' => [$menu['route']],
        'options' => $data,
        'items' => $menu['children']
    ];
}

$items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback);
```

Default result is get from `cache`. If you want to force regenerate, provide boolean `true` as forth parameter.

You can modify callback function for advanced usage.


Using Sparated Menu
-------------------
Second parameter of `mdm\admin\components\MenuHelper::getAssignedMenu()` used to get menu on it's own hierarchy.
E.g. Your menu structure:

* Side Menu
  * Menu 1
    * Menu 1.1
    * Menu 1.2
    * Menu 1.3
  * Menu 2
    * Menu 2.1
    * Menu 2.2
    * Menu 2.3
* Top Menu
  * Top Menu 1
    * Top Menu 1.1
    * Top Menu 1.2
    * Top Menu 1.3
  * Top Menu 2
  * Top Menu 3
  * Top Menu 4

You can get 'Side Menu' chldren by calling

```php
$items = MenuHelper::getAssignedMenu(Yii::$app->user->id, $sideMenuId);
```

It will result in
* Menu 1
  * Menu 1.1
  * Menu 1.2
  * Menu 1.3
* Menu 2
  * Menu 2.1
  * Menu 2.2
  * Menu 2.3

Filtering Menu
--------------
If you have `NavBar` menu items and want to filtering according user login. You can use Helper class
```php

user vthang87\admin\components\Helper;

$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
    ['label' => 'Login', 'url' => ['/user/login']],
    [
        'label' => 'Logout (' . \Yii::$app->user->identity->username . ')',
        'url' => ['/user/logout'],
        'linkOptions' => ['data-method' => 'post']
    ],
    ['label' => 'App', 'items' => [
        ['label' => 'New Sales', 'url' => ['/sales/pos']],
        ['label' => 'New Purchase', 'url' => ['/purchase/create']],
        ['label' => 'GR', 'url' => ['/movement/create', 'type' => 'receive']],
        ['label' => 'GI', 'url' => ['/movement/create', 'type' => 'issue']],
    ]]
];

$menuItems = Helper::filter($menuItems);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
```

You can also check for individual route.
```php
use vthang87\admin\components\Helper;

if(Helper::checkRoute('delete')){
    echo Html::a(Yii::t('authmanager', 'Delete'), ['delete', 'id' => $model->name], [
        'class' => 'btn btn-danger',
        'data-confirm' => Yii::t('authmanager', 'Are you sure to delete this item?'),
        'data-method' => 'post',
    ]);
}
```

Filter ActionColumn Buttons
---------------------------
When you use `GridView`, you can also filtering button visibility.
```php
use mdm\admin\components\Helper;

'columns' => [
    ...
    [
        'class' => 'yii\grid\ActionColumn',
        'template' => Helper::filterActionColumn('{view}{delete}{posting}'),
    ]
]
```

It will check authorization access of button and show or hide it.
