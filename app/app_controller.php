<?php
class AppController extends Controller {
	
        public $view = 'Theme';
        public $theme = 'fronted';
        public $components = array( 'Session', 'RequestHandler');

        public $helpers = array('Html','Ajax','Javascript', 'Form',  'Session','fck');
        public $admin, $sid, $logged_in, $data=array();   //
        public $company, $category_arr=array(), $listTree;
        

        function beforeFilter() { 
            
           $this->company=$this->getShopInfo(); // считуем конфиг магазина
          
           $data=$this->Session->read(); 
           $this->sid=$data['Config']['userAgent']; 
           
           $role=isset($data['Auth']['User']['role'])?$data['Auth']['User']['role']:'guest';
           $this->AppInit($role); //инициализация элементов макета: верхнее меню, левое меню
           
                   
           $logged_in=(isset($data['Auth']['User']) && !empty($data['Auth']['User']['id']))?true:false;
           $this->set(compact('logged_in'));
           $this->set('company', $this->company);
           $this->set('baseappurl',$this->company['url']);  
           
         }
/*
 * инициализируем элементы верхнего меню
 * @var role (string)
 * если role === admin то устанавливаем layout=backend
 */
         private function AppInit($role) {             
             if ( !empty($this->params['prefix']) && $this->params['prefix']==='admin') {
               if ($role==='admin') {
                  $this->theme = 'beckend'; 
               }else {
                  $this->Session->setFlash(__('У Вас нет прав для просмотра данной страницы', true));
		  $this->redirect(array('controller' => '/', 'admin'=>false));
                  exit(); 
               }  
              
            }
             
             /*инициализируем элемент - верхнее меню - извлекаем корневые узлы дерева категорий*/
             $this->loadModel('Category');
             $categories=$this->Category->getRootNods();
             $this->set('categories', $categories);
             
             /*инициализируем элемент - верхнее меню - извлекаем корневые узлы дерева категорий*/
             $this->loadModel('Phone');
             $this->Phone->recursive=-1; 
             $phones=$this->Phone->find('all');
             $this->set(compact('phones'));
             
             /*инициализируем левое меню категорий*/
             $this->lmenu( $categories['0']['Category']['id']);
             
             /*заполнение мета-тегов с конфига*/
             $this->setMetaD($this->company['description']);
             $this->setMetaK($this->company['keywords']);
         }
           /** 
 * Метод выводит дерево категорий
 * @return Array - массив категорий для главного горизонтального меню 
 */     
        public function lmenu($id=null){ 
            $this->listTree='';
            $this->category_arr = $this->Category->getArrayCategories(); 
            $this->outTree($id,0);
            $this->set('lmenu',  $this->listTree);
        }
        
 /** 
 * Вывод дерева 
 * @param Integer $parent_id - id-родителя 
 * @param Integer $level - уровень вложености 
 * @return - вид-дерево в $this->_listTree
*/ 
        public function outTree($parent_id, $level) { 
            if (isset($this->category_arr[$parent_id])) { //Если категория с таким parent_id существует             
                $this->listTree = $this->listTree . "<ul ".($level==0?"id=\"lmenu\" class=\"left_menu\">":">");
                foreach ($this->category_arr[$parent_id] as $value) { //Обходим ее 
                    $link=($level==0?"":$this->company['url'].'/products/getcategoryproducts/'.$value['id']);
                    $this->listTree = $this->listTree.'<li><a href=\''.$link.'\'>'.$value['name'].'</a>' ; 
                    $level++; //Увеличиваем уровень вложености 
                    //Рекурсивно вызываем этот же метод, но с новым $parent_id и $level 
                    $this->outTree($value['id'], $level); 
                    $level--; //Уменьшаем уровень вложености
                     $this->listTree = $this->listTree."</li>"; 
                } 
               $this->listTree = $this->listTree."</li></ul>"; 
            }         
        }  
    
         /*метод загрузки основной информации по магазину*/        
        public function getShopInfo(){
           $this->loadModel('Shop');
           $this->Shop->recursive=-1; 
           $shop=$this->Shop->find('all', array('limit'=>1));           
           return $shop['0']['Shop'];
        }      
          
        public function setMetaK($string){
            if (isset($string) && !empty($string)) {
                $this->set('keywords',$string);
            }else{
                 $this->set('keywords',' ');
            }
        }
        
        public function setMetaD($string){
            if (isset($string) && !empty($string)) {
                $this->set('description',$string);
            }else{
                 $this->set('description',' ');
            }
        }
        
}

?>