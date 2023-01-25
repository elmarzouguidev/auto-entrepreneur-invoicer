<?php

namespace App\Http\Controllers\Administration\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Client\ClientFormRequest;
use App\Http\Requests\Application\Client\ClientUpdateFormRequest;
use App\Http\Requests\Application\Client\EmailsFormRequest;
use App\Http\Requests\Application\Client\PhonesFormRequest;
use App\Models\Client;
use App\Models\Utilities\Email;
use App\Models\Utilities\Telephone;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Client\ClientInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ClientController extends Controller
{
    public function index()
    {
        $clients = app(ClientInterface::class)->__instance()->get();

        return view('theme.pages.Client.__datatable.index', compact('clients'));
    }

    public function create()
    {
        $this->authorize('create', Client::class);

        $categories = app(CategoryInterface::class)->getCategories(['id', 'name']);

        return view('theme.pages.Client.__create.index', compact('categories'));
    }

    public function store(ClientFormRequest $request)
    {
        $this->authorize('create', Client::class);

        $client = Client::create($request->validated());

        if ($request->hasFile('logo')) {
            $client->addMediaFromRequest('logo')
                ->toMediaCollection('clients-logo');
        }

        $request->whenFilled('category', function ($input) use ($client) {
            $client->update(['category_id' => $input]);
        });

        return redirect($client->edit)->with('success', "L'ajoute a éte effectuer avec success");
    }

    public function edit(Client $client)
    {
        $this->authorize('update', $client);

        $client->load('telephones', 'emails');

        $categories = app(CategoryInterface::class)->getCategories(['id', 'name']);

        return view('theme.pages.Client.__edit.index', compact('client', 'categories'));
    }

    public function update(ClientUpdateFormRequest $request, $client)
    {
        //dd($request->telephones);
        $client = Client::whereUuid($client)->firstOrFail();

        $this->authorize('update', $client);

        $client->update($request->validated());

        if ($request->hasFile('photo')) {
            $client->addMediaFromRequest('photo')
                ->toMediaCollection('clients-logo');
        }

        $request->whenFilled('category', function ($input) use ($client) {
            $client->update(['category_id' => $input]);
        });

        return redirect($client->edit)->with('success', "L' Update a éte effectuer avec success");
    }

    public function addEmails(EmailsFormRequest $request, Client $client)
    {
        if ($request->secend_email) {
            $client->emails()->create(['email' => $request->secend_email]);

            return redirect()->back()->with('success', "L' Update a éte effectuer avec success");
        }

        return redirect()->back()->with('errors', "L' Update a éte effectuer avec success");
    }

    public function addPhones(PhonesFormRequest $request, Client $client)
    {
        // dd('Ouiii', $request->all());

        if ($request->telephone) {
            $client->telephones()->create(['telephone' => $request->telephone, 'type' => $request->type]);

            return redirect()->back()->with('success', "L' Update a éte effectuer avec success");
        }

        return redirect()->back()->with('errors', "L' Update a éte effectuer avec success");
    }

    public function show(string $slug)
    {
        $client = app(ClientInterface::class)
            ->getClientByUuid($slug)
            ->withSum('invoices', 'price_total')
            ->withSum(['invoices as price_total_paid' => function ($query) {
                $query->has('bill');
            }], 'price_total')
            ->firstOrFail();

        $chart_options = [
            'chart_title' => 'Chiffre d affaire par moi',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Finance\Invoice',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price_total',
            'chart_type' => 'line',
            'chart_color' => '85, 110, 230',
            'conditions' => [
                ['condition' => "client_id = $client->id", 'color' => 'blue', 'fill' => true],

            ],
        ];

        $chart = new LaravelChart($chart_options);

        return view('theme.pages.Client.__profile.index', compact('client', 'chart'));
    }

    public function delete(Request $request)
    {
        $request->validate(['clientId' => 'required|uuid']);

        $client = Client::whereUuid($request->clientId)->firstOrFail();

        $this->authorize('delete', $client);

        if ($client) {
            //dd('Oui client');

            // $client->delete();

            return redirect()->back()->with('success', 'Le client a été supprimer avec success');
        }

        return redirect()->back()->with('success', 'Problem ... !!');
    }

    public function deletePhone(Request $request)
    {
        //dd($request->all());
        $request->validate(['client' => 'required|uuid', 'phone' => 'required|uuid']);

        $client = Client::whereUuid($request->client)->firstOrFail();

        $this->authorize('delete', $client);

        $phone = Telephone::whereUuid($request->phone)->firstOrFail();

        if ($client && $phone) {
            $client->telephones()
                ->whereUuid($request->phone)
                ->where('telephoneable_id', $client->id)
                ->delete();

            return response()->json([
                'success' => 'Record deleted successfully!',
            ]);
        }

        return response()->json([
            'error' => 'problem detected !',
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function deleteEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        // dd($request->all());
        $request->validate(['client' => 'required|uuid', 'email' => 'required|uuid']);

        $client = Client::whereUuid($request->client)->firstOrFail();

        $this->authorize('delete', $client);

        $email = Email::whereUuid($request->email)->firstOrFail();

        if ($client && $email) {
            //dd("Yes delete it");
            $client->emails()
                ->whereUuid($request->email)
                ->where('emailable_id', $client->id)
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
