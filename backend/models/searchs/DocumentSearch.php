<?php

namespace backend\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Document;

/**
 * DocumentSearch represents the model behind the search form of `common\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'classid', 'ttid', 'onclick', 'plnum', 'totaldown', 'user_id', 'firsttitle', 'isgood', 'ispic', 'istop', 'ismember', 'isurl', 'havehtml', 'groupid', 'userfen', 'created_at', 'updated_at', 'diggtop', 'stb'], 'integer'],
            [['smalltext', 'newspath', 'filename', 'username', 'titlefont', 'titleurl', 'ftitle', 'title', 'titlepic'], 'safe'],
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
        $query = Document::find();

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
            'id' => $this->id,
            'classid' => $this->classid,
            'ttid' => $this->ttid,
            'onclick' => $this->onclick,
            'plnum' => $this->plnum,
            'totaldown' => $this->totaldown,
            'user_id' => $this->user_id,
            'firsttitle' => $this->firsttitle,
            'isgood' => $this->isgood,
            'ispic' => $this->ispic,
            'istop' => $this->istop,
            'ismember' => $this->ismember,
            'isurl' => $this->isurl,
            'havehtml' => $this->havehtml,
            'groupid' => $this->groupid,
            'userfen' => $this->userfen,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'diggtop' => $this->diggtop,
            'stb' => $this->stb,
        ]);

        $query->andFilterWhere(['like', 'smalltext', $this->smalltext])
            ->andFilterWhere(['like', 'newspath', $this->newspath])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'titlefont', $this->titlefont])
            ->andFilterWhere(['like', 'titleurl', $this->titleurl])
            ->andFilterWhere(['like', 'ftitle', $this->ftitle])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'titlepic', $this->titlepic]);

        return $dataProvider;
    }
}
