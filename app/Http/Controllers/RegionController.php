<?php

namespace App\Http\Controllers;

use App\classes\Helpers;
use App\Models\Region;
use App\Models\Ville;
use Illuminate\Http\Request;

class RegionController extends Controller
{


    /**
     * Index permet d'afficher les données de la table dans la grille et message afin d'affiché une notifiction si c pas null
     **/
    public function index()
    {
        return view('settings.region', ['collection' => Region::all()]);
    }


    /**
     * Affiche la page d'Edition sans les donnes (vide inputs ... )
     **/
    public function create()
    {
        return view('settings.editRegion', ['model' => null, 'villeSelectData' => [Ville::all(), [\App\Models\Ville::PRIMARY_KEY, 'name']]]);
    }


    /*
    * Supprime un Row du grid par son pk
    * the return value is array with two keys
    * first key is the  status of the action (success,error)
    * second key is the message depend on the status
    * ex : if the return array is
        [1,0] : is mean that title : success and message is that the record added successfully
        [1,1] : is mean that title : success and message is that the update was successfully
        [1,2] : is mean that title : success and message is that the record was deleted
        [0,0] : is mean that title : error and message is that something  went wrong
        [0,1] : is mean that title : error and message is that something  went wrong
        [0,2] : is mean that title : error and message is that something  went wrong
        * so the first second key is depended on the first key
    */
    public function delete($id)
    {

        $o = Region::query()->find($id);
        if (isset($o)) {
            $o->delete();
            $return = [1, 2];
        } else
            $return = [0];
        return back()->with('message', $return);
    }

    /**
     * supprimer multi enregistrements dans la grille
     **/
    public function deleteMulti(Request $request)
    {
        $ids = $request->get('ids');
        Region::query()->whereIn(Region::PRIMARY_KEY, $ids)->delete();
        session()->flash('message', [1, 2]);
    }

    /**
     * Affiche la page d'Edition avec les données d'une ligne selectione dans grille
     **/
    public function show($id)
    {
        $o = Region::query()->find($id);
        if (!isset($o)) {
            return redirect()->route('regions')->with(['message' => [0]]);
        }
        return view('settings.editRegion', ['model' => $o, 'villeSelectData' => [Ville::all(), [\App\Models\Ville::PRIMARY_KEY, 'name']]]);
    }

    /**
     * Permet d'enregistré les données de la page Edition cas de modifier
     **/
    public function update($id, Request $request)
    {
        $res = $request->validate([
            'nomRAr' => 'required|string|max:255',
            'nomR' => 'required|string|max:255',
            'provincesAr' => 'nullable|string|max:255',
            'provinces' => 'nullable|string|max:255',
            'villeChefLieu' => 'required|numeric|exists:villes,id',
            'conseilRegional' => 'nullable|string|max:255',
            'president' => 'nullable|string|max:150',
            'walis' => 'nullable|string',
            'population' => 'nullable|numeric',
            'populationUrbaine' => 'nullable|numeric',
            'populationRurale' => 'nullable|numeric',
            'carte' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'siteWeb' => 'nullable|url'
        ]);

        $o = Region::query()->find($id);
        if (isset($o)) {
            Helpers::saveFile($request, 'carte', $id . "Profil", "avocats/$id", $o);
            unset($res['carte']);
            $o->update($res);
            return redirect()->route('regions')->with(['message' => [1, 1]]);
        } else {
            return redirect()->route('regions')->with(['message' => [0]]);
        }
    }


    /**
     * Permet d'enregistré les données de la page Edition cas de nouvel enregistrement
     **/
    public function store(Request $request)
    {
        $res = $request->validate([
            'nomRAr' => 'required|string|max:255',
            'nomR' => 'required|string|max:255',
            'provincesAr' => 'nullable|string|max:255',
            'provinces' => 'nullable|string|max:255',
            'villeChefLieu' => 'required|numeric|exists:villes,id',
            'conseilRegional' => 'nullable|string|max:255',
            'president' => 'nullable|string|max:150',
            'walis' => 'nullable|string',
            'population' => 'nullable|numeric',
            'populationUrbaine' => 'nullable|numeric',
            'populationRurale' => 'nullable|numeric',
            'carte' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'siteWeb' => 'nullable|url'
        ]);

        unset($res['carte']);
        $o = Region::query()->create($res);
        Helpers::saveFile($request, 'carte', $o[Region::PRIMARY_KEY] . "carte", "avocats/" .$o[Region::PRIMARY_KEY], $o );
        return redirect()->route('regions')->with(['message' => [1, 0]]);
    }


}
