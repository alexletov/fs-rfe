<?php
/**
 * @file MenuWidget.php
 * 
 * @autor Alex Letov
 * 
 * Menu widget.
 */
class MenuWidget extends CWidget { 
    public $menu = 'main';
    public function run() {
        // передаем данные в представление виджета
        switch($this->menu)
        {
            case('main'): $this->render('mainmenu');
        }
    }
}
?>
