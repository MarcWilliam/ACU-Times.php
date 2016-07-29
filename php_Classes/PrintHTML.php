<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrintHTML
 *
 * @author marcw
 */
class PrintHTML {

	private function __construct() {
		
	}

//================================================OPTION===================================================
	static public function numericOption($start, $end, $selected = 0) {
		for ($i = $start; $i >= $end; $i--) {
			($selected == $i) ? $temp = "selected" : $temp = "";
			echo "<option value='{$i}' {$temp}>{$i}</option>";
		}
		for ($i = $start; $i <= $end; $i++) {
			($selected == $i) ? $temp = "selected" : $temp = "";
			echo "<option value='{$i}' {$temp}>{$i}</option>";
		}
	}

	static public function numericOptionMonth($selected = 0) {
		$MonthName = array("", "January", "February", "March", "April", "May", "June", "Jully", "August", "September", "October", "November", "December");
		for ($i = 1; $i <= 12; $i++) {
			($selected == ($i)) ? $temp = "selected" : $temp = "";
			echo "<option value='{$i}' {$temp}>{$MonthName[$i]}</option>";
		}
	}

	static public function OptionGender($selected = 0) {
		$Genders = array(
			"Leave Empty" => User::GENDER_NOTSET,
			"Male" => User::GENDER_MALE,
			"Female" => User::GENDER_FEMALE,
		);
		foreach ($Genders as $key => $value) {
			($selected == ($value)) ? $temp = "selected" : $temp = "";
			echo "<option value='{$value}' {$temp}>{$key}</option>";
		}
	}

//=================================================ALERT===================================================
	const ALERT_WARNING = " alert-warning ";
	const ALERT_DANGER = " alert-danger ";
	const ALERT_INFO = " alert-info ";
	const ALERT_SUCCESS = " alert-success ";

	static public function alert_dismissible($text, $type) {
		echo
		'<div class="alert ' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
		. $text .
		'</div>';
	}

	static public function validation($ID, $isTrue, $text) {
		if (isset($isTrue) && !$isTrue) {
			echo'<li id="' . $ID . '">' . $text . '</li>';
		}
	}

//============================================PORTOFOLIO===================================================


	static public function portofolio_12row_next_large($title, $link, $description, $time, $img) {
		echo
		'<div class="row">
				<div class="col-md-7"> <a href="' . $link . '"> <img class="img-responsive img-rounded img-hover" src="' . $img . '"> </a> </div>
				<div class="col-md-5">
					<a href="' . $link . '"><h2>' . $title . '</h2></a>
					<h5> ' . $time . ' <span class="glyphicon glyphicon-time"></span></h5>
					<p>' . $description . '</p>
				</div>
			</div>
			<hr>';
	}

	static public function portofolio_12row_next_normal($title, $link, $description, $time, $img) {
		echo
		'<div class="row">
					<div class="col-md-3"> <a href="' . $link . '"> <img class="img-responsive img-rounded img-hover" src="' . $img . '"> </a> </div>
					<div class="col-md-9">
						<a href="' . $link . '"><h3>' . $title . '</h3></a>
						<h5> ' . $time . ' <span class="glyphicon glyphicon-time"></span></h5>
						<p>' . $description . '</p>
					</div>
				</div>
				<hr>';
	}

	static public function portofolio_8row_under_large($title, $link, $description, $time, $img) {
		echo
		'<div class="col-md-8 img-portfolio"> 
			<a href="' . $link . '"> <img class="img-responsive img-rounded img-hover" src="' . $img . '"> </a> 
			<a href="' . $link . '"><h3>' . $title . '</h3></a>
			<h5> ' . $time . ' <span class="glyphicon glyphicon-time"></span></h5>
			<p>' . $description . '</p>
		</div>';
	}

	static public function portofolio_4row_under_small($title, $link, $description, $time, $img) {
		echo
		'<div class="col-md-4 img-portfolio"> 
			<a href="' . $link . '"> <img class="img-responsive img-rounded img-hover" src="' . $img . '"> </a> 
			<a href="' . $link . '"><h3>' . $title . '</h3></a>
			<h5> ' . $time . ' <span class="glyphicon glyphicon-time"></span></h5>
			<p>' . $description . '</p>
		</div>';
	}

//============================================User===================================================

	static public function Member($ID, $name, $Email, $isAdmin, $IMG) {
		$MakeAdmin = "";
		if (!$isAdmin) {
			$MakeAdmin = '<li><a href="#"><i class="fa fa-user"></i> Make Admin</a></li>';
		}
		return '<hr>
			<div class="container">
				<div class=" col-xs-10">
					<div class="col-sm-2 text-center"><a href="Profile.php?ID=' . $ID . '"><img src="' . $IMG . '" class="mg-80x80 img-circle"></a></div>
					<div class="col-sm-10">
						<h4><a href="Profile.php?ID=' . $ID . '">' . $name . '</a><br>
							<small>' . $ID . '<br>' . $Email . '</small></h4>
					</div>
				</div>
				<div class="dropdown col-xs-2">
					<button class="btn-setting btn btn-default " data-toggle="dropdown" aria-haspopup="true" > <i class="fa fa-bars" aria-hidden="true"></i> </button>
					<ul class="dropdown-menu" aria-labelledby="dLabel">
						' . $MakeAdmin . '
						<li><a  href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
						<li><a  href="#"><i class="fa fa-key" aria-hidden="true"></i> Reset PW</a></li>
					</ul>
				</div>
			</div>';
	}

}
