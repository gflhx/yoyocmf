<?php

namespace backend\modules\user\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\user\models\Department;

/**
 * DepartmentSearch represents the model behind the search form of `common\modules\user\models\Department`.
 */
class DepartmentSearch extends Department
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'parent', 'myorder', 'created_at', 'updated_at', 'level'], 'integer'],
            [['department_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Department::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,  //不分页
            'sort' => [
                'defaultOrder' => [
                    'level' => SORT_ASC,
                    'myorder' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'department_id' => $this->department_id,
            'parent' => $this->parent,
            'myorder' => $this->myorder,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'level' => $this->level,
        ]);
        $query->andFilterWhere(['like', 'department_name', $this->department_name]);
        return $dataProvider;
    }
}
