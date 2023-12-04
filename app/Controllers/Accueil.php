<?php
namespace App\Controllers;

use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;

class Accueil extends BaseController
{
    public function __construct()
    {
        $this->model = model(Db_model::class);
    }
    public function afficher()
    {
        $data["all_actualite"] = $this->model->get_all_actualite();
        $session = session();
        if ($session->has('user')) {
            if($this->model->is_admin($session->get('user'))==true){
                return view('templates/haut',$data)
                . view('templates/menu_administrateur')
                . view('affichage_accueil')
                . view('templates/bas');
            }else{
                return view('templates/haut',$data)
                . view('templates/menu_organisateur')
                . view('affichage_accueil')
                . view('templates/bas');
            }
        } else {
            return view('templates/haut',$data)
                . view('templates/menu_visiteur')
                . view('affichage_accueil')
                . view('templates/bas');
        }
    }
}
?>