<?php

namespace vthang87\authmanager\models;

use Yii;
use vthang87\authmanager\components\Configs;
use yii\db\Query;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id Menu id(autoincrement)
 * @property string $name Menu name
 * @property integer $parent Menu parent
 * @property string $route Route for this menu
 * @property integer $order Menu order
 * @property string $data Extra information for this menu
 *
 * @property Menu $menuParent Menu parent
 * @property Menu[] $menus Menu children
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Menu extends \yii\db\ActiveRecord
{
    public $parent_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Configs::instance()->menuTable;
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        if (Configs::instance()->db !== null) {
            return Configs::instance()->db;
        } else {
            return parent::getDb();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_name'], 'in',
                'range' => static::find()->select(['name'])->column(),
                'message' => 'Menu "{value}" not found.'],
            [['parent', 'route', 'data', 'order'], 'default'],
            [['parent'], 'filterParent', 'when' => function() {
                return !$this->isNewRecord;
            }],
            [['order'], 'integer'],
            [['route'], 'in',
                'range' => static::getSavedRoutes(),
                'message' => 'Route "{value}" not found.']
        ];
    }

    /**
     * Use to loop detected.
     */
    public function filterParent()
    {
        $parent = $this->parent;
        $db = static::getDb();
        $query = (new Query)->select(['parent'])
            ->from(static::tableName())
            ->where('[[id]]=:id');
        while ($parent) {
            if ($this->id == $parent) {
                $this->addError('parent_name', 'Loop detected.');
                return;
            }
            $parent = $query->params([':id' => $parent])->scalar($db);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('authmanager', 'ID'),
            'name' => Yii::t('authmanager', 'Name'),
            'parent' => Yii::t('authmanager', 'Parent'),
            'parent_name' => Yii::t('authmanager', 'Parent Name'),
            'route' => Yii::t('authmanager', 'Route'),
            'order' => Yii::t('authmanager', 'Order'),
            'data' => Yii::t('authmanager', 'Data'),
        ];
    }

    /**
     * Get menu parent
     * @return \yii\db\ActiveQuery
     */
    public function getMenuParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * Get menu children
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }
    private static $_routes;

    /**
     * Get saved routes.
     * @return array
     */
    public static function getSavedRoutes()
    {
        if (self::$_routes === null) {
            self::$_routes = [];
            foreach (Configs::authManager()->getPermissions() as $name => $value) {
                if ($name[0] === '/' && substr($name, -1) != '*') {
                    self::$_routes[] = $name;
                }
            }
        }
        return self::$_routes;
    }

    public static function getMenuSource()
    {
        $tableName = static::tableName();
        return (new \yii\db\Query())
                ->select(['m.id', 'm.name', 'm.route', 'parent_name' => 'p.name'])
                ->from(['m' => $tableName])
                ->leftJoin(['p' => $tableName], '[[m.parent]]=[[p.id]]')
                ->all(static::getDb());
    }
}
