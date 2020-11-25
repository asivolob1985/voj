<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class helper{

    public static function sanitize_tel($tel) {

        return preg_replace('/[^+\d]/', '', $tel);
    }

    public static function settings_getFileLink($string){
        $arr = json_decode($string);
        $file = $arr[0];
        $path = Storage::disk(config('voyager.storage.disk'))->url($file->download_link);

        return $path;
    }

    public static function settings_getFilePath($string){
        $arr = json_decode($string);
        $file = $arr[0];
        $PathPrefix = Storage::disk(config('voyager.storage.disk'))->getDriver()->getAdapter()->getPathPrefix();
        $abs_path = $PathPrefix.$file->download_link;

        return $abs_path;
    }

    public static function human_filesize($bytes, $decimals = 2) {
        $sz = __('elements.file_size');
        $factor = floor((strlen($bytes) - 1) / 3);
        $size = str_replace('.', ',', sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . " ". @$sz[$factor]);
        return $size.__('elements.bytes');
    }

    public static function getExt($filename){

        return end(explode(".", $filename));
    }

    public static function list_wrapper($string, $open, $close, $delimiter){
        $ar = explode($delimiter, $string);
        $result_str = '';
        foreach($ar as $item){
            $result_str.=$open.$item.$close;
        }

        return $result_str;
    }

    public static function getChangedText($text_block){

        preg_match_all('/<img[^>]+>/i',$text_block, $result);
        if(is_array($result)){
            foreach($result as $res){
                if(count($res) > 0){
                    $img = $res[0];
                    preg_match_all('/(src)=("[^"]*")/i',$img, $res);
                    $src = $res[2][0];
                    $result = '<a class="popup-link" href='.$src.'>'.$img.'</a>';
                    $text_block = str_replace($img, $result, $text_block);
                }
            }
        }

        $search = mb_strpos($text_block, '[slider=');
        if($search){
            $pattern = '|slider=(\d+)\]|';
            preg_match_all($pattern, $text_block, $matches);
            $galls = $matches[1];
            foreach($galls as $k => $gal_id) {
                $slider = \App\Slider::find($gal_id);
                if($slider !== null) {
                    $result = view('elements.slider', ['slider' => $slider]);
                }else{
                    $result = '';
                }
                $text_block = str_replace('[slider='.$gal_id.']', $result, $text_block);
            }
        }

        $search = mb_strpos($text_block, '[file=');
        if($search){
            $pattern = '|file=(.+)\]|';
            preg_match_all($pattern, $text_block, $matches);
            $files_ids = $matches[1];
            foreach($files_ids as $ids){
                $files_ar = explode(',', $ids);
                if(count($files_ar) > 0) {
                    $files = \App\File::find($files_ar);
                    $result = (string)View::make('elements.file', ['files' => $files])->render();
                }else{
                    $result = '';
                }
                $text_block = str_replace('[file='.$ids.']', $result, $text_block);
            }
        }


        /*$search = mb_strpos($text_block, '[img=');
        if($search){
            $pattern = '|img="(.+)"\]|';
            preg_match_all($pattern, $text_block, $matches);
            $imgs = $matches[1];
            foreach($imgs as $img){
                $result = '<a class="popup-link" href="'.$img.'"><img src="'.$img.'"/></a>';
                $str = '[img="'.$img.'"]';
                $text_block = str_replace($str, $result, $text_block);
            }
        }*/




        $search = mb_strpos($text_block, '[partner=');
        if($search){
            $pattern = '|partner=(.+)\]|';
            preg_match_all($pattern, $text_block, $matches);
            $partner_ids = $matches[1];
            foreach($partner_ids as $ids){
                $partners_ar = explode(',', $ids);
                if(count($partners_ar) > 0){
                    $partners = \App\Partner::find($partners_ar);
                    $result = (string)View::make('elements.partner', ['partners' => $partners])->render();
                }else{
                    $result = '';
                }
                $text_block = str_replace('[partner='.$ids.']', $result, $text_block);
            }
        }

        $search = mb_strpos($text_block, '[profile=');
        if($search){
            $pattern = '|profile=(.+)\]|';
            preg_match_all($pattern, $text_block, $matches);
            $profiles_ids = $matches[1];
            foreach($profiles_ids as $ids){
                $profiles_ar = explode(',', $ids);
                if(count($profiles_ar) > 0){
                    $profiles = \App\Managment::find($profiles_ar);
                    $result = (string)View::make('elements.profile', ['profiles' => $profiles])->render();
                }else{
                    $result = '';
                }
                $text_block = str_replace('[profile='.$ids.']', $result, $text_block);
            }
        }

        $search = mb_strpos($text_block, '<table');
        if($search){
            $result = '<table class="info-table" ';
            $text_block = str_replace('<table', $result, $text_block);
        }

        $search = mb_strpos($text_block, '<ol>');
        if($search){
            $result = '<ol class="entrance-list">';
            $text_block = str_replace('<ol>', $result, $text_block);
        }

        $search = mb_strpos($text_block, '<ul>');
        if($search){
            $result = '<ul class="science-list">';
            $text_block = str_replace('<ul>', $result, $text_block);
        }

        $search = mb_strpos($text_block, '[link=');
        if($search){
            $result = '';
            $pattern = '|(link=.+)\]|';
            preg_match_all($pattern, $text_block, $matches);
            $links = $matches[1];
            $view_links = [];
            foreach($links as $link){
                $links_ar = explode(',', $link);
                foreach($links_ar as $link_params){
                    $pattern_link = '|link="(.+?)"|';
                    $pattern_name = '|name="(.+?)"|';
                    preg_match_all($pattern_link, $link_params, $matches_link);
                    preg_match_all($pattern_name, $link_params, $matches_name);
                    $view_links[] = ['link' => $matches_link[1][0], 'name' => $matches_name[1][0]];
                }
                if(count($view_links) > 0){
                    $result = (string)View::make('elements.unit_links', ['links' => $view_links])->render();
                }
                $text_block = str_replace('['.$link.']', $result, $text_block);
                $view_links = [];
            }
        }

        $search = mb_strpos($text_block, '[page=');
        if($search){
            $result = '';
            $pattern = '|(page=.+)\]|';
            preg_match_all($pattern, $text_block, $matches);
            $pages = $matches[1];
            $view_links = [];
            foreach($pages as $page){
                $pages_ar = explode(',', $page);
                foreach($pages_ar as $page_params){
                    $pattern_page = '|page="(.+?)"|';
                    $pattern_name = '|name="(.+?)"|';
                    preg_match_all($pattern_page, $page_params, $matches_page);
                    preg_match_all($pattern_name, $page_params, $matches_name);
                    $page_id = $matches_page[1][0];
                    $page_obj = \TCG\Voyager\Models\Page::find($page_id);
                    if($page_obj!=null){
                        $page_url = $page_obj->path;
                        $view_links[] = ['link' => $page_url, 'name' => $matches_name[1][0]];
                    }
                }

                if(count($view_links) > 0){
                    $result = (string)View::make('elements.unit_links', ['links' => $view_links])->render();
                }

                if($result != ''){
                    $text_block = str_replace('['.$page.']', $result, $text_block);
                }

                $view_links = [];
            }
        }

        $search = mb_strpos($text_block, '<iframe');
        if($search){
            $pattern = '|<iframe.+embed/(.+)\?.+?></iframe>|';
            preg_match_all($pattern, $text_block, $matches);
            $video_id = $matches[1][0];
            $iframe = $matches[0][0];
            $result = (string)View::make('elements.youtube', ['video_id' => $video_id])->render();
            $text_block = str_replace($iframe, $result, $text_block);
        }

        //management
        $search = mb_strpos($text_block, '[widget=sovet]');
        if($search){
            $widget = new \App\Http\Controllers\ManagmentsController();
            $result = $widget->sovet();

            $text_block = str_replace('[widget=sovet]', $result, $text_block);
        }

        //structure
        $search = mb_strpos($text_block, '[widget=structure]');
        if($search){
            $widget = new \App\Http\Controllers\StructureController();
            $result = $widget->index();

            $text_block = str_replace('[widget=structure]', $result, $text_block);
        }


        return $text_block;
    }

    public static function month($n) {
        $_monthsList = [
            "01" => "января",
            "02" => "февраля",
            "03" => "марта",
            "04" => "апреля",
            "05" => "мая",
            "06" => "июня",
            "07" => "июля",
            "08" => "августа",
            "09" => "сентября",
            "10" => "октября",
            "11" => "ноября",
            "12" => "декабря",
        ];

        return $_monthsList[$n];
    }

    public static function plural($n, $n1, $n2, $n5) {
        if ($n >= 11 and $n <= 19) return $n5;
        $n = $n % 10;
        if ($n == 1) return $n1;
        if ($n >= 2 and $n <= 4) return $n2;

        return $n5;
    }

    public static function mark_search($search, $text){

        return preg_replace('~' . $search . '~ui', '<span class="match">$0</span>', $text);
    }

    public static function getAnnounce($text){

        return \Illuminate\Support\Str::limit(strip_tags($text), 250);
    }

}