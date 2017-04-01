<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Letra;

/**
 * LetraSearch represents the model behind the search form about `app\models\Letra`.
 */
class LetraSearch extends Letra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_cancion'], 'integer'],
            [['letra', 'created_at'], 'safe'],
            [['bloqueada'], 'boolean'],
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
        $query = Letra::find();

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
            'id_cancion' => $this->id_cancion,
            'bloqueada' => $this->bloqueada,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'letra', $this->letra]);

        return $dataProvider;
    }
}
