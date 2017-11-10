<?php 
namespace Eadmin\Kernel\Support;

use Yii;
use Exception;
use Eadmin\Kernel\Factory\GenFactory;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Constants;
use Eadmin\Config;

class Table
{
	public $object;

	public function __construct(GenFactory $object)
	{
		$this->object = $object;
	}

	/**
	 * 执行创建表
	 * 
	 * @param  object $response Command对象
	 * @return boolean
	 */
	public function executeCreateTable($response)
	{
		return $response->execute();
	}

	/**
	 * 获取表字段
	 * 
	 * @return array 
	 */
	public function getTableField()
	{
		$sql = [];
		$definition = '';

		foreach ($this->object->modelParams as $key => $value) {
			try {
				$fullClass   = $this->object->namespace['field'] . '\\' . $value['type'];
				if($value['type'] == Constants::PRIMARY_FIELD) {
					$definition = 'pk';
				} else {
					$fieldObject = new $fullClass;
				    $fieldType   = $fieldObject->getType();

				    if(isset($value['max_length'])) {
				    	$fieldLength = $value['max_length'];
				    } else {
				    	$fieldLength = $fieldObject->getLength();
				    }

				    if(! empty($fieldType)) {
				    	if(! empty($fieldLength)) {
				    		$definition = "{$fieldType}({$fieldLength})";
				    	} else {
				    		$definition = "{$fieldType}"; 
				    	}
				    }
				}

			    if(isset($value['unsigned']) && $value['unsigned'] == true) {
			    	$definition .= " UNSIGNED";
			    }

			    if(isset($value['null']) && $value['null'] == true) {
			    	$definition .= " NOT NULL";
			    }
				
				if(isset($value['default'])) {
					$definition .= " DEFAULT '{$value['default']}'";
				}

				if(isset($value['comment'])) {
					$definition .= " COMMENT '{$value['comment']}'";
				}

				$sql[$key] = $definition;

			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		return $sql;
	}

	/**
	 * 获取表注释
	 * 
	 * @return string
	 */
	public function getTableComment()
	{
		$sql = '';
		if(isset($this->object->metaParams['comment'])) {
			$sql = " COMMENT='{$this->object->metaParams['comment']}'";
		} 

		return $sql;
	}

	/**
	 * 获取表字符集
	 * 
	 * @return string
	 */
	public function getTableCharset()
	{
		return " DEFAULT CHARSET=utf8";
	}

	/**
	 * 获取表引擎
	 * 
	 * @return string
	 */
	public function getTabelEngine()
	{
		return " ENGINE=InnoDB";
	}

	/**
	 * 获取表前缀
	 * 
	 * @return string
	 */
	public function getTablePrefix()
	{
		return Config::get('Database', 'table_prefix');
	}

	/**
	 * 获取表名称
	 * 
	 * @return string
	 */
	public function getTableName()
	{
        return Helpers::getUnderscore($this->getTableOriginName());
	}

	/**
	 * 获取表完整名称
	 * 
	 * @return string
	 */
	public function getTableFullName()
	{
		return $this->getTablePrefix() . $this->getTableName();
	}

	/**
	 * 获取表视图文件名称
	 * 
	 * @return string
	 */
	public function getTableViewName()
	{
        return Helpers::getUnderline($this->getTableOriginName());
	}

	/**
	 * 获取表原始名称
	 * 
	 * @return string
	 */
	public function getTableOriginName()
	{
	    return Helpers::getLastIndex($this->object->classer['name']);
	}

	/**
	 * 获取表的父级ID
	 * 
	 * @return int
	 */
	public function getTableParentId()
	{
		$options = $this->object->objecter->options;

		return isset($options['menu']['parent_id']) ? $options['menu']['parent_id'] : 0;
	}	

	/**
	 * 获取表的属性是否展示在菜单
	 * 
	 * @return int
	 */
	public function getTableIsShow()
	{
		$options = $this->object->objecter->options;

		return isset($options['menu']['is_show']) ? $options['menu']['is_show'] : 1;
	}

	/**
	 * 获取表的说明
	 * 
	 * @return string
	 */
	public function getTableVerboseName()
	{
		return $this->object->objecter->verbose_name;
	}

	/**
	 * 获取表的标签
	 * 
	 * @return string
	 */
	public function getTableLabelName()
	{
		return $this->object->objecter->label_name;
	}

}