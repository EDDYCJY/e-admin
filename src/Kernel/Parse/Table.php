<?php 
namespace Eadmin\Kernel\Parse;

use Exception;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Constants;
use Eadmin\Config;

/**
 * Class Table
 * @package Eadmin\Kernel\Parse
 */
class Table
{
	public $object;

	public $params;

	public function __construct($object)
	{
		$this->object = $object;

		$this->params = $object->classer['params'];
	}

	/**
	 * Get Table Fields
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
	 * Get Table Comment
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
	 * Get Table Charset
	 * 
	 * @return string
	 */
	public function getTableCharset()
	{
		return " DEFAULT CHARSET=utf8";
	}

    /**
     * Get Table Engine
     *
     * @return string
     */
	public function getTabelEngine()
	{
		return " ENGINE=InnoDB";
	}

    /**
     * Get Table Prefix
     *
     * @return string
     */
	public function getTablePrefix()
	{
		return Config::get('Database', 'table_prefix');
	}

    /**
     * Get Table Name
     *
     * @return string
     */
	public function getTableName()
	{
        return Helpers::getUnderscore($this->getTableOriginName());
	}

    /**
     * Get Table Full Name
     *
     * @return string
     */
	public function getTableFullName()
	{
		return $this->getTablePrefix() . $this->getTableName();
	}

    /**
     * Get Table View Name
     *
     * @return string
     */
	public function getTableViewName()
	{
        return Helpers::getUnderline($this->getTableOriginName());
	}

    /**
     * Get Table Origin Name
     *
     * @return mixed
     */
	public function getTableOriginName()
	{
	    return Helpers::getLastIndex($this->object->classer['name']);
	}

	/**
	 * Get Table Parent Id
     *
	 * @return int
	 */
	public function getTableParentId()
	{
		return isset($this->params['options']['menu']['parent_id']) ? $this->params['options']['menu']['parent_id'] : 0;
	}	

    /**
     * Get Table isShow
     *
     * @return int
     */
	public function getTableIsShow()
	{
		return isset($this->params['options']['menu']['is_show']) ? $this->params['options']['menu']['is_show'] : 1;
	}

    /**
     * Get Table VerboseName
     *
     * @return mixed
     */
	public function getTableVerboseName()
	{
		return $this->params['verbose_name'];
	}

    /**
     * Get Table Label Name
     *
     * @return string
     */
	public function getTableLabelName()
	{
		return isset($this->params['label']) ? $this->params['label'] : '';
	}

}