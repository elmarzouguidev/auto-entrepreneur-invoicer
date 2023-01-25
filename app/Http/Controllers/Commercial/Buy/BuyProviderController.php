<?php

namespace App\Http\Controllers\Commercial\Buy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commercial\Provider\EmailsFormRequest;
use App\Http\Requests\Commercial\Provider\PhonesFormRequest;
use App\Http\Requests\Commercial\Provider\ProviderFormRequest;
use App\Http\Requests\Commercial\Provider\ProviderUpdateFormRequest;
use App\Models\Finance\Provider;
use App\Models\Utilities\Email;
use App\Models\Utilities\Telephone;
use App\Repositories\Provider\ProviderInterface;
use Illuminate\Http\Request;

class BuyProviderController extends Controller
{
    public function index()
    {
        $providers = app(ProviderInterface::class)->Providers();

        return view('theme.pages.Commercial.Provider.__datatable.index', compact('providers'));
    }

    public function create()
    {
        $this->authorize('create', Provider::class);

        return view('theme.pages.Commercial.Provider.__create.index');
    }

    public function store(ProviderFormRequest $request)
    {
        //dd($request->all());
        $this->authorize('create', Provider::class);

        $provider = new Provider();
        $provider->entreprise = $request->entreprise;
        $provider->contact = $request->contact;
        $provider->telephone = $request->telephone;
        $provider->email = $request->email;
        $provider->addresse = $request->addresse;
        $provider->rc = $request->rc;
        $provider->ice = $request->ice;
        $provider->description = $request->description;

        $provider->save();

        return redirect()->back()->with('success', "L'ajoute a éte effectuer avec success");
    }

    public function edit(Provider $provider)
    {
        $this->authorize('update', $provider);

        $provider->load('telephones', 'emails');

        return view('theme.pages.Commercial.Provider.__edit.index', compact('provider'));
    }

    public function update(ProviderUpdateFormRequest $request, Provider $provider)
    {
        $this->authorize('update', $provider);

        $provider->entreprise = $request->entreprise;
        $provider->contact = $request->contact;
        $provider->telephone = $request->telephone;
        $provider->email = $request->email;
        $provider->addresse = $request->addresse;
        $provider->rc = $request->rc;
        $provider->ice = $request->ice;
        $provider->description = $request->description;
        $provider->save();

        return redirect()->back()->with('success', 'La modification a éte effectuer avec success');
    }

    public function addEmails(EmailsFormRequest $request, Provider $provider)
    {
        //dd($request->all(),'provider');
        $this->authorize('update', $provider);

        if ($request->secend_email) {
            $provider->emails()->create(['email' => $request->secend_email]);

            return redirect()->back()->with('success', "L'email a éte ajouter avec success");
        }

        return redirect()->back()->with('errors', 'error ...');
    }

    public function addPhones(PhonesFormRequest $request, Provider $provider)
    {
        //dd($request->all(),'provider');
        $this->authorize('update', $provider);

        if ($request->secend_phone) {
            $provider->telephones()->create(['telephone' => $request->secend_phone]);

            return redirect()->back()->with('success', 'Le numéro a éte ajouter avec success');
        }

        return redirect()->back()->with('errors', 'error ...');
    }

    public function delete(Request $request)
    {
        //dd('Ouiui');

        $request->validate(['providerId' => 'required|uuid']);

        $provider = Provider::whereUuid($request->providerId)->firstOrFail();

        $this->authorize('delete', $provider);

        if ($provider) {
            //$provider->delete();

            return redirect()->back()->with('success', 'La supprission a été effectué  avec success');
        }

        return redirect()->back()->with('success', 'error');
    }

    public function deletePhone(Request $request)
    {
        // dd($request->all());

        $request->validate(['provider' => 'required|uuid', 'phone' => 'required|uuid']);

        $provider = Provider::whereUuid($request->provider)->firstOrFail();

        $this->authorize('delete', $provider);

        $phone = Telephone::whereUuid($request->phone)->firstOrFail();

        if ($provider && $phone) {
            $provider->telephones()
                ->whereUuid($request->phone)
                ->where('telephoneable_id', $provider->id)
                ->delete();

            return response()->json([
                'success' => 'Record deleted successfully!',
            ]);
        }

        return response()->json([
            'error' => 'problem detected !',
        ]);
    }

    public function deleteEmail(Request $request)
    {
        // dd($request->all());
        $request->validate(['provider' => 'required|uuid', 'email' => 'required|uuid']);

        $provider = Provider::whereUuid($request->provider)->firstOrFail();

        $this->authorize('delete', $provider);

        $email = Email::whereUuid($request->email)->firstOrFail();

        if ($provider && $email) {
            //dd("Yes delete it");
            $provider->emails()
                ->whereUuid($request->email)
                ->where('emailable_id', $provider->id)
                ->delete();

            return response()->json([
                'success' => 'Record deleted successfully!',
            ]);
        }

        return response()->json([
            'error' => 'problem detected !',
        ]);
    }
}
