<?php
App::uses('Component', 'Controller');
/**
 * File Upload Component
 *
 * Component can handle document upload, image resizing and video upload with flv conversion
 *
 * PHP versions 4 and 5
 * CakePhp 1.2+
 * ImageMagick 6.x and FFMPEG required
 *
 *
 * @filesource
 * @version       0.3.0
 * @modifiedby    Adon Doumit
 * @lastmodified  17-02-2010
 */


class FileUploadComponent extends Component {

	var $name='FileUpload';
	var $imageMagick=IMAGEMAGICK;
	var $ffmpeg=array(
		'ffmpegPath'=>'/usr/bin',
		'audioSamplingFrequency'=>'22050',
		'audioBitRate'=>'56k',
		'videoAspectRatio'=>'4:3',
		'videoBitRate'=>'64k',
		'fps'=>'24',
		'videoDimensions'=>'800x600',
		'audioChannels'=>'1',
		'snapshotSeekPercentage'=>'50', //50%
		'snapshotSeekTime'=>'',
		'snapshotSize'=>'366x212',
		);

	function uploadFile($file=array(),$destination,$type='file',$options=array()){
		umask(000);
		$error=false;
		if(!is_array($options)) $options=array();

		if(!isset($options['randomName'])) $randomName=false;
		else $randomName=$options['randomName'];

		if($type=='image'){
			if(!isset($options['extensions']) || empty($options['extensions'])){
				$options=array_merge(array('extensions'=>array('jpg','jpeg','gif','png')),$options);
			}
			if(!isset($options['resize']) || empty($options['resize'])){
				$options['resize']=false;
			}
			if(!isset($options['dimensions']) || empty($options['dimensions']) || !is_array($options['dimensions'])){
				$options['dimensions']=false;
			}
			if(!isset($options['dimensions']['exact'])) $options['dimensions']['exact']=false;
		}
		elseif ($type=='video'){
			if(!isset($options['extensions']) || empty($options['extensions'])){
				$options=array_merge(array('extensions'=>array('mpeg', 'wmv', 'flv', 'mpg','3gp','mov','avi','asf')),$options);
			}
			if(!isset($options['convert'])) $convert=false;
			else $convert=$options['convert'];

			if($convert){
				if(!isset($options['ffmpeg'])) $ffmpeg=$this->ffmpeg;
				else{
					$ffmpeg=array_merge($this->ffmpeg,$options['ffmpeg']);
				}
			}
			if(!isset($options['keepOriginal'])) $keepOriginal=true;
			else $keepOriginal=$options['keepOriginal'];
		}
		else{
			if(!isset($options['extensions']) || empty($options['extensions'])){
				$options=array_merge(array('extensions'=>array('doc','docx','pdf','ppt','pptx','xls','xlsx','txt','rtf')),$options);
			}
		}
		if(isset($options['extensions']) && !is_array($options['extensions'])){
			$options['extensions']=explode(',',$options['extensions']);
		}

		if(!empty($file['name'])){
			if($file['error']!=0){
				$uploadError=$file['error'];
				switch ($uploadError){
					case 1:
						$errorMsg='The file exceeds the maximum allowed upload size of '.ini_get('upload_max_filesize').'B.';
						break;
					case 2:
						$errorMsg='The file exceeds the maximum allowed upload size of '.ini_get('upload_max_filesize').'B.';
						break;
					case 3:
						$errorMsg='The file was not completely uploaded.';
						break;
					case 4:
						$errorMsg='No file uploaded.';
						break;
					default:
						$errorMsg='An error occured while uploading the file.';
						break;
				}
				$error=true;
				$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
				return $retArray;
			}
			else {
				if(isset($options['maxFileSize'])){
					$maxFileSize=$options['maxFileSize'];
					$maxFileSize=$maxFileSize*1024*1024;

					if($file['size']>$maxFileSize){
						$errorMsg='The file size exceeds the maximum limit of '.$options['maxFileSize']."MB";
						$error=true;
						$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
						return $retArray;
					}
				}

				$fileName=$this->_returnFileName($destination,$file['name'],$randomName);
				$fileDestination=$destination.'/'.$fileName;

				$extensions=$options['extensions'];
				if (!$this->_checkFileExtension($file['name'],$extensions)) {
					$allowedExtList=implode(", ",$extensions);
					$errorMsg='The file should have one of the following extensions: '.$allowedExtList;
					$error=true;
					$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
					return $retArray;
				}

				if($type=='image'){
					if(is_array($options['dimensions'])){
						$imageDim=getimagesize($file['tmp_name']);

						$withinWidth=true;
						$withinHeight=true;

						switch ($options['dimensions']['exact']){
							case 'width':
								if(isset($options['dimensions']['width']) && is_numeric($options['dimensions']['width'])){
									$maxWidth=$options['dimensions']['width'];
									if($imageDim[0]!=$maxWidth){
										$withinWidth=false;
									}
								}
								if(isset($options['dimensions']['height']) && is_numeric($options['dimensions']['height'])){
									$maxHeight=$options['dimensions']['height'];
									if($imageDim[1]>$maxHeight){
										$withinHeight=false;
									}
								}
								$dimOpWidth='equal to';
								$dimOpHeight='a maximum of';
								break;
							case 'height':
								if(isset($options['dimensions']['width']) && is_numeric($options['dimensions']['width'])){
									$maxWidth=$options['dimensions']['width'];
									if($imageDim[0]>$maxWidth){
										$withinWidth=false;
									}
								}
								if(isset($options['dimensions']['height']) && is_numeric($options['dimensions']['height'])){
									$maxHeight=$options['dimensions']['height'];
									if($imageDim[1]!=$maxHeight){
										$withinHeight=false;
									}
								}
								$dimOpWidth='a maximum of';
								$dimOpHeight='equal to';
								break;
							case 'both':
								if(isset($options['dimensions']['width']) && is_numeric($options['dimensions']['width'])){
									$maxWidth=$options['dimensions']['width'];
									if($imageDim[0]!=$maxWidth){
										$withinWidth=false;
									}
								}
								if(isset($options['dimensions']['height']) && is_numeric($options['dimensions']['height'])){
									$maxHeight=$options['dimensions']['height'];
									if($imageDim[1]!=$maxHeight){
										$withinHeight=false;
									}
								}
								$dimOpWidth='equal to';
								$dimOpHeight='equal to';
								break;
							default:
								if(isset($options['dimensions']['width']) && is_numeric($options['dimensions']['width'])){
									$maxWidth=$options['dimensions']['width'];
									if($imageDim[0]>$maxWidth){
										$withinWidth=false;
									}
								}
								if(isset($options['dimensions']['height']) && is_numeric($options['dimensions']['height'])){
									$maxHeight=$options['dimensions']['height'];
									if($imageDim[1]>$maxHeight){
										$withinHeight=false;
									}
								}
								$dimOpWidth='a maximum of';
								$dimOpHeight='a maximum of';
								break;
						}
						if(!$withinWidth && $withinHeight){
							$errorMsg="The file should be $dimOpWidth {$options['dimensions']['width']}px in width";
							$error=true;
							$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
							return $retArray;
						}
						elseif ($withinWidth && !$withinHeight){
							$errorMsg="The file should be $dimOpHeight {$options['dimensions']['height']}px in height";
							$error=true;
							$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
							return $retArray;
						}
						elseif (!$withinWidth && !$withinHeight){
							$errorMsg="The file should be $dimOpWidth {$options['dimensions']['width']}px in width and $dimOpHeight {$options['dimensions']['height']}px in height";
							$error=true;
							$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
							return $retArray;
						}
					}

					if(!is_uploaded_file($file['tmp_name'])){
						$errorMsg='An error occured while uploading the file. Please try again.';
						$error=true;
						$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
						return $retArray;
					}
					else{

						if(!copy($file['tmp_name'],$fileDestination)){
							$errorMsg='An error occured while uploading the file. Please try again.';
							$error=true;
							$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
							return $retArray;
						}
						else{
							//							$resizedImages=array();
							if($options['resize']){
								$resizedImages=array();
								if(!isset($options['resizeOptions'][0]) || !is_array($options['resizeOptions'][0])){
									$tmpArray=$options['resizeOptions'];
									$options['resizeOptions']=array();
									$options['resizeOptions'][0]=$tmpArray;
								}
								foreach ($options['resizeOptions'] as $resize){
									if((isset($resize['folder']) && is_dir($resize['folder'])) && ((isset($resize['width']) && is_numeric($resize['width'])) || (isset($resize['height']) && is_numeric($resize['height'])))){
										if(!isset($resize['force']) || empty($resize['force']) || !$resize['force']){
											$resizeOpStart='';
											$resizeOpEnd='>';
										}
										else{
											$resizeOpStart='!';
											$resizeOpEnd='';
										}


										$resizeSave=$resize['folder'].'/'.$fileName;
										$command = $this->imageMagick." -compress jpeg -quality 100 \"$fileDestination\" -scale \"$resizeOpStart{$resize['width']}x{$resize['height']}$resizeOpEnd\" \"$resizeSave\"";
										@passthru($command);


										if(file_exists($resizeSave)){
											$resizedImageInfo=getimagesize($resizeSave);
											$resizedImages[]=array('path'=>$resizeSave,'name'=>$fileName,'wasResized'=>true,'width'=>$resizedImageInfo[0],'height'=>$resizedImageInfo[1]);
										}
										else{
											$resizedImages[]=array('path'=>$resizeSave,'name'=>$fileName,'wasResized'=>false);
										}

									}
								}
							}
							$retArray=array('error'=>false,'fileName'=>$fileName,'filePath'=>$fileDestination,'resizedImages'=>@$resizedImages);
							return $retArray;
						}
					}
				}
				elseif ($type=='video'){
					if(!is_uploaded_file($file['tmp_name'])){
						$errorMsg='An error occured while uploading the file. Please try again.';
						$error=true;
						$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
						return $retArray;
					}
					else{
						if(!copy($file['tmp_name'],$fileDestination)){
							$errorMsg='An error occured while uploading the file. Please try again.';
							$error=true;
							$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
							return $retArray;
						}
						else{
							$duration=$this->_getVideoDuration($fileDestination);

							if(isset($options['max_duration'])){
								if(!is_array($options['max_duration'])){
									$maxDuration=explode(':',$options['max_duration']);
									if(count($maxDuration)==3){
										$hours=$maxDuration[0]*3600;
										$minutes=$maxDuration[1]*60;
										$seconds=$maxDuration[2];

										$totalMax=$hours+$minutes+$seconds;

										$videoDuration=$duration['hours']+$duration['minutes']+$duration['seconds'];

										if($videoDuration>$totalMax){
											$errorMsg="The video exceeds the maximum allowed length ($options[max_duration])";
											$error=true;
											$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
											return $retArray;
										}
									}
									else{
										die("Please provider the max_duration in hh:mm:ss format");
									}
								}
							}
							$retArray=array('error'=>false,'fileName'=>$fileName,'filePath'=>$fileDestination,'duration'=>$duration);

							if($convert && file_exists($fileDestination)){
								if(!isset($options['flvFolder']) || !is_dir($options['flvFolder'])) die("The flv folder does not exist. Please create it!");
								$flvPath=$options['flvFolder'];

								$baseFileName=explode(".",$fileName);
								array_pop($baseFileName);
								$baseFileName=implode('.',$baseFileName);

								$saveTo=$flvPath.'/'.$baseFileName.'.flv';

								$cmd=$ffmpeg['ffmpegPath']."/ffmpeg -i $fileDestination -ar $ffmpeg[audioSamplingFrequency] -ab $ffmpeg[audioBitRate] -aspect $ffmpeg[videoAspectRatio]  -b $ffmpeg[videoBitRate] -r $ffmpeg[fps] -f flv -s $ffmpeg[videoDimensions] -ac $ffmpeg[audioChannels] -y $saveTo";
								passthru($cmd);
								/*sleep(5);
								if(!file_exists($saveTo)){
								unlink($fileDestination);
								$retArray=array('error'=>true,'errorMsg'=>'An error occured while encoding the movie.');
								return $retArray;
								}
								else{*/
								$retArray['wasConverted']=true;
								$retArray['flvName']=$baseFileName.".flv";
								$retArray['flvPath']=$saveTo;

								if(!$keepOriginal){
									unlink($fileDestination);
								}

								if($options['snapshot'] && isset($options['snapshotFolder'])){
									if(!isset($ffmpeg['snapshotSeekTime']) || empty($ffmpeg['snapshotSeekTime'])){
										if(!isset($ffmpeg['snapshotSeekPercentage']) || empty($ffmpeg['snapshotSeekPercentage']) || !is_numeric($ffmpeg['snapshotSeekPercentage']) || $ffmpeg['snapshotSeekPercentage']>100 || $ffmpeg['snapshotSeekPercentage']<0){
											$snapShotPercentage=50;
										}
										else{
											$snapShotPercentage=$ffmpeg['snapshotSeekPercentage'];
										}
										$snapShotSeekTimeArray=$this->_getVideoSnapshotTime($duration,$snapShotPercentage);
										$snapShotSeekTime=$snapShotSeekTimeArray['hours'].':'.$snapShotSeekTimeArray['minutes'].':'.$snapShotSeekTimeArray['seconds'];
									}
									else{
										$snapShotSeekTime=$ffmpeg['snapshotSeekTime'];
									}


									foreach($options['snapshotFolder'] as $key=>$save_path){


											$snapshotSave=$save_path."/$baseFileName.jpg";
											$snapshotSize=$ffmpeg['snapshotSize']["$key"];

											if(file_exists($snapshotSave)){

											}else{
												$imgCmd=$ffmpeg['ffmpegPath']."/ffmpeg -i $saveTo -an -ss $snapShotSeekTime -t 00:00:01 -r 1 -y -s $snapshotSize $snapshotSave";
												passthru($imgCmd);
											}

									}

									// $snapshotSave=$options['snapshotFolder']."/$baseFileName.jpg";
									// $imgCmd=$ffmpeg['ffmpegPath']."/ffmpeg -i $saveTo -an -ss $snapShotSeekTime -t 00:00:01 -r 1 -y -s $ffmpeg[snapshotSize] $snapshotSave";
									// passthru($imgCmd);
									sleep(2);
									//$snapshotSaveFile=$options['snapshotFolder']."/{$baseFileName}1.jpg";
									/*if(!file_exists($snapshotSaveFile)){
									unlink($fileDestination);
									unlink($saveTo);
									$retArray=array('error'=>true,'errorMsg'=>'An error occured while encoding the movie.');
									return $retArray;
									}
									else{*/
									$snapshotProperties=getimagesize($snapshotSave);
									$retArray['snapshotSeekTime']=$snapShotSeekTime;
									$retArray['snapshotName']=$baseFileName.".jpg";
									$retArray['snapshotPath']=$snapshotSave;
									$retArray['snapshotWidth']=$snapshotProperties[0];
									$retArray['snapshotHeight']=$snapshotProperties[1];

									// if(isset($options['snapshotResize']) && $options['snapshotResize']){
										// if(!isset($options['snapshotResizeOptions']['folder']) || !is_dir($options['snapshotResizeOptions']['folder'])){
											// die("The resize folder does not exist. Please create it!");
										// }
										// else{
											// if(!isset($options['snapshotResizeOptions']['width']) && !isset($options['snapshotResizeOptions']['height'])){
												// $options['snapshotResizeOptions']['width']=100;
												// $options['snapshotResizeOptions']['height']=100;
											// }
//
											// if(!isset($options['snapshotResizeOptions']) || !$options['snapshotResizeOptions']['force']){
												// $resizeOpStart='';
												// $resizeOpEnd='>';
											// }
											// else{
												// $resizeOpStart='!';
												// $resizeOpEnd='';
											// }
										// }
//
										// $resizeSave=$options['snapshotResizeOptions']['folder']."/{$baseFileName}.jpg";
										// $command = $this->imageMagick."/convert -compress jpeg -quality 100 \"$snapshotSaveFile\" -scale '$resizeOpStart{$options['snapshotResizeOptions']['width']}x{$options['snapshotResizeOptions']['height']}$resizeOpEnd' \"$resizeSave\"";
										// passthru($command);
										// /*	sleep(1);
										// if(!file_exists($resizeSave)){
										// unlink($fileDestination);
										// unlink($saveTo);
										// unlink($snapshotSaveFile);
										// $retArray=array('error'=>true,'errorMsg'=>'An error occured while encoding the movie.');
										// return $retArray;
										// }
										// else{*/
										// $retArray['wasResized']=true;
										// $retArray['resizePath']=$resizeSave;
										// $resizeProperties=getimagesize($resizeSave);
										// $retArray['resizeWidth']=$resizeProperties[0];
										// $retArray['resizeHeight']=$resizeProperties[1];
										// //												}
									// }
									//										}
								}
								//								}
							}
							return $retArray;
						}
					}
				}
				else{
					if(!is_uploaded_file($file['tmp_name'])){
						$errorMsg='An error occured while uploading the file. Please try again.';
						$error=true;
						$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
						return $retArray;
					}
					else{
						if(!copy($file['tmp_name'],$fileDestination)){
							$errorMsg='An error occured while uploading the file. Please try again.';
							$error=true;
							$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
							return $retArray;
						}
						else{
							$retArray=array('error'=>false,'fileName'=>$fileName,'filePath'=>$fileDestination);
							return $retArray;
						}
					}
				}
			}
		}
		else{
			$errorMsg='No file was uploaded. Please choose a file to upload.';
			$error=true;
			$retArray=array('error'=>$error,'errorMsg'=>$errorMsg);
			return $retArray;
		}
	}

	function _getVideoDuration($file){

		if(!file_exists($file)) return false;
		else {
			//As of ver 0.5m ffmpeg does not have a command to directly get the duration
			//To get it, we use the file info returned from ffmpeg -i <file> and perform some command line parsing

			$command="ffmpeg -i $file 2>&1 | grep \"Duration\" | cut -d ' ' -f 4 | sed s/,//";
			$duration=exec($command);

			$millisecArray=explode('.',$duration);
			if(!isset($millisecArray[1]) || empty($millisecArray[1])) $millisec=0;
			else $millisec=$millisecArray[1];

			$time=$millisecArray[0];
			list($hours,$minutes,$seconds)=explode(":",$time);

			return array('hours'=>$hours,'minutes'=>$minutes,'seconds'=>$seconds,'millisec'=>$millisec);

		}
	}

	function _getVideoSnapshotTime($duration,$percentage='50'){
		$hours=$duration['hours'];
		$minutes=$duration['minutes'];
		$seconds=$duration['seconds'];

		$hours=$hours*3600;
		$minutes=$minutes*60;

		$total=$hours+$minutes+$seconds;

		$percentage=(int)$percentage;
		$percentage=$percentage/100;

		$total=$total*$percentage;

		$remainingMinutes=$total%3600;
		$hours=$total/3600;

		$seconds=$remainingMinutes%60;
		$minutes=$remainingMinutes/60;

		return array('hours'=>(int)$hours,'minutes'=>(int)$minutes,'seconds'=>(int)$seconds);

	}


	function _checkFileExtension($file,$extensions){
		$extension = strtolower(array_pop(explode('.', $file)));
		return in_array(strtolower($extension),$extensions);
	}

	function _returnFileName($destination,$fileName,$randomName){
		if($randomName){
			$extension = strtolower(array_pop(explode('.', $fileName)));
			$fileName=uniqid().microtime();
			$fileName=md5($fileName);
			$fileName=$fileName.'.'.$extension;

			$fileDestination=$destination.'/'.$fileName;

			while (file_exists($fileDestination)) {
				$fileName=uniqid().microtime();
				$fileName=md5($fileName);
				$fileName=$fileName.'.'.$extension;
			}
		}
		else{
			$next=0;
			$existNum=0;
			$badChars=preg_replace('/([[:alnum:]_\.-]*)/',"",$fileName);
			$bad_arr=str_split($badChars);
			$fileName=str_replace($bad_arr,'_',$fileName);
			//			$fileName=ereg_replace("[^A-Za-z0-9_\.]", "", $fileName);
			$fileDestination=$destination.'/'.$fileName;
			$existNum=file_exists($fileDestination);
			if($existNum>0){
				do{
					$next++;
					$combo = explode(".",$fileName);
					$fileext = strtolower(array_pop(explode('.', $fileName)));
					$temp = explode("[",$combo[0]);
					$tempname = $temp[0];
					$fileName = $tempname."[".$next."].".$fileext;
					$fileDestination=$destination.'/'.$fileName;
					$existNum = file_exists($fileDestination);
				}while ($existNum>0);
			}
		}

		return $fileName;
	}



	function save_video_snapshot($videoArgs){
		umask(000);
		$options=$videoArgs;
		$ffmpeg=$videoArgs['ffmpeg'];
		$file_name=$videoArgs['file_name'];
		$reformat_extention=$options['reformat_extention'];

		$destination=$videoArgs['flvFolder'];

		$fileDestination=$destination."/".$file_name;//full url


		if(file_exists($fileDestination)){
			$duration=$this->_getVideoDuration($fileDestination);

			if(!isset($options['extensions']) || empty($options['extensions'])){
				$options=array_merge(array('extensions'=>array('mpeg', 'wmv', 'flv', 'mpg','3gp','mov','avi','asf')),$options);
			}
			if(!isset($options['convert'])) $convert=false;
			else $convert=$options['convert'];

			if($convert){
				if(!isset($options['ffmpeg'])) $ffmpeg=$this->ffmpeg;
				else{
					$ffmpeg=array_merge($this->ffmpeg,$options['ffmpeg']);
				}
			}



		if(!isset($ffmpeg['snapshotSeekTime']) || empty($ffmpeg['snapshotSeekTime'])){
			if(!isset($ffmpeg['snapshotSeekPercentage']) || empty($ffmpeg['snapshotSeekPercentage']) || !is_numeric($ffmpeg['snapshotSeekPercentage']) || $ffmpeg['snapshotSeekPercentage']>100 || $ffmpeg['snapshotSeekPercentage']<0){
				$snapShotPercentage=50;
			}
			else{
				$snapShotPercentage=$ffmpeg['snapshotSeekPercentage'];
			}
			$snapShotSeekTimeArray=$this->_getVideoSnapshotTime($duration,$snapShotPercentage);
			$snapShotSeekTime=$snapShotSeekTimeArray['hours'].':'.$snapShotSeekTimeArray['minutes'].':'.$snapShotSeekTimeArray['seconds'];
		}
		else{
			$snapShotSeekTime=$ffmpeg['snapshotSeekTime'];
		}


		foreach($options['snapshotFolder'] as $key=>$save_path){

			$baseFileName=explode(".",$file_name);
			array_pop($baseFileName);
			$baseFileName=$baseFileName[0].".jpg";


			$snapshotSave=$save_path."/$baseFileName";
			$snapshotSize=$ffmpeg['snapshotSize']["$key"];

			if(file_exists($snapshotSave)){

			}else{
				$imgCmd=$ffmpeg['ffmpegPath']."/ffmpeg -i $fileDestination -an -ss $snapShotSeekTime -t 00:00:01 -r 1 -y -s $snapshotSize $snapshotSave";
				passthru($imgCmd);
			}
			//$fileName=$this->_returnFileName($save_path,$baseFileName,false);
			//sleep(2);
			//$snapshotSaveFile=$options['snapshotFolder']."/{$baseFileName}1.jpg";
		}


		$snapshotProperties=getimagesize($snapshotSave);
		$retArray['snapshotName']=$baseFileName;
		$retArray['snapshotWidth']=$snapshotProperties[0];
		$retArray['snapshotHeight']=$snapshotProperties[1];

		return $retArray;

	   }
	}
}