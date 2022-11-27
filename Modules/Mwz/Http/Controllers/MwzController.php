<?php

namespace Modules\Mwz\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Mwz\Entities\Districts ;

class MwzController extends Controller
{
    public static function flat_categories($categories)
    {
        $traverse = function ($categories, $prefix = '-',$level=0, &$result=[]) use (&$traverse) {
            foreach ($categories as  $category) {
                $category->level = $level ; 

                if($level>0){
                    $show_prefix = str_pad('',$level,$prefix); 
                    $category->name =  $show_prefix.' '.$category->name;
                }
                if(!empty($category->children)){
                    $new_category = $category ;
                    unset($new_category->children) ;
                    $result[$category->id] = $new_category ;
                    $traverse($category->children,'-',$level+1,$result);
                }else{
                    $result[$category->id] = $category ;
                }
            }
            return $result ;
        };

        return $traverse ;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getProvince($type)
    {   

        $province = Provinces::all();
        switch($type){
            case "select2";
                $data = [];
                foreach($province as $p){
                    $data[] = ['id'=>$p->id,'text'=>$p->name_th] ;
                }
                $province = json_encode($data,JSON_UNESCAPED_UNICODE);
            break;
        }

        return $province ;
    }

    public function getCity($type,$province_id)
    {
        $Cities = Cities::where('province_id', $province_id)->get();

         switch($type){
            case "select2";
                $data = [];
                foreach($Cities as $c){
                    $data[] = ['id'=>$c->id,'text'=>$c->name_th] ;
                }
                $Cities = json_encode($data,JSON_UNESCAPED_UNICODE);
            break;
        }

        return $Cities ;
    }

    public function getCityFull($type,$province_id)
    {
        $Cities = Cities::with('province')->where('province_id', $province_id)->get();
        return $Cities ;
    }

    public function getDistrict($type,$city_id)
    {
        $Districts = Districts::where('city_id', $city_id)->get();

        switch($type){
            case "select2";
                $data = [];
                foreach($Districts as $d){
                    $data[] = ['id'=>$d->id,'text'=>$d->name_th] ;
                }
                $Districts = json_encode($data,JSON_UNESCAPED_UNICODE);
            break;
        }

        return $Districts ;
    }

    public function getDistrictFull($type,$city_id)
    {
        $Districts = Districts::with('province')->with('city')->where('city_id', $city_id)->get();
        return $Districts ;
    }

    public function getAddressByZipcode($type,$zip_code)
    {
        $Districts = Districts::with('province')->with('city')->where('zip_code', $zip_code)->get();

        // print_r($Districts->count());

        if($Districts->count()>0){

            switch($type){
                case "select2";
                    $addr=[];
                    foreach($Districts as $d){
                        $addr['province'][$d->province->id] = $d->province ;
                        $addr['city'][$d->city->id] = $d->city ;
                        $addr['district'][$d->id] = $d ;
                    }

                    $province = [];
                    foreach($addr['province'] as $p){
                        if(app()->getLocale() == '' || app()->getLocale() == 'th'){
                            $province[] = ['id'=>$p->id,'text'=>$p->name_th] ;
                        }else{
                            $province[] = ['id'=>$p->id,'text'=>$p->name_en] ;
                        }
                
                    } 

                    $city = [];
                    foreach($addr['city'] as $c){
                        if(app()->getLocale() == '' || app()->getLocale() == 'th'){
                            $city[$c->province_id][] = ['id'=>$c->id,'text'=>$c->name_th] ;
                        }else{
                            $city[$c->province_id][] = ['id'=>$c->id,'text'=>$c->name_en] ;
                        }
                    } 

                    $district = [];
                    foreach($addr['district'] as $d){
                        if(app()->getLocale() == '' || app()->getLocale() == 'th'){
                            $district[$d->city_id][] = ['id'=>$d->id,'text'=>$d->name_th] ;
                        }else{
                            $district[$d->city_id][] = ['id'=>$d->id,'text'=>$d->name_en] ;
                        }
                    }

                    $data['province'] = $province;
                    $data['city'] = $city;
                    $data['district'] = $district;

                    $resp = json_encode(['success'=>1,'address'=>$data],JSON_UNESCAPED_UNICODE);
                break;
            }

            return $resp ;

        }else{
          return json_encode(['success'=>0,'msg'=>'ไม่มีรหัสไปรษณีย์นี้']);  
        }
    }

    public function printAddressFormZipCode($address){

        $province_option = '';
        $city_option = '';
        $district_option = '';
        $zip_code='';

        if(!empty($address)){
            $addr = $this->getAddressByZipcode($address->zip_code) ;
            $province = $addr->province ;
            $city = $addr->city ;
            $district = $addr->district ;
            $zip_code = (!empty($address['zip_code']))?$address['zip_code'] :'' ;
            
            foreach(!$province as $p){
                $selected = (isset($address['province'])&&$p->province_id==$address['province'])?'selected="selected"':'';
                $province_option .= '<option '.$selected.' value="'.$p->province_id.'">'.$p->name_th.'</option>' ;
            }

           
            foreach(!$city as $c){
                $selected = (isset($address['city'])&&$c->city_id==$address['city'])?'selected="selected"':'';
                $city_option .= '<option '.$selected.' value="'.$c->city_id.'">'.$c->name_th.'</option>' ;
            }

            
            foreach(!$district as $d){
                $selected = (isset($address['district'])&&$d->district_id==$address['district'])?'selected="selected"':'';
                $district_option .= '<option '.$selected.' value="'.$d->district_id.'">'.$p->name_th.'</option>' ;
            }

        }

        $addr = '
        <div class="form-group col-md-3">
        <label class="form-label">province</label>
            <input type="text" class="form-control mwz_zip_code" id="mwz_zip_code" name="zip_code" placeholder="Name" value="'.$zip_code.'">
        </div>

        <div class="form-group col-md-3">
        <label class="form-label">province</label>
        <select id="mwz_province" name="province" class="form-control select2 custom-select mwz_province" data-placeholder="Choose Province">
            '.$province_option.'
        </select>
        </div>

        <div class="form-group col-md-3">
        <label class="form-label">city</label>
        <select id="mwz_city" name="city" class="form-control select2 custom-select mwz_city" data-placeholder="Choose City">
            '.$city_option.'
        </select>
        </div>
        
        <div class="form-group col-md-3">
        <label class="form-label">district</label>
        <select id="mwz_district" name="district" class="form-control select2 custom-select mwz_district" data-placeholder="Choose District">
            '.$district_option.'
        </select>
        </div>';
    }

    public function getTIN($taxID){
        $client = new \nusoap_client('https://rdws.rd.go.th/serviceRD3/vatserviceRD3.asmx?wsdl', true);
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = false;


        if(!empty($taxID)){

            $params = array(
                // 'sequence' => array(
                'username' => 'anonymous',
                'password' => 'anonymous',
                'TIN' => $taxID,
                "ProvinceCode" => 0,
                "BranchNumber" => 0,
                "AmphurCode" => 0
                    //)
            );
             
            $data = $client->call('Service', $params);


            if(isset($data['ServiceResult']['vNID']['anyType']) 
                && $data['ServiceResult']['vNID']['anyType'] == $taxID){
                return $data ;
            }else{
                return array("result"=>"incorrect");
            }


        }
    }

    public function multifiles_upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $request->get('path');
            $name = time().".".$image->extension();
            $path = $image->storeAs(
                $path,
                $name
            );
            $src = Storage::url($path);
            // $attributes[] = Storage::url($path);
            return('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "src" : "'.$src.'"}');
        }
    }

    public function setAddressByZipcode($zip_code)
    {
        $districts = Districts::with('province')->with('city')->where('zip_code', $zip_code)->get();
        $addr = [];
        if(!empty($districts)){
            foreach ($districts as $d) {
                $addr['province'][$d->province->id] = $d->province;
                $addr['city'][$d->city->id] = $d->city;
                $addr['district'][$d->id] = $d;
            }
        }
        return $addr;
    }

    
}
