<?php

namespace backend\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Enewsclass;

/**
 * EnewsclassSearch represents the model behind the search form of `common\models\Enewsclass`.
 */
class EnewsclassSearch extends Enewsclass
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classid', 'bclassid', 'is_zt', 'lencord', 'link_num', 'onclick', 'islast', 'openpl', 'openadd', 'newline', 'hotline', 'goodline', 'hotplline', 'firstline', 'groupid', 'myorder', 'checkpl', 'checked', 'checkqadd', 'addinfofen', 'showclass', 'qaddshowkey', 'adminqinfo', 'nrejs', 'sametitle', 'qeditchecked', 'cgtoinfo', 'allinfos', 'infos', 'created_at', 'updated_at'], 'integer'],
            [['classname', 'sonclass', 'featherclass', 'classurl', 'tbname', 'listorder', 'reorder', 'bname', 'intro', 'classpagekey', 'classimg', 'qaddgroupid', 'wburl', 'cgroupid', 'bdinfoid'], 'safe'],
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
        $query = Enewsclass::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
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
            'classid' => $this->classid,
            'bclassid' => $this->bclassid,
            'is_zt' => $this->is_zt,
            'lencord' => $this->lencord,
            'link_num' => $this->link_num,
            'onclick' => $this->onclick,
            'islast' => $this->islast,
            'openpl' => $this->openpl,
            'openadd' => $this->openadd,
            'newline' => $this->newline,
            'hotline' => $this->hotline,
            'goodline' => $this->goodline,
            'hotplline' => $this->hotplline,
            'firstline' => $this->firstline,
            'groupid' => $this->groupid,
            'myorder' => $this->myorder,
            'checkpl' => $this->checkpl,
            'checked' => $this->checked,
            'checkqadd' => $this->checkqadd,
            'addinfofen' => $this->addinfofen,
            'showclass' => $this->showclass,
            'qaddshowkey' => $this->qaddshowkey,
            'adminqinfo' => $this->adminqinfo,
            'nrejs' => $this->nrejs,
            'sametitle' => $this->sametitle,
            'qeditchecked' => $this->qeditchecked,
            'cgtoinfo' => $this->cgtoinfo,
            'allinfos' => $this->allinfos,
            'infos' => $this->infos,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'classname', $this->classname])
            ->andFilterWhere(['like', 'sonclass', $this->sonclass])
            ->andFilterWhere(['like', 'featherclass', $this->featherclass])
            ->andFilterWhere(['like', 'classurl', $this->classurl])
            ->andFilterWhere(['like', 'tbname', $this->tbname])
            ->andFilterWhere(['like', 'listorder', $this->listorder])
            ->andFilterWhere(['like', 'reorder', $this->reorder])
            ->andFilterWhere(['like', 'bname', $this->bname])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'classpagekey', $this->classpagekey])
            ->andFilterWhere(['like', 'classimg', $this->classimg])
            ->andFilterWhere(['like', 'qaddgroupid', $this->qaddgroupid])
            ->andFilterWhere(['like', 'wburl', $this->wburl])
            ->andFilterWhere(['like', 'cgroupid', $this->cgroupid])
            ->andFilterWhere(['like', 'bdinfoid', $this->bdinfoid]);

        return $dataProvider;
    }
}
