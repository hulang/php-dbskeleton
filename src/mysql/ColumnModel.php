<?php

declare(strict_types=1);

namespace php\dbskeleton\mysql;

/**
 * 字段生成模型
 */
class ColumnModel
{
    /**
     * 字段名
     * @var mixed|string
     */
    public $name = '';

    /**
     * 字段类型
     * @var mixed|string
     */
    public $type = '';

    /**
     * 字段长度
     * @var mixed|int
     */
    public $len = 0;

    /**
     * 描述备注
     * @var mixed|string
     */
    public $comment = '';

    /**
     * 是否主键
     * @var mixed|bool
     */
    public $ispk = false;

    /**
     * 是否可以为空
     * @var mixed|bool
     */
    public $isnull = true;

    /**
     * 是否自增长
     * @var mixed|bool
     */
    public $increment = false;

    /**
     * 默认值
     * @var mixed|string
     */
    public $defaultval = '';

    /**
     * 设置字段名称
     * @access public
     * @param string $name 字段名称
     * @return mixed
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * 设置字段类型
     * @access public
     * @param string $type 字段类型
     * @return mixed
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * 设置是否主键
     * @access public
     * @param bool $ispk 是否主键
     * @return mixed
     */
    public function setIsPk($ispk)
    {
        $this->ispk = $ispk;
        return $this;
    }
    /**
     * 设置字段长度
     * @access public
     * @param int $len 字段长度
     * @return mixed
     */
    public function setLen($len)
    {
        $this->len = $len;
        return $this;
    }
    /**
     * 设置字段描述
     * @access public
     * @param string $comment 字段描述
     * @return mixed
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
    /**
     * 设置字段是否自增长
     * @access public
     * @param bool $increment 字段是否自增长
     * @return mixed
     */
    public function setIncrement($increment)
    {
        $this->increment = $increment;
        return $this;
    }
    /**
     * 设置字段是否可以为空
     * @access public
     * @param bool $isnull 字段是否可以为空
     * @return mixed
     */
    public function setIsnull($isnull)
    {
        $this->isnull = $isnull;
        return $this;
    }
    /**
     * 设置字段默认值
     * @access public
     * @param string $value 字段默认值
     * @return mixed
     */
    public function setDefaultval($value)
    {
        $this->defaultval = $value;
        return $this;
    }
    /**
     * 生成字段Sql
     * @return mixed|string
     */
    public function Generate()
    {
        $columnsql = ' `' . $this->name . '` ';
        if ($this->type) {
            $columnsql .= $this->type;
        }
        if ($this->len) {
            $columnsql .= ' (' . $this->len . ') ';
        }
        if ($this->increment) {
            $columnsql .= ' AUTO_INCREMENT ';
        }
        // 不允许空
        if ($this->isnull == false) {
            $columnsql .= ' NOT NULL ';
        }
        // 是否有默认值
        if ($this->defaultval != '') {
            $columnsql .= ' DEFAULT  ' . $this->defaultval . ' ';
        }
        $columnsql .= "COMMENT '" . $this->comment . "' ";
        if ($this->ispk) {
            $columnsql .= ' , PRIMARY KEY (`' . $this->name . '`) ';
        }
        return $columnsql;
    }
}
