<?php

use Modules\Course\Entities\CourseGroup;

function mwz_test()
{
    echo 'test';
}

function mwz_setFlatCategory($categories)
{

    $traverse = function ($categories, $prefix = '-', $level = 0, &$result = []) use (&$traverse) {
        foreach ($categories as  $category) {
            $category->level = $level;

            if ($level > 0) {
                $show_prefix = str_pad('', $level, $prefix);
                $category->name =  $show_prefix . ' ' . $category->name;
            }
            if (!empty($category->children)) {
                $new_category = $category;
                unset($new_category->children);
                $result[$category->id] = $new_category;
                $traverse($category->children, '-', $level + 1, $result);
            } else {
                $result[$category->id] = $category;
            }
        }
        return $result;
    };

    return $traverse($categories);
}


function mwz_getTextString($str)
{
    return htmlspecialchars_decode(html_entity_decode($str));
}

function mwz_setTextString($str)
{
    return htmlentities(htmlspecialchars($str));
}

/* Check File In Server */
function CheckFileInServer($file)
{
    // echo $_SERVER['DOCUMENT_ROOT'] . parse_url($file, PHP_URL_PATH) ;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . parse_url($file, PHP_URL_PATH))) {
        return true;
    } else {
        return false;
    }
}

function mwz_calParentCourseGroup($parent)
{

    if ($parent == '') {
        $level = 1;
    } else {
        $i = 2;
        $id = '';
        while ($i > 0) {
            $level = $i;
            if ($i == 2) {
                $course_group = CourseGroup::find($parent);
                $id = $course_group->parent_id;
            } else {
                $course_group = CourseGroup::find($id);
                $id = $course_group->parent_id;
            }
            if (empty($course_group->parent_id)) {
                break;
            }
            $i++;
        }
    }

    return $level;
}

function mwz_route($route_name,$param = []){
    $default_locale = config('app.fallback_locale');
    // echo  $default_locale.' ='.config('app.fallback_locale'); 
    if($default_locale==app()->getLocale()){
        if(!empty($param)){
            return  route($route_name, $param);
        }else{
            return  route($route_name);
        }
    }else{
        $new_param = array_merge([app()->getLocale()] , $param) ;
        if(!empty($new_param)){
            return  route('lang.'.$route_name, $new_param);
        }else{
            return  route('lang.'.$route_name);
        }
    }
    
    
}

// function mwz_LocaleRouteWithParams($route_name,$params){
//     return route($route_name, [ app()->getLocale() , $params]);
// }

// function mwz_LocaleRouteWithTwoParams($route_name,$param_1,$param_2){
//     return route($route_name, [ app()->getLocale() , $param_1, $param_2]);
// }

// function mwz_LocaleRouteWithSlug($route_name,$slug_name){
//     return route($route_name, [ app()->getLocale() , $slug_name]);
// }

function mwz_getCurrencyData($currency){
    $_ALL_CURRENCY = array(
        'THB'=>array('name'=>'Thailand Baht','sign'=>'฿','align'=>'1'),
        'USD'=>array('name'=>'United States Dollar','sign'=>'$','align'=>'2'),
        'GBP'=>array('name'=>'United Kingdom Pound','sign'=>'£','align'=>'2'),
        'JPY'=>array('name'=>'日本語 Japan Yen','sign'=>'¥','align'=>'2'),
        'CNY'=>array('name'=>'中國 China Yuan Renminbi','sign'=>'¥','align'=>'2'),
        'KRW'=>array('name'=>'한국의 Korea Won','sign'=>'₩','align'=>'2'),
        'FRF'=>array('name'=>'français (French)','sign'=>'francs','align'=>'1'),
        'ESP'=>array('name'=>'español (Spanish)','sign'=>'€','align'=>'2'),
        'RUB'=>array('name'=>'русский язык Belarus Ruble','sign'=>'p.','align'=>'1'),
        'LAK'=>array('name'=>'ພາສາລາວ Laos Kip','sign'=>'₭','align'=>'1'),
        'VND'=>array('name'=>'Tiếng Việt Viet Nam Dong','sign'=>'₫','align'=>'1'),
        'MMK'=>array('name'=>'မြန်မာဘာသာ (Burmese)','sign'=>'K','align'=>'2'),
        'AUD'=>array('name'=>'Australian Dollar','sign'=>'AUD','align'=>'2'),
        'EUR'=>array('name'=>'Euro','sign'=>'€','align'=>'2'),
        'KHR'=>array('name'=>'ភាសាខ្មែរ Cambodia Riel','sign'=>'៛','align'=>'1'),
        'INR'=>array('name'=>'India','sign'=>'₹','align'=>'2'),
        'EGP'=>array('name'=>'Eygpt','sign'=>'£','align'=>'2')
    );

    return $_ALL_CURRENCY[$currency];
}

function mwz_frm_slug_and_meta($route,$param,$slugs,$show_slug=true,$show_meta=true){

    $show_slug = (!$show_slug)?'style="display:none"':'';
    $show_meta = (!$show_meta)?'style="display:none"':'';

    $frm = '';

    // slug
    $frm .= '<div class="form-group" '.$show_slug.'>';
    $frm .= '<label class="form-label required">'.__('mwz_admin.slug_field_label').'</label>';
    $frm .= '<input type="text" class="form-control" id="mwz_slug_'.$slugs['lang'].'" name="mwz_slug['.$slugs['lang'].']" placeholder="'.__('mwz_admin.slug_field_placeholder').'" value="'.(!empty($slugs['slug']))?$slugs['slug']:''.'">';
    $frm .= '</div>';

    // meta title
    $frm .= '<div class="form-group" '.$show_meta.'>';
    $frm .= '<label class="form-label required">'.__('mwz_admin.meta_title_field_label').'</label>';
    $frm .= '<input type="text" class="form-control" id="mwz_meta_title_'.$slugs['lang'].'" name="mwz_title['.$slugs['lang'].']" placeholder="'.__('mwz_admin.meta_title_field_placeholder').'" value="'.(!empty($slugs['meta_title']))?$slugs['meta_title']:''.'">';
    $frm .= '</div>';

    // meta keywords
    $frm .= '<div class="form-group" '.$show_meta.'>';
    $frm .= '<label class="form-label required">'.__('mwz_admin.meta_keywords_field_label').'</label>';
    $frm .= '<input type="text" class="form-control" id="mwz_meta_keywords_'.$slugs['lang'].'" name="mwz_keywords['.$slugs['lang'].']" placeholder="'.__('mwz_admin.meta_keywords_field_placeholder').'" value="'.(!empty($slugs['meta_keywords']))?$slugs['meta_keywords']:''.'">';
    $frm .= '</div>';

    // meta description
    $frm .= '<div class="form-group" '.$show_meta.'>';
    $frm .= '<label class="form-label required">'.__('mwz_admin.meta_title_field_label').'</label>';
    $frm .= '<input type="text" class="form-control" id="mwz_meta_description_'.$slugs['lang'].'" name="mwz_description['.$slugs['lang'].']" placeholder="'.__('mwz_admin.meta_description_field_placeholder').'" value="'.(!empty($slugs['meta_description']))?$slugs['meta_description']:''.'">';
    $frm .= '</div>';

    // meta author
    $frm .= '<div class="form-group" '.$show_meta.'>';
    $frm .= '<label class="form-label required">'.__('mwz_admin.meta_author_field_label').'</label>';
    $frm .= '<input type="text" class="form-control" id="mwz_meta_author_'.$slugs['lang'].'" name="mwz_author['.$slugs['lang'].']" placeholder="'.__('mwz_admin.meta_author_field_placeholder').'" value="'.(!empty($slugs['meta_author']))?$slugs['meta_author']:''.'">';
    $frm .= '</div>';

    // route
    $frm .= '<input type="hidden" class="form-control" id="mwz_slug_route_'.$slugs['lang'].'" name="mwz_slug_route['.$slugs['lang'].']"  value="'.(!empty($slugs['route']))?$slugs['route']:''.'">';

    // param
    $frm .= '<input type="hidden" class="form-control" id="mwz_slug_param_'.$slugs['lang'].'" name="mwz_slug_param['.$slugs['lang'].']" value="'.(!empty($slugs['param']))?$slugs['param']:''.'">';

    // lang
    $frm .= '<input type="hidden" class="form-control" id="mwz_slug_lang_'.$slugs['lang'].'" name="mwz_slug_lang['.$slugs['lang'].']"  value="'.(!empty($slugs['lang']))?$slugs['lang']:''.'">';

    // slug id
    $frm .= '<input type="hidden" class="form-control" id="mwz_slug_id_'.$slugs['lang'].'" name="mwz_slug_id['.$slugs['lang'].']"  value="'.(!empty($slugs['id']))?$slugs['id']:''.'">';
}


function mwz_pre($array){
    echo '<pre>';
    print_r($array);
    echo '<pre>';
}
