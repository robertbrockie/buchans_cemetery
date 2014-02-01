<?php

class CemeterySite {

	private $id = 0;
	private $row = '';
	private $plot = '';
	private $name = '';
	private $note = '';
	private $thumbnail_image = '';
	private $full_image = '';

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getRow() {
		return $this->row;
	}

	public function setRow($value) {
		$this->row = $value;
	}

	public function getPlot() {
		return $this->plot;
	}

	public function setPlot($value) {
		$this->plot = $value;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
	}

	public function getNote() {
		return $this->note;
	}

	public function setNote($value) {
		$this->note = $value;
	}

	public function getThumbnailImage() {
		return $this->thumbnail_image;
	}

	public function setThumbnailImage($value) {
		$this->thumbnail_image = $value;
	}

	public function getFullImage() {
		return $this->full_image;
	}

	public function setFullImage($value) {
		$this->full_image = $value;
	}
}