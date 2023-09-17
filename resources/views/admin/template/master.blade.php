@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'admin/template/app' :
(( $configData["layout"] === 'blank') ? 'layouts.blankLayout' : 'layouts.contentNavbarLayout') ))
@endisset
