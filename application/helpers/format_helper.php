<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('rupiah_format')) {
	function rupiah_format($number) {
		return "Rp. " . number_format($number, 0, ',', '.');
	}
}

if ( ! function_exists('generate_invoice')) {
	function generate_invoice($id) {
		return "INV/" . $date = date('Y/m/d') . '/' . $id;
	}
}
