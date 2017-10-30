<?php

namespace Eadmin\Basic;

class Model
{
	public $list_display = [];

	public $detail_display = [];

	public $search_fields = [];

	public $options = [];

	private $metas = [
		'comment',
		'options',
		'verbose_name'
	];

	private $shows = [
		'list_display',
        'detail_display',
		'search_fields',
	];

	public function getMetas()
	{
		return $this->metas;
	}

	public function getShows()
	{
		return $this->shows;
	}
}