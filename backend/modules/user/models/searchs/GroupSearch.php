<?php

namespace backend\modules\user\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\user\models\Group;

/**
 * GroupSearch represents the model behind the search form of `common\modules\user\models\Group`.
 */
class GroupSearch extends Group
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'level', 'checked', 'fava_num', 'day_down', 'msg_len', 'msg_num', 'can_reg', 'reg_checked', 'space_style_id', 'day_add_info', 'info_checked', 'pl_checked'], 'integer'],
            [['group_name'], 'safe'],
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
        $query = Group::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'level' => SORT_ASC,
                    'group_id' => SORT_ASC,
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
            'group_id' => $this->group_id,
            'level' => $this->level,
            'checked' => $this->checked,
            'fava_num' => $this->fava_num,
            'day_down' => $this->day_down,
            'msg_len' => $this->msg_len,
            'msg_num' => $this->msg_num,
            'can_reg' => $this->can_reg,
            'reg_checked' => $this->reg_checked,
            'space_style_id' => $this->space_style_id,
            'day_add_info' => $this->day_add_info,
            'info_checked' => $this->info_checked,
            'pl_checked' => $this->pl_checked,
        ]);

        $query->andFilterWhere(['like', 'group_name', $this->group_name]);

        return $dataProvider;
    }
}
