<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class PizzaController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }*/
    //Index Function

    public function index()
    {
        /*
        $pizzas = [
            ['type' => 'Hawaiian', 'base' => 'Cheesy Crust'],
            ['type' => 'Volcano', 'base' => 'Garlic Crust'],
            ['type' => 'Veg Supreme', 'base' => 'Thin and Crispy']
        ];
        */
        $pizzas = Pizza::all();
        //$pizzas = Pizza::orderBy('name','desc')->get();
        //$pizzas = Pizza::where('type','hawaiian')->get();


        return view('pizzas.index',[
            'pizzas' => $pizzas,
            //'name' => request('name')    
        ]);
    }

    public function show($id)
    {
        $pizza = Pizza::findOrFail($id);

        return view('pizzas.show', ['pizza' => $pizza]);
        //return view('pizzas.show', ['id' => $id]);
    }

    public function create()
    {
        return view('pizzas.create');
    }

    public function store()
    {
        /*
        error_log(request('name'));
        error_log(request('type'));
        error_log(request('base'));
        */

        $pizza = new Pizza();

        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->toppings = request('toppings');


        //error_log($pizza);
        //error_log(request('toppings'));
        

        $pizza->save();

        return redirect('/')->with('mssg','Thanks for your order');
    }

    public function destroy($id)
    {
        $pizza = Pizza::findorFail($id);
        $pizza->delete();

        return redirect('/pizzas');
    }
}
