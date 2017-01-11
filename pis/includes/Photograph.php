<?php //AUTHOR: HECTOR E. MONARREZ ARAUJO
defined('DS') ? null : define('DS', '/');
defined('SITE_ROOT') ? null : define('SITE_ROOT','/home1/lasovpco/public_html');
class Photograph{
	protected static $db_fields = ['id', 'filename', 'type', 'size'];
	protected $table_name = "photos";
	public $id;
	public $filename;
	public $type;
	public $size;
	private $temp_path;
	private $ext;
	protected $directory ="uploads";
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

	public function attach_file($file, $i){
		$allowed_types =["image/jpeg","image/gif", "image/png", "image/bmp", "image/jpg"];
		if((!$file) || empty($file) || !is_array($file)){
			$this->errors[]= "No file uploaded.";
			//die("empty" .var_dump($this->errors));
			//return false;
		}
		if($file['error'][$i] != 0){
			$this->errors[] = $this->uploaded_errors[$file['error'][$i]];
			//die("attached error" .var_dump( $this->errors));
			//return false;
		}
		if(!in_array($file['type'][$i], $allowed_types)){
			$this->errors[]="Please upload an image";
			//die("allowed types error" . var_dump($this->errors));
			//return false;
		}
		else {
			if($file['type'][$i] == "image/png"){
				$this->ext = ".png";
			}
			elseif($file['type'][$i] == "image/jpg"){
				$this->ext = ".jpg";
			}
			elseif($file['type'][$i] == "image/jpeg"){
				$this->ext= ".jpg";
			}
			elseif($file['type'][$i] == "image/gif"){
				$this->ext=".gif";
			}
			elseif($file['type'][$i] == "image/bmp"){
				$this->ext=".bmp";
			}
			$this->filename = $file['name'][$i];
			$this->type = $file['type'][$i];
			$this->temp_path = $file['tmp_name'][$i];
			$this->size = $file['size'][$i];
			return true;
		}
	}

	public function save_file($supp_name, $photo_name) {
		$this->filename = $photo_name.$this->ext;
		if(!empty($this->errors)) { $_SESSION["message"] = $this->errors; return false; }
		if(!file_exists(SITE_ROOT . DS . $this->directory .DS. $supp_name)){
			mkdir(SITE_ROOT . DS .DS. $this->directory .DS. $supp_name);
		}

		$target_path = SITE_ROOT . DS . $this->directory .DS. $supp_name . DS . $this->filename;
		if(file_exists($target_path)){
			//change somethingmore for date
			$this->filename = "somethingmore" .$this->filename ;
			$target_path = SITE_ROOT .DS. $this->directory .DS. $supp_name . DS . $this->filename;

		}
		if(move_uploaded_file($this->temp_path, $target_path)){
			global $Database;
			$sql = "INSERT INTO photos(filename,type,size,abs_path) VALUES('";
			$sql .= $this->filename ."','" .$this->type. "','" .$this->size. "','";
			$sql .=  $target_path . "')";
			exec_query($sql);
			unset($this->temp_path);
			return $this->filename;
		}
	}
}
$Photo = new Photograph();
?>
