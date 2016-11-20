<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CateComp;

/**
 * CateCompSearch represents the model behind the search form about `common\models\CateComp`.
 */
class CateCompSearch extends CateComp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'company_id'], 'integer']
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
        $query = CateComp::find();

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
        // 
        $where = [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'category_id' => $this->category_id,
        ];

        $query->andFilterWhere($where)
            ->orderBy(['rank' => SORT_ASC]);

        return $dataProvider;
    }
}
