<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class   MyForm extends CFormModel
{
    public $firstname;
    public $secondname;
    public $date;
    public $isNewRecord = 'Create';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, secondname', 'required'),
			array('firstname, secondname, date', 'boolean'),
                        array('firstname', 'htmlValidator'),
		);
	}
        public function htmlValidator($attribute,$params){
            echo 'IN';
        $p = new CHtmlPurifier;
        $p->options = array(
            'AutoFormat.AutoParagraph' => true,
            'HTML.Allowed' => 'p,ul,li,b,i,a[href],pre',
            'AutoFormat.Linkify' => true,
            'HTML.Nofollow' => true,
            'Core.EscapeInvalidTags' => true,
        );
            return $p->htmlValidator($text);
    }
}