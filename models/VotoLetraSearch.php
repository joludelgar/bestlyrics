<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VotoLetra;

/**
 * VotoLetraSearch represents the model behind the search form about `app\models\VotoLetra`.
 */
class VotoLetraSearch extends VotoLetra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'id_letra', 'voto'], 'integer'],
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
        $query = VotoLetra::find();

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
            'id_usuario' => $this->id_usuario,
            'id_letra' => $this->id_letra,
            'voto' => $this->voto,
        ]);

        return $dataProvider;
    }
}
