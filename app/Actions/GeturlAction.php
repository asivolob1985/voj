<?php
namespace App\Actions;
use TCG\Voyager\Actions\AbstractAction;
class GeturlAction extends AbstractAction
{
	public function getTitle()
	{
		// Название действия, которое отображается в кнопке
		// в зависимости от текущего состояния
		return 'Перейти';
	}

	public function getUrl()
	{
		// Название действия, которое отображается в кнопке
		// в зависимости от текущего состояния
		return 'Перейти';
	}
	public function getIcon()
	{
		// Значок действия, который отображается слева от кнопки
		// в зависимости от текущего состояния
		return 'voyager-eye';
	}
	public function getAttributes()
	{
		// Класс кнопки действия
		return [
			'class' => 'btn btn-sm btn-success pull-right',
		];
	}
	public function shouldActionDisplayOnDataType()
	{
		// Показывать или скрыть кнопку действия. Отображается только для модели
		if($this->dataType->name === 'pages'){
			return true;
		}

		return false;

	}
	public function getDefaultRoute()
	{
		// URL-адрес для кнопки действия при нажатии кнопки
		return route('pages.geturl', array("path"=>$this->data->slug));
	}
}
 
