@extends('layout.master')

@section('title' ,  isset($model) ? __('settings/region.edition_update') : __("settings/region.edition_create"))

@section('content')
    <x-breadcrumbs.breadcrumb
        :bread-crumb="[
                 __('layout/sidebar.P') =>  null , // settings
                 __('settings/region.consult_page_name') =>  route('regions'), // les regions (clickable)
                (isset($model) ? __('globals.modifier') :__('globals.enregistrer'))  => null
            ]"
    />
    <x-forms.form
        method="post"
        :action="isset($model) ? route('update.region' ,$model[\App\Models\Region::PRIMARY_KEY]) : route('store.region') "
        :title='isset($model) ? __("settings/region.edition_update") : __("settings/region.edition_create")'>
        @bind($model)

        {{--        nomRAr                              varchar(255)       text-12	            CUG--}}
        {{--        nomR                                varchar(255)       text-12	            CUG--}}
        {{--        provincesAr                         Text               TextArea	            UG--}}
        {{--        provinces                           Text               TextArea	            UG--}}
        {{--        villeChefLieu                       int                select	            CUG--}}
        {{--        conseilRegional                     varchar(255)       text-12	            UG--}}
        {{--        president                           varchar(150)       text-12	            UG--}}
        {{--        walis                               Text               TextArea	            UG--}}
        {{--        population                          bigInt             text-4	            UG--}}
        {{--        populationUrbaine                   bigInt             text-4	            UG--}}
        {{--        populationRurale                    bigInt             text-4	            UG--}}
        {{--        carte                               varchar(255)       fileUpload	        UG--}}
        {{--        siteWeb                             varchar(150)       text-12	            UG--}}


        <x-forms.file name="carte"  :label="__('settings/region.carte')"/>



        <x-forms.input  maxlength="255" required name="nomRAr" :label="__('settings/region.nomRAr')"/>
        <x-forms.input dire="ltr" maxlength="255" required name="nomR" :label="__('settings/region.nomR')"/>


        <x-forms.text-area maxlength="255" name="provincesAr" :label="__('settings/region.provincesAr')"/>
        <x-forms.text-area  dire="ltr" maxlength="255" name="provinces" :label="__('settings/region.provinces')"/>

        <x-forms.select  required name="villeChefLieu" :label="__('settings/region.villeChefLieu')" :bind-with="$villeSelectData"/>

        <x-forms.input  dire="ltr" maxlength="255"  name="conseilRegional" :label="__('settings/region.conseilRegional')"/>
        <x-forms.input  dire="ltr" maxlength="150"  name="president" :label="__('settings/region.president')"/>

        <x-forms.text-area  dire="ltr" name="walis" :label="__('settings/region.walis')"/>

        <x-forms.input  dire="ltr" type="number" name="population" :label="__('settings/region.population')"/>
        <x-forms.input  dire="ltr" type="number" name="populationUrbaine" :label="__('settings/region.populationUrbaine')"/>
        <x-forms.input  dire="ltr" type="number" name="populationRurale" :label="__('settings/region.populationRurale')"/>

        <x-forms.input  dire="ltr" maxlength="150"  name="siteWeb" :label="__('settings/region.siteWeb')"/>



        @endbind
    </x-forms.form>
@endsection
@include('include.edition' , ['fileUpload' => true ])
