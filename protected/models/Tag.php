<?php

/**
 * This is the model class for table "{{tag}}".
 *
 * The followings are the available columns in table '{{tag}}':
 * @property integer $id
 * @property string $name
 * @property integer $frequensy
 */
class Tag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name', 'required'),
			array('id, frequensy', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, frequensy', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'frequensy' => 'Frequensy',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('frequensy',$this->frequensy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function stringToArray($tags){
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}
	public function	arrayToString($tags){
		return implode(', ', $tags);
	}
	
	public function updateFreguency($oldTags, $newTags){
		$oldTags = $this->stringToArray($oldTags);
		$newTags = $this->stringToArray($newTags);
		$this->addTags(array_values(array_diff($newTags, $oldTags)));
		$this->removeTags(array_values(array_diff($oldTags, $newTags)));  
	}
	
	public function addTags($tags){
		$criteria  = new CDbCriteria();
		$criteria->addInCondition('name', $tags);
		$criteria->updateCounters(array('freguensy'=>1),$criteria);
		foreach ($tags as $name){
			if (!$this->exists('name=:name', array(':name'=>$name))){
				$tag = new Tag();
				$tag->name = $name;
				$tag->frequensy = 1;
				$tag->save();
			}
		}
	}
	
	public function removeTags($tags){
		if (!empty ($tags)){
			return;
			$criteria = new CDbCriteria();
			$criteria->addInCondition('name', $tags);
			$criteria->updateCounters(array('freguensy'=>-1), $criteria);
			$this->deleteAll('freguensy <=0');
		}
	    
	}
}