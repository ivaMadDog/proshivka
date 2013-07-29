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
            
            !empty($title) ? $slug=$title : $slug='title';
            !empty($description) ? $descr=$description : $descr='description';

            $slug = (!empty($this->data[$modelName]['slug'])) ? $this->data[$modelName]['slug'] : $this->data[$modelName]['title'];
            $this->data[$modelName]['slug'] = Inflector::slug($slug, '-');

            $this->data[$modelName]['meta_title'] = !empty($this->data[$modelName]['meta_title']) ? $this->data[$modelName]['meta_title'] : $this->data[$modelName][$slug];
            $this->data[$modelName]['meta_description'] = !empty($this->data[$modelName]['meta_description']) ? $this->data[$modelName]['meta_description'] : $this->data[$modelName][$descr];
        }
        
        
        
        
}



















