<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AlbumGenero;

/**
 * AlbumGeneroSearch represents the model behind the search form about `app\models\AlbumGenero`.
 */
class AlbumGeneroSearch extends AlbumGenero
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_album', 'id_genero'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AlbumGenero::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_album' => $this->id_album,
            'id_genero' => $this->id_genero,
        ]);

        return $dataProvider;
    }
}
