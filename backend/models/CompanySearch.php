<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Company;

/**
 * CompanySearch represents the model behind the search form about `common\models\Company`.
 */
class CompanySearch extends Company
{

    public $excludeCompanies = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'feature_mobile', 'feature_instant_play', 'feature_download', 'feature_live_casino', 'feature_vip_program', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'description'], 'safe'],
            [['rating'], 'number'],
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
        $query = Company::find();

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
            'feature_mobile' => $this->feature_mobile,
            'feature_instant_play' => $this->feature_instant_play,
            'feature_download' => $this->feature_download,
            'feature_live_casino' => $this->feature_live_casino,
            'feature_vip_program' => $this->feature_vip_program,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        $query->andFilterWhere($where);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description]);

        if (count($this->excludeCompanies) > 0) {
            $query->andFilterWhere(['not in', 'id', $this->excludeCompanies]);
        }

        return $dataProvider;
    }
}
