<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace app\models;
use dektrium\user\models\Profile as BaseProfile;
use dektrium\user\traits\ModuleTrait;
use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string  $name
 * @property string  $public_email
 * @property string  $gravatar_email
 * @property string  $gravatar_id
 * @property string  $location
 * @property string  $website
 * @property string  $bio
 * @property string  $timezone
 * @property User    $user
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends BaseProfile
{
    use ModuleTrait;
    /** @var \dektrium\user\Module */
    protected $module;
    public $imageFile;
    /** @inheritdoc */
    public function init()
    {
        $this->module = \Yii::$app->getModule('user');
    }
    /**
     * Returns avatar url or null if avatar is not set.
     * @param  int $size
     * @return string|null
     */
    public function getImageUrl()
    {
        $uploads = Yii::getAlias('@uploads');
        $avatar = glob($uploads . "/$this->user_id.*");
        $s3 = Yii::$app->get('s3');

        if (count($avatar) != 0) {
            $ruta = $avatar[0];
        } else {
            $ruta = $uploads . "/$this->user_id.jpg";
            if (!$s3->exist($ruta)) {
                $ruta = $uploads . "/$this->user_id.png";
            }
        }

        if (file_exists($ruta)) {
            return "/$ruta";
        } elseif ($s3->exist($ruta)) {
            $s3->commands()->get($ruta)->saveAs($ruta)->execute();
            return "/$ruta";
        } else {
            return "/$uploads/example.jpg";
        }
    }
    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne($this->module->modelMap['User'], ['id' => 'user_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'bioString'            => ['bio', 'string'],
            'timeZoneValidation'   => ['timezone', 'validateTimeZone'],
            'publicEmailPattern'   => ['public_email', 'email'],
            'gravatarEmailPattern' => ['gravatar_email', 'email'],
            'websiteUrl'           => ['website', 'url'],
            'nameLength'           => ['name', 'string', 'max' => 255],
            'publicEmailLength'    => ['public_email', 'string', 'max' => 255],
            'gravatarEmailLength'  => ['gravatar_email', 'string', 'max' => 255],
            'locationLength'       => ['location', 'string', 'max' => 255],
            'websiteLength'        => ['website', 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'           => \Yii::t('user', 'Name'),
            'public_email'   => \Yii::t('user', 'Email (public)'),
            'gravatar_email' => \Yii::t('user', 'Gravatar email'),
            'location'       => \Yii::t('user', 'Location'),
            'website'        => \Yii::t('user', 'Website'),
            'bio'            => \Yii::t('user', 'Bio'),
            'timezone'       => \Yii::t('user', 'Time zone'),
        ];
    }
    /**
     * Validates the timezone attribute.
     * Adds an error when the specified time zone doesn't exist.
     * @param string $attribute the attribute being validated
     * @param array $params values for the placeholders in the error message
     */
    public function validateTimeZone($attribute, $params)
    {
        if (!in_array($this->$attribute, timezone_identifiers_list())) {
            $this->addError($attribute, \Yii::t('user', 'Time zone is not valid'));
        }
    }
    /**
     * Get the user's time zone.
     * Defaults to the application timezone if not specified by the user.
     * @return \DateTimeZone
     */
    public function getTimeZone()
    {
        try {
            return new \DateTimeZone($this->timezone);
        } catch (\Exception $e) {
            // Default to application time zone if the user hasn't set their time zone
            return new \DateTimeZone(\Yii::$app->timeZone);
        }
    }
    /**
     * Set the user's time zone.
     * @param \DateTimeZone $timezone the timezone to save to the user's profile
     */
    public function setTimeZone(\DateTimeZone $timeZone)
    {
        $this->setAttribute('timezone', $timeZone->getName());
    }
    /**
     * Converts DateTime to user's local time
     * @param \DateTime the datetime to convert
     * @return \DateTime
     */
    public function toLocalTime(\DateTime $dateTime = null)
    {
        if ($dateTime === null) {
            $dateTime = new \DateTime();
        }
        return $dateTime->setTimezone($this->getTimeZone());
    }
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if ($this->imageFile !== null && $this->validate()) {
            $nombre = Yii::getAlias('@uploads/') . $this->user_id . '.' . $this->imageFile->extension;
            $avatares = glob(Yii::getAlias('@avatar/') . "$this->user_id.*");

            $s3 = Yii::$app->get('s3');
            foreach ($avatares as $avatar) {
                unlink($avatar);
                if ($s3->exist($avatar)) {
                    $s3->delete($avatar);
                }
            }

            $this->imageFile->saveAs($nombre);
            Image::thumbnail($nombre, 500, null)
                    ->save($nombre, ['quality' => 50]);
            $s3->upload($nombre, $nombre);
        }
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }
}
