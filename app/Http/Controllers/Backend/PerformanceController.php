<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PerformanceController extends Controller
{
    public function index(Request $request){
       # dd('Hello');
        $user = DB::table('user')->where(['user_name'=>$request->user_name,'role_type'=>$request->role_type,'token'=>$request->token])->count();
        if($user == 1){
            
            $arr = array();
            $source = $request->centerid;
            $vendor = $request->vendor;;
            //$from = $_POST['from'];
            $from =  date("Y-m-d");
            //$from = date("Y-m-d H:i:s", strtotime($from));
            //$to = $_POST['to'];
            $to = date("Y-m-d");
            //$to = date("Y-m-d H:i:s", strtotime($to));
            $user_name = $request->centerid;
           
            
         $whereClauses = array(); 
                $whereClauses1 = array(); 
                $whereClauses2 = array(); 
                $whereClauses4 = array(); 
                $whereClauses6 = array(); 
              if (! empty($source) )
              { 
              if($source == 'nbcp')
              {
              $whereClauses[] ="avr_employee != ''";
              }
            else
            {
            
              $whereClauses[] ="lead_create_multi.r_employee = '".$source."'";
              
              $whereClauses2[] ="w3techerp_customer.av_lemployee LIKE '%".$source."%'";
              $whereClauses4[] ="allstage.sm LIKE '%".$source."%'";
              $whereClauses6[] ="ibp.sm LIKE '%".$source."%'";
             
            }		
          }     
          
          $whereClauses4[] ="allstage.status = 'Y'";
         
          if (! empty($vendor)) 
                    $whereClauses[] ="vendor LIKE '%".$vendor."%'";
        
                    
                $where = ' where  lead_create_multi.r_employee=headcenter.id AND headcenter.status="Active"  AND headcenter.role ="DST"  '; 
        
                $where1 = '';

                $where2 = ' where  w3techerp_customer.av_remployee=headcenter.id AND headcenter.status="Active"  AND headcenter.role ="DST"  '; 
        
                $where4 = ' where  allstage.cpsm=headcenter.id AND headcenter.status="Active"  AND headcenter.role ="DST"  '; 
        
                $where6 = ' where  ibp.sm=headcenter.id AND headcenter.status="Active"  AND headcenter.role ="DST"  '; 
        
        
                if (count($whereClauses) > 0) 
                { 
                  $where = ' '.$where.'  AND  '.implode(' AND ',$whereClauses); 
                 // $where2 = ' '.$where2.'  AND  '.implode(' AND ',$whereClauses);
                  $where1 = ' '.$where1.'  AND  '.implode(' AND ',$whereClauses); 
                } 
             
                if (count($whereClauses2) > 0) 
                { 
                  $where2 = ' '.$where2.'  AND  '.implode(' AND ',$whereClauses2); 
                  $where1 = ' '.$where1.'  AND  '.implode(' AND ',$whereClauses1); 
                } 
                if (count($whereClauses4) > 0) 
                { 
                  $where4 = ' '.$where4.'  AND  '.implode(' AND ',$whereClauses4); 
                  $where1 = ' '.$where1.'  AND  '.implode(' AND ',$whereClauses1); 
                } 
                if (count($whereClauses6) > 0) 
                { 
                  $where6 = ' '.$where6.'  AND  '.implode(' AND ',$whereClauses6); 
                  $where1 = ' '.$where1.'  AND  '.implode(' AND ',$whereClauses1); 
                } 
        
        
        
                if (count($whereClauses1) > 0) 
                { 
                  $where = ' '.$where.'  AND  '.implode(' AND ',$whereClauses1); 
                  $where2 = ' '.$where2.'  AND  '.implode(' AND ',$whereClauses1); 
                  $where1 = ' '.$where1.'  AND  '.implode(' AND ',$whereClauses1); 
                  $where4 = ' '.$where4.'  AND  '.implode(' AND ',$whereClauses4); 
                  $where6 = ' '.$where6.'  AND  '.implode(' AND ',$whereClauses6); 
              
                } 
             
                $from =    $request->from;
                $date12 =  $request->from;
                 
                  if($from == '' )
                {
                  $from = date('Y-m-d');
                  $date12 = date('Y-m-d'); 
                }
                $datt=date("Y-m-d",strtotime($from));
                $frodate = explode('-', $datt);
                $fmonth = $frodate[1];
                $fday   = $frodate[2];
                $fyear  = $frodate[0];
                
                $fqtddatemo = ''.$fyear.'-'.$fmonth.'-01';
                $tqtddatemo = ''.$fyear.'-'.$fmonth.'-31';
                
                
        $datt=date("Y-m-d",strtotime($date12));
        $frodate = explode('-', $datt);
        $fmonth = $frodate[1];
        $fday   = $frodate[2];
        $fyear  = $frodate[0];
        
        $fqtddatemo = ''.$fyear.'-'.$fmonth.'-01';
        $fqtddatemo = date('Y-m-d',strtotime( $fqtddatemo));
        $tqtddatemo = ''.$fyear.'-'.$fmonth.'-31';
        $tqtddatemo = date('Y-m-t',strtotime( $date12));
        
        
        $dattt=date("Y-m-d",strtotime($date12));
        $tfrodate = explode('-', $dattt);
        $tfmonth = $tfrodate[1];
        $tfday   = $tfrodate[2];
        $tfyear  = $tfrodate[0];
        
        
        if($fmonth == '4' OR $fmonth == '5' OR $fmonth == '6')
        {
        
        $ffyear	= $fyear;
        $tfyear	= $fyear;
        
        $ffmonth = 4;
        $tfmonth = 6;
        
        $ffyear1	= $fyear;
        $tfyear1	= $fyear;
        
        $ffmonth1 = 4;
        $tfmonth1 = 9;
        
        $ffyear2	= $fyear;
        $tfyear2	= $fyear+1;
        
        $ffmonth2 = 4;
        $tfmonth2 = 3;
        }
        
        
        if($fmonth == '7' OR $fmonth == '8' OR $fmonth == '9')
        {
        
        $ffyear	= $fyear;
        $tfyear	= $fyear;
        
        $ffmonth = 7;
        $tfmonth = 9;
        
        $ffyear1	= $fyear;
        $tfyear1	= $fyear;
        
        $ffmonth1 = 4;
        $tfmonth1 = 9;
        
        $ffyear2	= $fyear;
        $tfyear2	= $fyear+1;
        
        $ffmonth2 = 4;
        $tfmonth2 = 3;
        }
        
        
        if($fmonth == '10' OR $fmonth == '11' OR $fmonth == '12')
        {
        
        $ffyear	= $fyear;
        $tfyear	= $fyear;
        
        $ffmonth = 10;
        $tfmonth = 12;
        
        $ffyear1	= $fyear;
        $tfyear1	= $fyear+1;
        
        $ffmonth1 = 10;
        $tfmonth1 = 3;
        
        $ffyear2	= $fyear;
        $tfyear2	= $fyear+1;
        
        $ffmonth2 = 4;
        $tfmonth2 = 3;
        
        }
        
        
        if($fmonth == '1' OR $fmonth == '2' OR $fmonth == '3')
        {
        
        $ffyear	= $fyear;
        $tfyear	= $fyear;
        
        $ffmonth = 1;
        $tfmonth = 3;
        
        
        $ffyear1	= $fyear - 1;
        $tfyear1	= $fyear;
        
        $ffmonth1 = 10;
        $tfmonth1 = 3;
        
        $ffyear2	= $fyear - 1;
        $tfyear2	= $fyear;
        
        $ffmonth2 = 4;
        $tfmonth2 = 3;
        
        }
        $fqtddate = ''.$ffyear.'-'.$ffmonth.'-01';
        $fqtddate = date('Y-m-d',strtotime( $fqtddate));
        $tqtddate = ''.$tfyear.'-'.$tfmonth.'-20';
        $tqtddate = date('Y-m-t',strtotime( $tqtddate));
        
        $fqtddate1 = ''.$ffyear1.'-'.$ffmonth1.'-01';
        $fqtddate1 = date('Y-m-d',strtotime( $fqtddate1));
        
        $tqtddate1 = ''.$tfyear1.'-'.$tfmonth1.'-21';
        $tqtddate1 = date('Y-m-t',strtotime( $tqtddate1));
        
        $fqtddate2 = ''.$ffyear2.'-04-01';
        $tqtddate2 = ''.$tfyear2.'-03-31';
        
        $day_from_till = "1970-01-01";
        $day_to_till = date('Y-m-d');

        $leadsassigned1 = array();
        $selfleadsassigned1 = array();


      #Started Lead Assigned   
$tla_presales1 = DB::select("select count(*) as tla from lead_create_multi,headcenter ".$where."  AND DATE_FORMAT(lead_create_multi.l_pc_multi, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");

$mla_presales1 = DB::select("select count(*) as mla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.l_pc_multi between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 
$qla_presales1 = DB::select("select count(*) as qla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.l_pc_multi between '".$fqtddate."' AND  '".$tqtddate."'");
$leadsassigned1['qla_presales1'] = (count($qla_presales1) > 0 ) ? $qla_presales1[0]:'';
   
$hla_presales1 = DB::select("select count(*) as hla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.l_pc_multi between '".$fqtddate1."' AND  '".$tqtddate1."'");
$leadsassigned1['hla_presales1'] = (count($hla_presales1) > 0 ) ? $hla_presales1[0]:'';
   
$till_presales1 = DB::select("select count(*) as till from lead_create_multi,headcenter ".$where."  AND DATE_FORMAT(lead_create_multi.l_pc_multi, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
$leadsassigned1['till_presales1'] = (count($till_presales1) > 0 ) ? $till_presales1[0]:'';
 #Ended Lead Assigned   
   
     
 #Started Self Lead Assigned   
$stla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.source = 'Self'  AND DATE_FORMAT(lead_create_multi.l_pc_multi, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
$selfleadsassigned1['stla_presales1'] = (count($stla_presales1) > 0 ) ? $stla_presales1[0]:'';
   
$smla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.source = 'Self'  AND lead_create_multi.l_pc_multi between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
$selfleadsassigned1['smla_presales1'] = (count($smla_presales1) > 0 ) ? $smla_presales1[0]:'';
   
$sqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.source = 'Self'   AND lead_create_multi.l_pc_multi between '".$fqtddate."' AND  '".$tqtddate."'");
$selfleadsassigned1['sqla_presales1'] = (count($sqla_presales1) > 0 ) ? $sqla_presales1[0]:'';
   
$shla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where." AND lead_create_multi.source = 'Self'   AND lead_create_multi.l_pc_multi between '".$fqtddate1."' AND  '".$tqtddate1."'");
$selfleadsassigned1['shla_presales1'] = (count($shla_presales1) > 0 ) ? $shla_presales1[0]:'';
   
$syla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where." AND lead_create_multi.source = 'Self'   AND lead_create_multi.l_pc_multi between '".$fqtddate2."' AND  '".$tqtddate2."'");
$selfleadsassigned1['syla_presales1'] = (count($syla_presales1) > 0 ) ? $syla_presales1[0]:'';
   
$still_presales1 = DB::select("select count(*) as still from lead_create_multi,headcenter ".$where." AND lead_create_multi.source = 'Self'   AND DATE_FORMAT(lead_create_multi.l_pc_multi, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
$selfleadsassigned1['still_presales1'] = (count($still_presales1) > 0 ) ? $still_presales1[0]:'';
 #Ended Self Lead Assigned   

     
 #Started Lead PipeLine Lead Assigned   
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $leadpipeline1['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $leadpipeline1['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $leadpipeline1['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $leadpipeline1['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $leadpipeline1['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $leadpipeline1['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended PipeLine Assigned   
 


 #Started Lead Lost 
 $ltla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Lost') AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $lostlead1['ptla_presales1'] = (count($ltla_presales1) > 0 ) ? $ltla_presales1[0]:'';
    
 $lmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Lost')  AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $lostlead1['pmla_presales1'] = (count($lmla_presales1) > 0 ) ? $lmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $lostlead1['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $lostlead1['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $lostlead1['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $lostlead1['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Lost Lead Assigned   
 

 #Started Site Visit Done 
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $sitevisitdone1['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $sitevisitdone1['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $sitevisitdone1['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $sitevisitdone1['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $sitevisitdone1['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $sitevisitdone1['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Site Visit Done   
 

 #Started Site ReVisit 1 Done   
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $resitevisitdone11['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $resitevisitdone11['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $resitevisitdone11['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $resitevisitdone11['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $resitevisitdone11['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $resitevisitdone11['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Site ReVisit 1 Done      
 
 #Started Site ReVisit 2 Done   
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $resitevisitdone22['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $resitevisitdone22['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $resitevisitdone22['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $resitevisitdone22['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $resitevisitdone22['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $resitevisitdone22['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Site ReVisit 2 Done      
 

 #Started Site ReVisit 3 Done   
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $resitevisitdone33['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $resitevisitdone33['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $resitevisitdone33['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $resitevisitdone33['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $resitevisitdone33['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $resitevisitdone33['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Site ReVisit 3 Done      
 
 #Started Site totlal Visit  
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $totalvisitdone1['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $totalvisitdone1['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $totalvisitdone1['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $totalvisitdone1['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $totalvisitdone1['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $totalvisitdone1['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Site totlal Visit      
 
 #Started Site Sale Done   
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $saledone1['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $saledone1['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $saledone1['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $saledone1['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $saledone1['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $saledone1['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Site Sale Done      
 

 #Started Site Conversion Ratio       
 $ptla_presales1 = DB::select("select count(*) as stla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')  AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$date12."', '%Y-%m-%d') and DATE_FORMAT('".$date12."', '%Y-%m-%d')");
 $conversionratio1['ptla_presales1'] = (count($ptla_presales1) > 0 ) ? $ptla_presales1[0]:'';
    
 $pmla_presales1 = DB::select("select count(*) as smla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddatemo."' AND  '".$tqtddatemo."'");
 $conversionratio1['pmla_presales1'] = (count($pmla_presales1) > 0 ) ? $pmla_presales1[0]:'';
    
 $pqla_presales1 = DB::select("select count(*) as sqla from lead_create_multi,headcenter ".$where." AND lead_create_multi.ctype in ('Hot','Warm','Cold')   AND lead_create_multi.active_date between '".$fqtddate."' AND  '".$tqtddate."'");
 $conversionratio1['pqla_presales1'] = (count($pqla_presales1) > 0 ) ? $pqla_presales1[0]:'';
    
 $phla_presales1 = DB::select("select count(*) as shla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND lead_create_multi.active_date between '".$fqtddate1."' AND  '".$tqtddate1."'");
 $conversionratio1['phla_presales1'] = (count($phla_presales1) > 0 ) ? $phla_presales1[0]:'';
    
 $pyla_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')     AND lead_create_multi.active_date between '".$fqtddate2."' AND  '".$tqtddate2."'");
 $conversionratio1['pyla_presales1'] = (count($pyla_presales1) > 0 ) ? $pyla_presales1[0]:'';
    
 $ptill_presales1 = DB::select("select count(*) as syla from lead_create_multi,headcenter ".$where."  AND lead_create_multi.ctype in ('Hot','Warm','Cold')    AND DATE_FORMAT(lead_create_multi.active_date, '%Y-%m-%d') between DATE_FORMAT('".$day_from_till."', '%Y-%m-%d') and DATE_FORMAT('".$day_to_till."', '%Y-%m-%d')");
 $conversionratio1['ptill_presales1'] = (count($ptill_presales1) > 0 ) ? $ptill_presales1[0]:'';
  #Ended Site Conversion Ratio     
 
$arr_1['Leads Assigned'] = array(['Today'=>$ptla_presales1,'FTM'=>$ptill_presales1]);
$arr_1['Self Leads Created'] = array(['Today'=>$ptla_presales1,'FTM'=>$ptill_presales1]);




//Completed till pipelining 




           return response(['status'=>200,'msg'=>['Dashboard Success'],'leadsassigned'=>$arr_1,'selfleadassigned'=>$selfleadsassigned1,'leadpipeline'=>$leadpipeline1,'lostlead'=>$lostlead1,'sitevisitdone'=>$sitevisitdone1,'resitevisitdone1'=>$resitevisitdone11,'resitevisitdone2'=>$resitevisitdone22,'resitevisitdone3'=>$resitevisitdone33,'totalvisitdone'=>$totalvisitdone1,'saledone'=>$saledone1,'conversionratio'=>$conversionratio1]);
            
        }
        else{
            return response(['status'=>404,'msg'=>['User not login']]);
        }
                

    }
}
