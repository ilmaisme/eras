<?php
namespace Erasoft\Libraries;

class CustomLib {

    public static function generate_notification($params,$type)
    {
        if($type == "error")
        {
            $view = view('_partials.error_notification')->with('error',$params)->render();     
        }
        elseif($type == "success")
        {
            $view = view('_partials.success_notification')->with('success',$params)->render();
        }
        
        return $view;
    }

    public static function gen_type()
    {
    	$type = ["pm"=>"Project Manager","support"=>"Support"];
    	return $type;
    }

    public static function time_ago($time)
    {
        $estimate_time = time() - $time;

        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }

        $condition = array(
                    12 * 30 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;

            if( $d >= 1 )
            {
                $r = round( $d );
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }

    public static function gen_status_tiket($status){
        $result = "";
        switch($status){
            case 'open' :
                $result = '<span class="label label-info arrowed-in-right arrowed">'.ucfirst($status).'</span>';
                break;
            case 'process':
                $result = '<span class="label label-warning arrowed">'.ucfirst($status).'</span>';
                break;
            case 'finish':
                $result = '<span class="label label-success arrowed">'.ucfirst($status).'</span>';
                break;
            case 'cancelled':
                $result = '<span class="label label-danger arrowed">'.ucfirst($status).'</span>';
                break;
        }

        return $result;
    }

    public static function gen_status_t($status){
        $result = "";
        switch($status){
            case 'waiting' :
                $result = '<span class="label label-warning arrowed-in-right arrowed">'.ucfirst($status).'</span>';
                break;
            case 'approved':
                $result = '<span class="label label-success arrowed">'.ucfirst($status).'</span>';
                break;
           
        }

        return $result;
    }

    public static function gen_tanggal($date,$format="d F Y H:i:s"){
        $time = strtotime($date);
        return date($format,$time);
    }

    public static function gen_bulan($bulan){
        $res = "";
        switch ($bulan) {
            case '1':
                # code...
                $res = "Januari";
                break;
            case '2':
                $res = "Februari";
                break;
            case '3':
                $res = "Maret";
                break;
            case '4':
                $res = "April";
                break;
            case '5':
                $res = 'Mei';
                break;
            case '6':
                $res = "Juni";
                break;
            case '7':
                $res = "Juli";
                break;
            case '8' :
                $res = "Agustus";
                break;
            case '9':
                $res = "September";
                break;
            case '10':
                $res = "Oktober";
                break;
            case '11':
                $res = "November";
                break;
            case '12':
                $res = "Desember";
                break;      
            
            default:
                # code...
                break;
        }

        return $res;
    }
  
}