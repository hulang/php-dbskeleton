<?php

declare(strict_types=1);

namespace php\dbskeleton\mysql;

class TableModel
{
    /**
     * 表名
     *
     * @var mixed|string
     */
    public $tablename;

    /**
     * 数据库引擎
     *
     * @var mixed|string
     */
    public $engine = 'INNODB';

    /**
     * 数据库编码
     *
     * @var mixed|string
     */
    public $charset = 'utf8mb4';

    /**
     * 备注
     *
     * @var mixed|string
     */
    public $comment = '';

    /**
     * 设置表名
     *
     * @param string $tablename
     * @return mixed
     */
    public function setTablename($tablename)
    {
        $this->tablename = $tablename;
        return $this;
    }

    /**
     * 设置引擎
     *
     * @return mixed
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * 设置编码
     *
     * @param string $charset
     * @return mixed
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * 设置备注
     *
     * @param string $comment
     * @return mixed
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
}
