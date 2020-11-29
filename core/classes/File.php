<?php


namespace Core\Classes;


class File implements iFile
{
	private string $name;
	private string $file;
	private string $fullPath;
	private string $dir;
	private string $ext;
	private string $fileSize;
	private $text;

	public function __construct($filePath)
	{
		$this->file = $filePath;


	}
	public function getPath()
	{
		$p = realpath($this->file);
		$p = explode('\\',$p);
		$this->fullPath = implode('/',$p);
	}

	public function getDir()
	{
		$p = realpath($this->file);
		$arr = explode('\\',$p);
		$this->dir = $arr[count($arr)-2];

	}
	public function getName()
	{
		$arrN = explode('/',$this->file);
		$c = count($arrN);
		$this->name = $arrN[$c-1];
	}

	public function getExt()
	{
		if(strstr($this->name,'.')){
			$e  = explode('.',$this->name);
			if(count($e) === 1){
				$this->ext = '.'.$e[0];
			}
			else{
				$this->ext = '.'.$e[1];
			}
		}
		else{
			$this->ext = "folder";
		}
	}

	public function getSize()
	{
		$this->fileSize = filesize($this->file);
	}

	public function getText()
	{
		if(is_dir($this->file)){
			$n = scandir ($this->file);
			$this->text = array_diff($n,array('.','..'));
		}
		else{
			$this -> text = file_get_contents($this -> file);
		}
	}

	public function setText($text)
	{
		$arrFileExt = ['.txt','.text','.sub','.log'];
		foreach ($arrFileExt as $val){
			if($this -> ext === $val){
				$this->text = $text;
				file_put_contents($this->file,$this->text);
			}
		}
	}

	public function appendText($text)
	{
		$arrFileExt = ['.txt','.text','.sub','.log'];
		foreach ($arrFileExt as $val){
			if($this -> ext === $val){
				$this->text .= $text;
				file_put_contents($this->file,$this->text);
			}
		}
	}

	public function copy($copyPath)
	{
		if(is_dir($copyPath) && !is_dir($this -> name)){
			fopen($copyPath . '/' . $this -> name, 'ab+');
			copy($this -> file, $copyPath . '/' . $this -> name);
		}else{
			echo $this -> name . ' '.'This is a folder';
		}
	}

	public function delete()
	{
		if(!is_dir($this->file)){
			unlink($this->file);
		}
		else{
			echo $this->file .' '.'Folder';
		}
	}

	public function rename($newName)
	{
		rename($this->fullPath,'core/classes/'.$newName.$this->ext);
	}

	public function replace($newPath)
	{
		if(is_dir($newPath) && !is_dir($this -> name)){
			fopen($newPath . '/' . $this -> name, 'ab+');
			copy($this -> file, $newPath . '/' . $this -> name);
		}else{
			echo $this -> name . ' '.'This is a folder';
		}
		unlink($this -> file);
	}
}