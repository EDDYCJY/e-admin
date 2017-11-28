<?php

namespace Eadmin\Basic;

/**
 * Class Model
 * @package Eadmin\Basic
 */
class Model
{
    /**
     * @var array
     */
	public $list_display = [];

    /**
     * @var array
     */
	public $detail_display = [];

    /**
     * @var array
     */
	public $search_fields = [];

    /**
     * @var array
     */
	public $options = [];

    /**
     * @var array
     */
	private $metas = [
		'comment',
		'options',
		'verbose_name',
		'label_name',
	];

    /**
     * @var array
     */
	private $shows = [
		'list_display',
        'detail_display',
		'search_fields',
	];

    /**
     * Get Meta Lists
     *
     * @return array
     */
	public function getMetas()
	{
		return $this->metas;
	}

    /**
     * Get Show Lists
     *
     * @return array
     */
	public function getShows()
	{
		return $this->shows;
	}
}