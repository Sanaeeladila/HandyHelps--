<?php

    namespace App\Http\Controllers;

    use App\Models\Partenaire;

    class IndexController extends Controller {

        public function showGardeningPartners() {
            return view('gardening', [
                'gardeningPartners' => Partenaire::where('metier', 'Gardening')->get()
            ]);
        }
        
        public function showPetCarePartners() {
            return view('petcare', [
                'petCarePartners' => Partenaire::where('metier', 'PetCare')->get()
            ]);
        }
        
        public function showBricolagePartners() {
            return view('bricolage', [
                'bricolagePartners' => Partenaire::where('metier', 'Bricolage')->get()
            ]);
        }
    
    }

?>
