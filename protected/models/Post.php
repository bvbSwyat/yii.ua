<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $tittle
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Post extends CActiveRecord
{
	const STATUS_DRAFT = 1;
	const STATUS_PUBLICHED = 2;
	CONST STATUS_ARCHIVED = 3;
	
	private $_oldTags;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return '{{post}}';
	}
	public function createUrl(){
	    return array('post/view', array('id' => $this->id,
					    'title' => $this->title));
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, tittle, content', 'required'),
			array('id, status', 'numerical', 'integerOnly'=>true),
			array('status', 'in', 'range'=>array(1,2,3)),
			array('tags', 'match', 'pattern'=>'/^[/w/s,]+$/',
			    'message' => 'В тегах можна використовувати тільки букви'),
			array('tittle, tags', 'length', 'max'=>500),
			array('content', 'length', 'max'=>5000),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tittle, status', 'safe', 'on'=>'search'),
			array('tags', 'normalizeTags'),
		);
	}
	public function normalizeTags(){
		$this->tags = Tag::arrayToString(array_unique(Tag::stringToArray($this->tags)));
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		    'author'	    =>array(self::BELONGS_TO, 'User', 'autor_id'),
		    'comment'	    =>array(self::HAS_MANY, 'Comment', 'post_id',
					'condition'=>'comment.status='.Comment::STATUS_APPROVED,
					'order'=>'comment.create_time DESC'),
		    'commentCount'  =>array(self::STAT, 'Comment', 'post_id',
					'condition'=>'status='.Comment::STATUS_APPROVED),	
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tittle' => 'Tittle',
			'content' => 'Content',
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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
		$criteria->compare('tittle',$this->tittle,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	protected function beforeSave() {
		if(parent::beforeSave()){
			if($this->isNewRecord){
				$this->create_time = $this->update_time = time();
				$this->autor_id = Yii::app()->user->id;
			}
			else{
				$this->update_time = time();
				return true;
			}
		}
		else{
			return false;
		}
	}
	
	protected  function afterSave() {
		parent::afterSave();
		Tag::model()->updateFreguency($this->_oldTags, $this->tags);
	}
	
	protected function afterFind() {
		parent::afterFind();
		$this->_oldTags = $this->tags;
	}
}