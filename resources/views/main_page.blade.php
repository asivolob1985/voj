@section('title', $page->meta_title)
@section('keywords', $page->meta_keywords)
@section('description', $page->meta_description)
@include('layouts.header')

<? dump($banner);?>
<? dump($slider);?>
<? dump($projects);?>
<? dump($services);?>

@widget('advantages')


@include('layouts.footer')