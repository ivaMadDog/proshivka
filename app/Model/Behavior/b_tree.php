<?php
class BTreeBehavior extends ModelBehavior
{

        var $flagDisplayAllLevels = false;

        function setup(&$Model, &$settings = null) {
            // do something when creating behaviour object
            $this->Model = $Model;
            $this->flagDisplayAllLevels($this->flagDisplayAllLevels);
        }
    
        function flagDisplayAllLevels($value = false)
        {
            $this->Model->flagDisplayAllLevels = $value;
        }

        function tree($Model, $settings = null, $params = array())
        {
        //debug(func_get_args());
                $tree = $this->branch($Model, $settings, null, $params);
                //print_r($tree);
                return $tree;
        }

        function count($Model, $settings = null, $parent_id = null, $params = array())
        {
                $conditions = array($this->Model->name.'.parent_id'=>$parent_id);
                if(!empty($params['conditions'])) $conditions = array_merge($conditions, $params['conditions']);
                return $this->Model->find('count', array('conditions'=>$conditions));
        }

        function countAll($Model, $settings = null, $parent_id = null, $params = array())
        {
                $conditions = array();
                if(!empty($params['conditions'])) $conditions = array_merge($conditions, $params['conditions']);
                return $this->Model->find('count', array('conditions'=>$conditions));
        }
        
        function countPages($Model, $settings = null, $parent_id = null, $params)
        {
                extract($params);
                $count = $this->count($Model, $settings, $parent_id = null, $params);
                return $pageCount = intval(ceil($count / $limit));
        }

        function branch($Model, $settings = null, $parent_id = null, $params = array(), &$level = null)
        {
                if($Model) $this->Model = $Model;
                $result = array();

				if(isset($params['level']) && ($level-1)>=$params['level']) 
					return $result;

                $this->Model->resursive = 1;
                //$_conditions = array_merge($conditions, array("parent_id IS NULL"));
                $level++;
                if($level>1){
                        // !!! per paging for parent only
                        unset($params['limit'],$params['page']);
                } 
                if(empty($params['conditions'])) $params['conditions'] = array();
                if(!empty($params['fields'])) $array['fields'] = $params['fields'];
                $array['conditions'] = $params['conditions'];
                //if(!$this->Model->flagDisplayAllLevels)
                    $array['conditions'] = array_merge($array['conditions'], array('parent_id'=>$parent_id));
                if(!empty($params['limit'])) $array['limit'] = $params['limit'];
                if(!empty($params['page'])) $array['page'] = $params['page'];
                if($branches = $this->Model->find('all', $array)){
                        unset($params['limit'],$params['page']);

                        foreach($branches AS $i=>$row){
                            
								if(isset($params['level']) && ($level-1)>=$params['level']) 
									$row['hasChildren'] = 0;
								else
                                	$row['hasChildren'] = $this->count($Model, null, $row[$this->Model->name]['id'], $params);
                                if($this->Model->flagDisplayAllLevels && $row['hasChildren']){
                                    
                                        $children = $this->branch($Model, $settings, $row[$this->Model->name][$this->Model->primaryKey], $params, $level);
                                        if($children) $row = array_merge($row, array('children'=>$children));
                                }
                                $result[] = $row;

                        }
                }
                return $result;
        }


        /**
         * @return flat array
         */
        function getList($Model, $settings = null, $parent_id = null, $params = array(), $prefix = '&nbsp;&nbsp;&nbsp;&nbsp;', &$result = array())
        {    
                if(empty($params['conditions'])) $params['conditions'] = array();
                $array['fields'] = array('id', 'parent_id', 'title', 'created');
                $array['conditions'] = array_merge(array($this->Model->name.'.parent_id'=>$parent_id), $params['conditions']);
                if($branches = $this->Model->find('all', $array)){
                        
                        foreach($branches AS $i=>$row){
                                $row[$this->Model->name]['title'] = ((!$row[$this->Model->name]['parent_id']) ? null : $prefix).$row[$this->Model->name]['title'];
//                                $result[] = $row[$this->Model->name];
                                $result[$row[$this->Model->name]['id']] = $row[$this->Model->name]['title'];
                                //if(!$this->onlyFirstLevel){
                                        $row['hasChildren'] = $this->count($Model, null, $row[$this->Model->name]['id'], $params);
                                        if($row['hasChildren']){
                                                $this->getList($Model, $settings, $row[$this->Model->name][$this->Model->primaryKey], $params, ((!$row[$this->Model->name]['parent_id']) ? $prefix : $prefix.$prefix), $result);
                                        }
                                //}
                                
                        }
                }
                return $result;
        }


        
        function getIdsOfParentsHasChildren($Model, $settings = null, $parent_id = null, $params = array(), &$result = array())
        {
                if(empty($params['conditions'])) $params['conditions'] = array();
                $array['fields'] = array('id', 'parent_id');
                $array['conditions'] = array_merge(array($this->Model->name.'.parent_id'=>$parent_id), $params['conditions']);
                if($branches = $this->Model->find('all', $array)){
                        
                        foreach($branches AS $i=>$row){
                                        
                                //if(!$this->onlyFirstLevel){
                                        $row['hasChildren'] = $this->count($Model, null, $row[$this->Model->name]['id'], $params);
                                        if($row['hasChildren']){
                                                $result[] = $row[$this->Model->name]['id'];
                                                $this->getIdsOfParentsHasChildren($Model, $settings, $row[$this->Model->name][$this->Model->primaryKey], $params, $result);
                                        }
                                //}
                                
                        }
                }
                return $result;
        }


        /**
         * @return flat array
         */
        function getParents($Model, $settings = null, $parent_id = null, $params = array(), &$results = array())
        {
	        	if($Model) $this->Model = $Model;
                if(!$parent_id) return $results;
                if(empty($params['conditions'])) $params['conditions'] = array();
                $array['fields'] = array('id', 'parent_id', 'slug', 'title', 'created');
                if(!empty($params['fields'])) $array['fields']= array_merge($array['fields'],$params['fields']);
                $array['conditions'] = array_merge(array($this->Model->alias.'.id' => $parent_id), $params['conditions']);
                $results[] = $item = $this->Model->find('first', $array);
                //debug($this->Model->alias);
                $this->getParents($Model, $settings, $item[$this->Model->alias]['parent_id'], $params, $results);
                return $results;
        }

        /**
         * @return flat ids array
         */
        function getChildrenIds($Model, $settings = null, $id = null, $params = array(), &$results = array())
        {
	        	if($Model) $this->Model = $Model;
                if(!$id) return $results;
                if(empty($params['conditions'])) $params['conditions'] = array();
                $array['fields'] = array('id', 'id');
                if(!empty($params['fields'])) $array['fields']= array_merge($array['fields'],$params['fields']);
                $array['conditions'] = array_merge(array($this->Model->alias.'.parent_id' => $id), $params['conditions']);
                $data = $this->Model->find('list', $array);
                foreach($data AS $item){
                //debug($this->Model->alias);
                	$results[] = $item;
                	$this->getChildrenIds($Model, $settings, $item, $params, $results);
                }
                return $results;
        }

        /**
         * @return flat array
         */
        function getChildrenFlatArray($Model, $settings = null, $id = null, $params = array(), &$results = array())
        {
	        	if($Model) $this->Model = $Model;
                if(!$id) return $results;
                if(empty($params['conditions'])) $params['conditions'] = array();
                $array['fields'] = array('id', 'parent_id', 'slug', 'title', 'created');
                if(!empty($params['fields'])) $array['fields']= array_merge($array['fields'],$params['fields']);
                $array['conditions'] = array_merge(array($this->Model->alias.'.parent_id' => $id), $params['conditions']);
                $data = $this->Model->find('all', $array);
                foreach($data AS $item){
                //debug($this->Model->alias);
                	$results[] = $item[$this->Model->alias];
                	$this->getChildrenFlatArray($Model, $settings, $item[$this->Model->alias]['id'], $params, $results);
                }
                return $results;
        }

        /**
         * @return flat array
         */
        function getParentsIds($Model, $settings = null, $parent_id = null, $params = array(), &$results = array())
        {
	        	if($Model) $this->Model = $Model;
                if(!$parent_id) return $results;
                if(empty($params['conditions'])) $params['conditions'] = array();
                $array['fields'] = array('id', 'parent_id', 'slug', 'title', 'created');
                if(!empty($params['fields'])) $array['fields']= array_merge($array['fields'],$params['fields']);
                $array['conditions'] = array_merge(array($this->Model->alias.'.id' => $parent_id), $params['conditions']);
                $item = $this->Model->find('first', $array);
                $results[] = $item[$this->Model->alias]['id'];
                //debug($this->Model->alias);
                $this->getParentsIds($Model, $settings, $item[$this->Model->alias]['parent_id'], $params, $results);
                return $results;
        }

        function sortBranch($Model, $settings = null, $id, $sort, $field = 'pos', $conditions = array())
        {
                $modelName = $Model->name;

                if(!$data = $this->Model->findById($id))
                        return;
                $old_pos = $data[$this->Model->alias][$field];
                $parent_id = $data[$this->Model->alias]['parent_id'];
                $new_pos = ($sort == 'up') ? $old_pos - 1 : $old_pos + 1;
                if($new_pos < 0) $new_pos = 0;
                $pos_sort = ($old_pos < $new_pos) ? 'DESC' : 'ASC';
                $this->Model->id = $id;
                $this->Model->saveField($field, $new_pos);
                //$this->Model->getDataSource()->showLog();
                $tmps = $this->Model->find('all', array(
                        'fields'=>array("{$modelName}.id, IF({$modelName}.id={$id},0,1) AS FF"),
                        'conditions'=>array_merge($conditions, array('parent_id'=>$parent_id)),
                        'order'=>array("{$field}, FF {$pos_sort}")));

                for ($i = 0; $i < sizeof($tmps); $i++){
                        $tmp_id = $tmps[$i][$this->Model->alias]["id"];
                        $this->Model->id = $tmp_id;
                        $this->Model->saveField($field, $new_pos = ($i+1));
                        //echo "<br>$tmp_id, $new_pos";
                }
        }

        function deleteBranch($Model, $settings = null, $id)
        {
            $branch = $this->Model->findById($id);
            if(!$branch) return;
            $res = $this->Model->delete($id);
            //$parent_id = $branch[$this->Model->alias]['parent_id'];
            // find children
            if($children = $this->Model->find('all', array('conditions'=>array('parent_id'=>$id)))){
                foreach($children AS $row){
                    $this->deleteBranch($Model, $settings, $row[$this->Model->alias]['id']);
                }
            }
            return $res;
            
        }
        
        function search($Model, $settings = null, $params)
        {
            $this->flagDisplayAllLevels(true);
            $array = array();
            if(empty($params['conditions'])) $params['conditions'] = array();
            if(!empty($params['fields'])) $array['fields'] = $params['fields'];
            if(!empty($params['conditions'])) $array['conditions'] = $params['conditions'];
            if(!empty($params['limit'])) $array['limit'] = $params['limit'];
            if(!empty($params['page'])) $array['page'] = $params['page'];
            // add virtual field, which replaces title
            $this->Model->virtualFields['title'] = "IF({$this->Model->alias}.parent_id IS NULL, {$this->Model->alias}.title, 
            CONCAT(
                (SELECT parent_cat.title FROM {$this->Model->table} AS parent_cat WHERE {$this->Model->alias}.parent_id = parent_cat.id), 
                ' » ', {$this->Model->alias}.title))";
                
            $res = $this->Model->find('all', $array);
            return $res;
        }
        
        
        /**
         * When you create tree-table, field pos=0, this method by define pos increment for each row in table
         *
         * @param unknown_type $Model
         * @param unknown_type $settings
         * @param unknown_type $parent_id
         * @return unknown
         */
        function installDefaultSortValue($Model, $settings = null, $parent_id = null)
        {
            //put order here
            //$this->Category->order = 'id ASC';
            $array['conditions'] = array_merge(array($this->Model->name.'.parent_id'=>$parent_id));
            if($branches = $this->Model->find('all', $array)){
                    
                    foreach($branches AS $i=>$row){
                            $this->Model->query("UPDATE categories SET pos = ".($i+1)." WHERE id = ".$row[$this->Model->name]['id']);
                                    $row['hasChildren'] = $this->count($Model, null, $row[$this->Model->name]['id'], $params);
                                    if($row['hasChildren']){
                                            $this->getList($Model, $settings, $row[$this->Model->name][$this->Model->primaryKey]);
                                    }
                    }
            }
        }
}
?>