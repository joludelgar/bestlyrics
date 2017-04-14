<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LetraUsuario;

/**
 * LetraUsuarioSearch represents the model behind the search form about `app\models\LetraUsuario`.
 */
class LetraUsuarioSearch extends LetraUsuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_letra', 'id_usuario'], 'integer'],
            [['created_at'], 'safe'],
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
        $query = LetraUsuario::find();

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
            'id_letra' => $this->id_letra,
            'id_usuario' => $this->id_usuario,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
