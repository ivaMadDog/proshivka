<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public function saveSeo($title=0, $description=0)
        {
            $modelName = $this->name;

            if(empty($title)) $title='title';
            if(empty($description)) $description='description';
//			debug($title);
//						debug($descr);die;

            $slug = (!empty($this->data[$modelName]['slug'])) ? $this->data[$modelName]['slug'] : $this->data[$modelName][$title];
            $this->data[$modelName]['slug'] = $this->rusToEngSlug(Inflector::slug($slug, '-'));

            $this->data[$modelName]['meta_title'] = !empty($this->data[$modelName]['meta_title']) ? $this->data[$modelName]['meta_title'] : $this->data[$modelName][$title];
            $this->data[$modelName]['meta_description'] = !empty($this->data[$modelName]['meta_description']) ? $this->data[$modelName]['meta_description'] : $this->data[$modelName][$description];
        }


	protected function rusToEngSlug($slug, $flag="eng"){
		 $translit = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'j',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'x',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',
            'ь' => '_',  'ы' => 'y',   'ъ' => '_',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'J',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C',
            'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH',
            'Ь' => '_',  'Ы' => 'Y',   'Ъ' => '_',
            'Э' => 'E',   'Ю' => 'YU',  'Я' => 'YA',
        );

       return ($flag=="eng")? strtr($slug, $translit):  strtr('prochee', array_flip($translit));

	}




}



















