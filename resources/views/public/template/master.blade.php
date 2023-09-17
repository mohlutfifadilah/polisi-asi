@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'public/template/app' :
(( $configData["layout"] === 'blank') ? 'layouts.blankLayout' : 'layouts.contentNavbarLayout') ))
@endisset
