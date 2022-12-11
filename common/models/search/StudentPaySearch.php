<?php

namespace common\models\search;

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentPay;
use yii\db\QueryInterface;
use Yii;
use yii\helpers\FileHelper;

/**
 * StudentPaySearch represents the model behind the search form of `common\models\StudentPay`.
 */
class StudentPaySearch extends StudentPay
{
    public $course,$group;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'id', 'price', 'payment_id', 'branch_id', 'user_id','group', 'consept_id','course', 'status_id'], 'integer'],
            [['code', 'pay_date', 'paid_date', 'check_file', 'ads', 'created', 'updated'], 'safe'],
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
        $query = StudentPay::find();

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
            'student_id' => $this->student_id,
            'id' => $this->id,
            'pay_date' => $this->pay_date,
            'price' => $this->price,
            'paid_date' => $this->paid_date,
            'payment_id' => $this->payment_id,
            'branch_id' => $this->branch_id,
            'user_id' => $this->user_id,
            'consept_id' => $this->consept_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'check_file', $this->check_file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }

    public function searchBux($params)
    {
        $query = StudentPay::find()->where('status_id in (2,3,5)')->orderBy(['status_id'=>SORT_ASC]);

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
            'student_id' => $this->student_id,
            'id' => $this->id,
            'pay_date' => $this->pay_date,
            'price' => $this->price,
            'paid_date' => $this->paid_date,
            'payment_id' => $this->payment_id,
            'branch_id' => $this->branch_id,
            'user_id' => $this->user_id,
            'consept_id' => $this->consept_id,
            'status_id' => $this->status_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'check_file', $this->check_file])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }

    public function searchManager($params)
    {
        $query = StudentPay::find()->andWhere(['student_pay.branch_id'=>\Yii::$app->user->identity->branch_id])
            ->innerJoin('student','student_pay.student_id = student.id')
            ->innerJoin('groups','student.group_id = groups.id')

        ->orderBy(['student_pay.pay_date'=>SORT_ASC]);

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

        if(!$this->status_id){
            $query->andWhere('student_pay.status_id not in (2,3,4)');
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'student_pay.student_id' => $this->student_id,
            'student_pay.id' => $this->id,
            'student_pay.pay_date' => $this->pay_date,
            'student_pay.price' => $this->price,
            'student_pay.paid_date' => $this->paid_date,
            'student_pay.payment_id' => $this->payment_id,
            'student_pay.branch_id' => $this->branch_id,
            'student_pay.user_id' => $this->user_id,
            'student_pay.consept_id' => $this->consept_id,
            'student_pay.status_id' => $this->status_id,
            'student_pay.created' => $this->created,
            'student_pay.updated' => $this->updated,
            'groups.course_id' => $this->course,
            'groups.id' => $this->group,
        ]);

        $query->andFilterWhere(['like', 'student_pay.code', $this->code])
            ->andFilterWhere(['like', 'student_pay.check_file', $this->check_file])
            ->andFilterWhere(['like', 'student_pay.ads', $this->ads]);

        return $dataProvider;
    }

// data to excel converter
    public function exportToExcel(?QueryInterface $query)
    {
        $speadsheet = new Spreadsheet();
        $sheet = $speadsheet->getActiveSheet();
        $title = "To`lovlar ro`yhati";
        $sheet->setTitle(substr($title, 0, 31));
        $row = 1;
        $col = 1;
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "#", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Kod", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "FIO", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "To`lov holati", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "To`lov summasi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Kurs", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            $st = $item->student;
            $row++;
            $col = 1;
            $key++;
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->code, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $st->person->name, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->status->name, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->price, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $st->group->course->name, DataType::TYPE_STRING);
        }
        $name = 'ExcelReport.xlsx';
        $writer = new Xlsx($speadsheet);
        $dir = Yii::$app->basePath.'/web/tmp/excel';
        if (!is_dir($dir)) {
            FileHelper::createDirectory($dir, 0777);
        }
        $fileName = $dir . DIRECTORY_SEPARATOR . $name;
        $writer->save($fileName);
        return Yii::$app->response->sendFile($fileName);
    }


}
