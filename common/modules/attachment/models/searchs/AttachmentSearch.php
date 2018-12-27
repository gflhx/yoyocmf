<?php

namespace common\modules\attachment\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\attachment\models\Attachment;

/**
 * AttachmentSearch represents the model behind the search form of `common\modules\attachment\models\Attachment`.
 */
class AttachmentSearch extends Attachment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'size', 'created_at', 'updated_at'], 'integer'],
            [['name', 'oname', 'title', 'description', 'path', 'hash', 'type', 'extension'], 'safe'],
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
        $query = Attachment::find();

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
            'user_id' => $this->user_id,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'oname', $this->oname])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'hash', $this->hash])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'extension', $this->extension]);

        return $dataProvider;
    }
}
