<?php
class GetArrayFormatHelper extends AppHelper {

	//// Converts array into string	//////
	function get_string_array($get,$use_entity=1){
		$get_array="";
//		if($use_entity==1)
//			$and_sep="&amp;";
//		else 
		
		$and_sep="&";
		
		if(sizeof($get)>1){
			foreach ($get as $get_key=>$get_val){
				if($get_key!="url"){
//					if(empty($get_array))
//					$get_array.="?";
//					else{
						$get_array.=$and_sep;
//					}
					
					if(is_array($get_val)){
						$get_key=$get_key."[]";
						
						$i=0;
						foreach ($get_val as $val){
							if($i>0){
								$get_array.=$and_sep;
							}
								
							$get_array.="$get_key=$val";
							
							$i++;
						}
						
					}else{
		
						$get_array.="$get_key=$get_val";
					}
				}
			}
		}
		
		return $get_array;
	}
	
}
?>