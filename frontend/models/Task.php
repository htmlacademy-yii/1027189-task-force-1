<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $category_id
 * @property string $status
 * @property string $description
 * @property string $expire
 * @property string $name
 * @property string|null $address
 * @property int|null $budget
 * @property string $latitude
 * @property string $longitude
 * @property int $author_id
 * @property int|null $executor_id
 *
 * @property File[] $files
 * @property Opinion[] $opinions
 * @property Reply[] $replies
 * @property User $author
 * @property User $executor
 * @property Category $category
 */
class Task extends \yii\db\ActiveRecord
{
    const SHORT_DESCRIPTION_LENGTH = 70;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'expire'], 'safe'],
            [['category_id', 'status', 'description', 'expire', 'name', 'latitude', 'longitude', 'author_id'], 'required'],
            [['category_id', 'budget', 'author_id', 'executor_id'], 'integer'],
            [['description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['status'], 'string', 'max' => 10],
            [['name', 'address'], 'string', 'max' => 100],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'description' => 'Description',
            'expire' => 'Expire',
            'name' => 'Name',
            'address' => 'Address',
            'budget' => 'Budget',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'author_id' => 'Author ID',
            'executor_id' => 'Executor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinion::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function find()
    {
        return new TasksFilters(get_called_class());
    }
}
