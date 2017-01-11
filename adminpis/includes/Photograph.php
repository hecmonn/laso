<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
require_once("Database.php");
defined('DS') ? null : define('DS', '/');
defined('SITE_ROOT') ? null : define('SITE_ROOT','/home1/lasovpco/public_html');
class Photograph {
	protected static $db_fields = ['id', 'filename', 'type', 'size'];
	protected $table_name = "photos";
	public $id;
	public $filename;
	public $type;
	public $size;
	private $temp_path;
	protected $directory ="requests";
	protected $ext;
	public $errors =[];
	protected $uploaded_errors = [
	UPLOAD_ERR_OK => "No errors.",
	UPLOAD_ERR_INI_SIZE => "Image bigger than expected.",
	UPLOAD_ERR_FORM_SIZE => "Image bigger than expected.",
	UPLOAD_ERR_PARTIAL => "Partial upload.",
	UPLOAD_ERR_NO_FILE => "No image selected.",
	UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	UPLOAD_ERR_EXTENSION => "Stopped by extension."];

	public function attach_file($file){
		$allowed_types =["image/jpeg","image/gif", "image/png", "image/bmp", "image/jpg"];
		if((!$file) || empty($file) || !is_array($file)){
			$this->errors[]= "No file uploaded.";
			//die("empty" .var_dump($this->errors));
			$_SESSION["message"]= "No file uploaded.";
			return false;
		}
		if($file['error'] != 0){
			$this->errors[] = $this->uploaded_errors[$file['error']];
			//die("attached error" .var_dump( $this->errors));
			$_SESSION["message"] ="You have errors.";
			return false;
		}
		//if(!in_array($file['type'][$i], $allowed_types)){
		//	$this->errors[]="Please upload an image";
			//die("allowed types error" . var_dump($this->errors));
			//$_SESSION["message"] ="Please upload an image.";
			//return false;
		//}
			$this->filename = $file['name'];
			$this->type = $file['type'];
			$this->temp_path = $file['tmp_name'];
			$this->size = $file['size'];
			if($this->type == "image/png"){
				$this->ext = ".png";
			}
			elseif($this->type == "image/jpg"){
				$this->ext = ".jpg";
			}
			elseif($this->type == "image/jpeg"){
				$this->ext= ".jpg";
			}
			elseif($this->type == "image/gif"){
				$this->ext=".gif";
			}
			elseif($file['type'][$i] == "image/bmp"){
				$this->ext=".bmp";
			}
			return true;
		
	}

	public function save_file() {
		$time = time();
		$this->filename = $time . $this->ext;
		if(!empty($errors)) { return false; }
		if(!file_exists(SITE_ROOT .DS. $this->directory)){
			mkdir(SITE_ROOT . DS . $this->directory);
		}

		$target_path = SITE_ROOT . DS . $this->directory . DS . $this->filename;
		if(move_uploaded_file($this->temp_path, $target_path)){
			global $Database;
			$sql = "INSERT INTO photos(filename,type,size,abs_path) VALUES('";
			$sql .= $this->filename ."','" .$this->type. "','" .$this->size. "','";
			$sql .=  $target_path . "')";
			exec_query($sql);
			unset($this->temp_path);
			return $this->filename;
		}
		else { return false;}
	}
}
$Photo = new Photograph();
?>