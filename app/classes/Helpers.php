<?php

namespace App\classes;


class Helpers
{


    /**
     * get model pk value
     */
    public static function getModelPrimaryKey($model): string
    {
        return $model->{self::getModelPrimaryKeyName($model)};
    }

    /**
     * get model pk name
     * Please add static var call PRIMARY_KEY with the correct pk name in you model
     */
    public static function getModelPrimaryKeyName($model)
    {
        return get_class($model)::PRIMARY_KEY;
    }


    /*
     * save any file in given path and filename and save the full path in model col
     */
    public static function saveFile($request, $col, $fileName, $path, $model, $save = true)
    {
        if ($request->hasFile($col)) {
            $model[$col] = $request->file($col)->storeAs($path, $fileName . '.' . $request->file($col)->extension());
        } else {
            if ($request->has($col . '-path') && $request->get($col . '-path') == '') {
                $model[$col] = null;
            }
        }
        if ($save && $model->isDirty($col)) {
            $model->save();
        }
    }


    /*
        download file if exist
    */
    public static function downloadFile($filePath, $fileName = null)
    {

        if (empty($filePath) || !file_exists($filePath)) {
            return null;
        }
        $fileExt = trim(\File::extension($filePath));
        $fileName = $fileName ?? \File::name($filePath) . '_' . now()->toDateTimeLocalString() . '.' . $fileExt;
        $headers = array(
            'Content-Type: application/' . $fileExt,
            '--window-size=200,200'
        );
        return [$filePath, $fileName, $headers];
    }

    /*
     * password Generator
     */
    public static function passwordGenerator()
    {
        $random = 'abcdefghijklmnopqrstuvwxyz@#!-*ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($random), 0, rand(8, strlen($random) - 1));
    }


    public static function contains($haystack, $needles)
    {
        $haystack = trim(strtolower($haystack));
        foreach ($needles as $needle) {
            $needle = '/' . trim(strtolower($needle));
            if (str_contains($haystack, $needle)) {
                return true;
            }
        }
        return false;
    }

    public static function SideBarSettingModelContent(): array
    {
        return  [
            [
                'prefix' => ['regions', __('settings/region.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/region.consult_table_title'), 'route' => route('regions')],
                    ['name' => __('settings/region.edition_create'), 'route' => route('create.region')],
                ]
            ],
            [
                'prefix' => ['villes', __('settings/ville.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/ville.consult_table_title'), 'route' => route('villes')],
                    ['name' => __('settings/ville.edition_create'), 'route' => route('create.ville')],
                ]
            ],
            [
                'prefix' => ['barreaux', __('settings/barreaux.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/barreaux.consult_table_title'), 'route' => route('barreaux')],
                    ['name' => __('settings/barreaux.edition_create'), 'route' => route('create.region')],
                ]
            ],
            [
                'prefix' => ['specialites', __('settings/specialite.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/specialite.consult_table_title'), 'route' => route('specialites')],
                    ['name' => __('settings/specialite.edition_create'), 'route' => route('create.specialite')],
                ]
            ],
            [
                'prefix' => ['filieres', __('settings/filiere.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/filiere.consult_table_title'), 'route' => route('filieres')],
                    ['name' => __('settings/filiere.edition_create'), 'route' => route('create.filiere')],
                ]
            ],
            [
                'prefix' => ['juridictions', __('settings/juridiction.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/juridiction.consult_table_title'), 'route' => route('juridictions')],
                    ['name' => __('settings/juridiction.edition_create'), 'route' => route('create.juridiction')],
                ]
            ],
            [
                'prefix' => ['tribunaux', __('settings/tribunal.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/tribunal.consult_table_title'), 'route' => route('tribunaux')],
                    ['name' => __('settings/tribunal.edition_create'), 'route' => route('create.tribunal')],
                ]
            ],
            [
                'prefix' => ['chambres', __('settings/chambres.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/chambres.consult_table_title'), 'route' => route('chambres')],
                    ['name' => __('settings/chambres.edition_create'), 'route' => route('create.chambre')],
                ]
            ],
            [
                'prefix' => ['typeemployerjustices', __('settings/typeemployerjustice.menu_name')],
                'urls' => [
                    ['name' => __('settings/typeemployerjustice.consult_table_title'), 'route' => route('typeemployerjustices')],
                    ['name' => __('settings/typeemployerjustice.edition_create'), 'route' => route('create.typeemployerjustice')],
                ]
            ],
            [
                'prefix' => ['gradetypes', __('settings/gradetypes.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/gradetypes.consult_table_title'), 'route' => route('gradetypes')],
                    ['name' => __('settings/gradetypes.edition_create'), 'route' => route('create.gradetype')],
                ]
            ],
            [
                'prefix' => ['employerjustices', __('settings/employerjustices.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/employerjustices.consult_table_title'), 'route' => route('employerjustices')],
                    ['name' => __('settings/employerjustices.edition_create'), 'route' => route('create.employerjustice')],
                ]
            ],
            [
                'prefix' => ['typeintervenants', __('settings/typeintervenant.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/typeintervenant.consult_table_title'), 'route' => route('typeintervenants')],
                    ['name' => __('settings/typeintervenant.edition_create'), 'route' => route('create.typeintervenant')],
                ]
            ],
            [
                'prefix' => ['gradetypeintervenants', __('settings/gradetypeintervenant.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/gradetypeintervenant.consult_table_title'), 'route' => route('gradetypeintervenants')],
                    ['name' => __('settings/gradetypeintervenant.edition_create'), 'route' => route('create.gradetypeintervenant')],
                ]
            ],
            [
                'prefix' => ['intervenants', __('settings/intervenants.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/intervenants.consult_table_title'), 'route' => route('intervenants')],
                    ['name' => __('settings/intervenants.edition_create'), 'route' => route('create.intervenant')],
                ]
            ],
            [
                'prefix' => ['avocats', __('settings/avocat.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/avocat.consult_table_title'), 'route' => route('avocats')],
                    ['name' => __('settings/avocat.edition_create'), 'route' => route('create.avocat')],
                    ['name' => __('settings/avocat.import'), 'route' => route('import.avocat')],
                ]
            ],
            [
                'prefix' => ['bureaux', __('settings/bureau.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/bureau.consult_table_title'), 'route' => route('bureaux')],
                    ['name' => __('settings/bureau.edition_create'), 'route' => route('create.bureau')],
                    ['name' => __('settings/bureau.import'), 'route' => route('import.bureau')],
                ]
            ] ,
            [
                'prefix' => ['admins', __('settings/useradmin.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/useradmin.consult_table_title'), 'route' => route('admins')],
                    ['name' => __('settings/useradmin.edition_create'), 'route' => route('create.admin')]
                ]
            ],
            [
                'prefix' => ['cabinets', __('settings/gestioncabinet.consult_page_name')],
                'urls' => [
                    ['name' => __('settings/gestioncabinet.consult_table_title'), 'route' => route('cabinets')],
                    ['name' => __('settings/useradmin.edition_create'), 'route' => route('create.cabinet')],
                    ['name' => __('settings/importCabinet.page_name'), 'route' => route('import.cabinet')],

                ]
            ]


        ];
    }

    public static function SideBarGestionAccountsContent(): array
    {
        return [
            [
                'prefix' => ['profile', __('gestionAccounts/profile.page_name')],
                'urls' => [
                    ['name' => __('gestionAccounts/profile.page_name'), 'route' => route('profile')],
                    ['name' => __('gestionAccounts/dashboard.page_name'), 'route' => route('dashboard.admin')],
                ]
            ]
        ];
    }


    public static function SideBarGestionAbonnements(): array
    {
        return [
            [
                'prefix' => ['abonnements', __('GestionDesAbonnements/abonnements.consult_page_name')],
                'urls' => [
                    ['name' => __('GestionDesAbonnements/abonnements.consult_table_title'), 'route' => route('abonnements')],
                    ['name' => __('GestionDesAbonnements/abonnements.edition_create'), 'route' => route('create.abonnement')],
                ]
            ],
        ];
    }





    /*
     *
     */
    public static function LogOut($to)
    {
        session()->flush();
        if (isset($to)) {
            return redirect($to);
        }
    }


}
