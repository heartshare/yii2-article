<?php

namespace yuncms\article\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ManageSearch represents the model behind the search form about `yuncms\article\models\Article`.
 */
class ManageSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'comments', 'supports', 'collections', 'views', 'is_top', 'is_hot', 'is_best', 'created_at', 'updated_at', 'published_at'], 'integer'],
            [['key', 'category_id', 'title', 'sub_title', 'description', 'cover', 'content'], 'safe'],
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
        $query = Article::find()->where(['user_id' => Yii::$app->user->id]);

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
            'status' => $this->status,
            'comments' => $this->comments,
            'supports' => $this->supports,
            'collections' => $this->collections,
            'views' => $this->views,
            'is_top' => $this->is_top,
            'is_hot' => $this->is_hot,
            'is_best' => $this->is_best,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'published_at' => $this->published_at,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
