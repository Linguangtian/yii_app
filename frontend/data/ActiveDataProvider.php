<?php
namespace frontend\data;
use  yii\data\Pagination;

/*
 *
 * 从写数据提供类 返回数组
 * 加上页数信息, 主要重写了toArray方法
 *
 * */

class ActiveDataProvider extends \yii\data\ActiveDataProvider{

    /**
     * 设置偏移量
     * @param $offset
     * @return \api\data\ActiveDataProvider
     */
    public function offset($offset)
    {
        $this->query->offset($offset);

        return $this;
    }

    /**
     * 设置limit
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->query->limit($limit);

        return $this;
    }

    /**
     * 取前几条
     * @param int $num
     * @return \yii\db\QueryInterface
     */
    public function top($num)
    {
        $this->query->offset(0)->limit($num);

        return $this;
    }

    /**
     * 转成数组
     * @param array $fields 字段列表
     * @param array $expand
     * @return array
     */
    public function toArray(array $fields = [], array $expand = [])
    {
        if (empty($fields)) {
            $fields = $this->_fields;
        }

        $data = [];
        /**
         * @var \xiang\db\ActiveRecord $model
         */
        foreach ($this->getModels() as $model) {
            $data[] = $model->toArray($fields, $expand);
        }
        // 无分页
        if (!$this->_pagination) {
            return $data;
        }

        // 有分页
        return [
            'total_page'   => $this->_pagination->pageCount,
            'current_page' => $this->_pagination->page + 1,
            'page_size'    => $this->_pagination->pageSize,
            'total_count'  => $this->_pagination->totalCount,
            'list'         => $data,
        ];
    }

    private $_pagination;

    /**
     * @inheritdoc
     */
    public function getPagination()
    {
        if ($this->_pagination === null) {
            return false;
        }

        return $this->_pagination;
    }

    /**
     * @inheritdoc
     */
    public function setPagination($value = null)
    {
        if ($value === null) {
            $value = Yii::$app->request->post();
        }

        $pagination = new Pagination([
            'params' => [
                'page'     => $value['page_num']  ?? 1,
                'per-page' => $value['page_size'] ?? DEFAULT_PAGE_SIZE,
            ],
        ]);
        $pagination->validatePage = false; //不验证最大页码数
        $this->_pagination = $pagination;

        return $this;
    }

    private $_fields = [];

    /**
     * 返回要获取的字段列表
     * @return array
     */
    public function getFields()
    {
        return $this->_fields;
    }

    /**
     * 设置要获取的字段列表
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->_fields = $fields;

        return $this;
    }

    /**
     * 返回没有数据
     */
    public static function noData()
    {
        return [
            'total_page'   => 0,
            'current_page' => 1,
            'page_size'    => DEFAULT_PAGE_SIZE,
            'total_count'  => 0,
            'list'         => [],
        ];
    }



}