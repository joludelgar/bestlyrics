<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Traduccion;

/**
 * TraduccionSearch represents the model behind the search form about `app\models\Traduccion`.
 */
class TraduccionSearch extends Traduccion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_cancion', 'id_idioma'], 'integer'],
            [['bloqueada'], 'boolean'],
            [['letra', 'created_at'], 'safe'],
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
        $query = Traduccion::find();

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
            'id_idioma' => $this->id_idioma,
            'bloqueada' => $this->bloqueada,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'letra', $this->letra]);

        return $dataProvider;
    }
}
