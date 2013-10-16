<?php

/**
 * This is the model class for table "{{header_menu_categories}}".
 *
 * The followings are the available columns in table '{{header_menu_categories}}':
 * @property integer $id
 * @property string $category
 * @property string $alias
 * @property integer $id_view
 */
class HeaderMenuCategories extends CActiveRecord
{
	public $active;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{header_menu_categories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, category, alias', 'required'),
			array('id, id_view', 'numerical', 'integerOnly'=>true),
			array('category, alias', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category, alias, id_view', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		    'Subcategories' => array(self::HAS_MANY, 
					'HeaderMenuSubcategories',
					'id_category',
					'joinType'=>'LEFT JOIN',),
		    'Views' => array(self::BELONGS_TO, 
					'HeaderMenuViewsForSubcategories',
					'id_view',
					'joinType'=>'LEFT JOIN',),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'alias' => 'Alias',
			'id_view' => 'Id View',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('id_view',$this->id_view);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HeaderMenuCategories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
