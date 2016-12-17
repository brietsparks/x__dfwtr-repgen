<?php namespace App;

use App\Scraper\PdfScraper;

class Service {

	protected $inputFile;

	protected $outputFile;


	/**
	 * @var array
	 */
	protected $articles;

	public function __construct($inputFile) {
		$this->inputFile = $inputFile;
	}

	public static function make($inputFile) {
		return new static($inputFile);
	}


	public function generate() {
		$this->extract();
		$this->createArticles();
		$this->createTextFiles();
		$this->archive();
		$this->send();
		$this->cleanup('output');
		$this->cleanup('pdf');
	}

	protected function extract() {
		$zip = new \ZipArchive();
		$zip->open($this->inputFile['tmp_name']);
		$zip->extractTo('pdf');
	}

	/**
	 * @return array
	 */
	protected function createArticles() {
		$dir = new \DirectoryIterator('pdf');
		$articles = array();
		foreach($dir as $fileinfo) {
			if($fileinfo->isFile()) {
				if($fileinfo->getExtension() === 'pdf') {
					foreach($this->scrapedCities($fileinfo->getRealPath()) as $city) {
						$article = ArticlesGenerator::make($city);
						$city = $article->city->name;
						$month = $article->city->getMonthReport()->getCurrentYear()->month;
						$year = $article->city->getMonthReport()->getCurrentYear()->year;

						$filename = $city . "_" . $year . "_" . $month;
						$articles[$filename] = $article->generate();
					}
				}
			}
		}
		$this->articles = $articles;
		return $articles;
	}

	/**
	 * @param $filepath
	 * @return array
	 */
	protected function scrapedCities($filepath) {
		return PdfScraper::make($filepath)->extract();
	}

	protected function createTextFiles() {
		foreach((array) $this->articles as $filename => $text) {
			$filename = str_replace('/','', $filename);
			$filename = str_replace(' ','', $filename);
			$this->createSingleTextFile($filename, $text);
		}
	}

	protected function createSingleTextFile($filename, $text) {
		$filepath = "output/{$filename}.txt";
		$handle = fopen("$filepath", 'w') or die('Cannot open file:  output/'. $filepath);
		fwrite($handle, $text);
	}

	protected function archive() {
		$zip = new \ZipArchive();
		$archiveName = "Articles_" . date("Y-m-d_his") .".zip";
		$this->outputFile = $archiveName;
		if($zip->open("output/$archiveName", \ZipArchive::CREATE) === true){
			$dir = new \DirectoryIterator('output');
			foreach($dir as $fileinfo) {
				if ($fileinfo->isFile()) {
					if ($fileinfo->getExtension() === 'txt') {
						$zip->addFile("output/" . $fileinfo->getBasename());
					}
				}
			}
			$zip->close();
		} else {
			dd("Error compressing file archive");
		}
	}

	protected function send() {
		$file = $this->outputFile;

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"".$file."\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".filesize('output/'.$file));
		ob_end_flush();
		@readfile('output/'.$file);
	}

	protected function cleanup($folder) {
		$files = glob("$folder/*"); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file))
				unlink($file); // delete file
		}
	}
}