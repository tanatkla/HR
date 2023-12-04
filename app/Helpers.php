<?php

namespace App\Helpers;
use App\Models\Employees;

class Helper {

    public static function helperfunction1(){
        return "helper function 1 response";
    }

    // public static function getEmployeeStatus($id=0){
    //     $record = Employees::find($id);

    //     return $record->status;
    // }
    public static function DateThai($strDate)
	{
		$strYear = date("y",strtotime($strDate))+43;
		// $strYear = date("y",strtotime($strDate));
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear ($strHour:$strMinute น.)";
	}

	public static function DateThaiFull($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		// $strYear = date("y",strtotime($strDate));
		$strMonth= date("n",strtotime($strDate));
		// $strMonth= 0;
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMonthCut = Array("ธันวาคม","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม", "พฤศจิกายน");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai พ.ศ. $strYear";
	}

	public static function DateThaiNoTime($strDate)
	{
		$strYear = date("y",strtotime($strDate))+43;
		// $strYear = date("y",strtotime($strDate));
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

	public static function Time($strDate)
	{
		// $strYear = date("y",strtotime($strDate))+43;
		// // $strYear = date("y",strtotime($strDate));
		// $strMonth= date("n",strtotime($strDate));
		// $strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		// $strSeconds= date("s",strtotime($strDate));
		// $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		// $strMonthThai=$strMonthCut[$strMonth];
		return "$strHour:$strMinute น.";
	}

}