<?php
namespace mdm\admin\models\form;

use Yii;
use mdm\admin\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $ismanagement;
    public $mngttype;
    public $type;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['ismanagement', 'boolean'],
            ['mngttype', 'string'],
            ['type', 'string'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->ismanagement=$this->ismanagement;
            $user->mngttype = $this->mngttype;
            $user->type = $this->type;
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
