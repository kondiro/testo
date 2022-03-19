@extends('layout.master')

@section('title' ,  isset($model) ? __('settings/etudiant.edition_update') : __("settings/etudiant.edition_create"))

@section('content')
    <x-breadcrumbs.breadcrumb
        :bread-crumb="[
                 __('layout/sidebar.P') =>  null , // settings
                 __('settings/etudiant.consult_page_name') =>  route('etudiants'), // les regions (clickable)
                (isset($model) ? __('globals.modifier') :__('globals.enregistrer'))  => null
            ]"
    />
    <x-forms.form
        method="post"
        :action="isset($model) ? route('update.etudiant' ,$model[\App\Models\Etudiant::PRIMARY_KEY]) : route('store.etudiant') "
        :title='isset($model) ? __("settings/etudiant.edition_update") : __("settings/etudiant.edition_create")'>
        @bind($model)

        <x-forms.input maxlength="255" required name="nomE" :label="__('settings/etudiant.nomE')" />

        <x-forms.select required name="idC" :label="__('settings/etudiant.idC')" :bind-with="$classeSelectData"/>


        @endbind
    </x-forms.form>
@endsection
@include('include.edition' , ['fileUpload' => false ])
