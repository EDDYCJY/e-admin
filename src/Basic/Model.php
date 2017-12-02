<?php

namespace Eadmin\Basic;

use Eadmin\Config;

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
		'label',
	];

    /**
     * @var array
     */
	private $shows = [
		'list_display',
        'detail_display',
		'search_fields',
	];

    public function __construct()
    {
        $preset = [
            'export' => 'eadmin_model_options_configs',
        ];

        foreach ($preset as $index => $name) {
            if(empty($this->options[$index])) {
                $this->options = array_merge($this->options, Config::get('App', $name));
            }
        }
    }

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