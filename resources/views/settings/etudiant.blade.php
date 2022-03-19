{{-- template root --}}
@extends('layout.master')
{{-- page title  --}}
@section('title' ,   __('settings/etudiant.consult_page_name'))
{{-- page content  --}}
@section('content')
    @php
        $tablesCols = [
    //      column db   type     trans
            'nomE' => ['text' , __('settings/etudiant.nomE')],
            /*'nomRAr' => ['text' , __('settings/region.nomRAr')],
            'nomR' => ['text' , __('settings/region.nomR')],
             'provincesAr' => ['text' , __('settings/region.provincesAr')],
            'provinces' => ['text' , __('settings/region.provinces')],
            'villeAr' => ['text' , __('settings/region.villeChefLieu')],
            'conseilRegional' => ['text' , __('settings/region.conseilRegional')],
            'president' => ['text' , __('settings/region.president')],
            'walis' => ['text' , __('settings/region.walis')],
            'population' => ['text' , __('settings/region.population')],
            'populationUrbaine' => ['text' , __('settings/region.populationUrbaine')],
            'populationRurale' => ['text' , __('settings/region.populationRurale')],
            'siteWeb' => ['text' , __('settings/region.siteWeb')] */
            ];
        // breadcrumbs
        $breadcrumblinks = [
                __('layout/sidebar.P') =>  null,
                __('settings/etudiant.consult_page_name') =>  null
            ];
        // crud links
        $crudlinks = [
            //     trans                                      icon      route
                __('settings/etudiant.consult_create_new') =>  ['add' , route('create.etudiant')],
                __('settings/etudiant.consult_delete_all') =>  ['delete-all' , route('delete.etudiants')]
            ];
    @endphp
    <x-breadcrumbs.breadcrumb   :bread-crumb="$breadcrumblinks" :links="$crudlinks"/>


    @bind($collection)
    <x-tables.data-table
        id="etudiants"
        :title="__('settings/etudiant.consult_table_title')"
        :datatableColumns="$tablesCols"
        delete-route="delete.etudiant"
        edit-route="show.etudiant"/>
    @endbind

@endsection
@include('include.consult')
