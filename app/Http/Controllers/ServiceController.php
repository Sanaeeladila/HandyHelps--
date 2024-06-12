<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function showServices()
    {
        $services = Service::with(['client', 'partenaire'])->get();
        return view('adminservice', ['services' => $services]);
    }

    public function destroy($id)
{
    $service = Service::find($id);
    if ($service) {
        $service->delete();
        // Redirige vers la page des services avec un message de succès
        return redirect()->route('adminservice')->with('message', 'Service supprimé avec succès.');
    } else {
        // Redirige avec un message d'erreur si le service n'est pas trouvé
        return redirect()->route('adminservice')->with('error', 'Service non trouvé.');
    }
}

    public function confirmDelete($id)
{
    $service = Service::findOrFail($id);
    return view('confirm-delete', compact('service'));
}
public function delete($id)
{
    $service = Service::findOrFail($id);
    $service->delete();
    return redirect()->route('adminservice')->with('success', 'Service supprimé.');
}
}
