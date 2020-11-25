@section('title', $page->meta_title)
@section('keywords', $page->meta_keywords)
@section('description', $page->meta_description)
@include('layouts.header')
<?=dump($page);?>
<!--заголовок страницы-->

@include('layouts.footer')