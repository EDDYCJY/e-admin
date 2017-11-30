<?php
/**
 * This is the template for generating CRUD search class of the specified model.
 */

use yii\helpers\StringHelper;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Expand\Start;
use Eadmin\Constants;
use Eadmin\Config;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
$fullName = Config::get('Database', 'table_prefix') . Helpers::getUnderscore(Helpers::getLastIndex($modelClass));
if ($modelClass === $searchModelClass) {
    $modelAlias = $modelClass . 'Model';
}
$rules = $generator->generateSearchRules();
$labels = $generator->generateSearchLabels();
$relationColumns = $generator->getRelationColumns($fullName, 'attribute');
$relationClass = $generator->getRelationColumns($fullName, 'class');

$searchAttributes = $generator->getSearchAttributes();
$searchConditions = $generator->generateSearchConditions();

$pageSize = Config::get('Setting', 'page_size');
$pageSize = ! empty($pageSize) ? $pageSize : 10;

$timeConditions = $generator->generateTimeConditions(Start::field($fullName, Constants::TIME_FIELD));

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->searchModelClass, '\\')) ?>;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use <?= ltrim($generator->modelClass, '\\') . (isset($modelAlias) ? " as $modelAlias" : "") ?>;
use Eadmin\Config;

/**
 * <?= $searchModelClass ?> represents the model behind the search form of `<?= $generator->modelClass ?>`.
 */
class <?= $searchModelClass ?> extends <?= isset($modelAlias) ? $modelAlias : $modelClass ?>

{
<? if(! empty($relationColumns)): ?>
<?php foreach($relationColumns as $key => $value): ?>
    public $<?= $value ?>;
<?php endforeach; ?>
<?php endif; ?>

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            <?= implode(",\n            ", $rules) ?>,
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
        $query = <?= isset($modelAlias) ? $modelAlias : $modelClass ?>::find();
<?php if(! empty($relationClass)): ?>
<?php foreach($relationClass as $key => $value): ?>
        $query->joinWith(['<?= lcfirst($value); ?>']);
<?php endforeach; ?>
<?php endif; ?>

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => <?= 'Config::get("Setting", "page_size")' ?>,
            ], 
        ]);

        $this->load($params);

<?php if(! empty($timeConditions)): ?>
<?php foreach($timeConditions as $key => $value):?>  
        if(! empty($params['<?= $key . '_start' ?>']) && ! empty($params['<?= $key . '_end'?>'])) {
            $query<?= $value ?>;
        }
<?php endforeach; ?>
<?php endif; ?>

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        <?= implode("\n        ", $searchConditions) ?>

        return $dataProvider;
    }

    /**
     * Creates data provider instance with export query applied
     * Independent of the search
     * 
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function export($params)
    {
        $query = <?= isset($modelAlias) ? $modelAlias : $modelClass ?>::find();
<?php if(! empty($relationClass)): ?>
<?php foreach($relationClass as $key => $value): ?>
        $query->joinWith(['<?= lcfirst($value); ?>']);
<?php endforeach; ?>
<?php endif; ?>

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

<?php if(! empty($timeConditions)): ?>
<?php foreach($timeConditions as $key => $value):?>  
        if(! empty($params['<?= $key . '_start' ?>']) && ! empty($params['<?= $key . '_end'?>'])) {
            $query<?= $value ?>;
        }
<?php endforeach; ?>
<?php endif; ?>

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        <?= implode("\n        ", $searchConditions) ?>

        return $dataProvider;
    }
}
