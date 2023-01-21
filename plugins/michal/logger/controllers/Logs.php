<?php namespace Michal\Logger\Controllers;

use BackendMenu;
use Michal\Logger\Models\Log;
use Backend\Classes\Controller;
use Rainlab\User\Facades\Auth;
use Illuminate\Support\Facades\Event;

/**
 * Logs Back-end Controller
 */
class Logs extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    public $relationConfig = "config_relation.yaml";

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Michal.Logger', 'logger', 'logs');
    }



    public function getAllRecords()
    {


        return Log::get();
    }

    public function loginLog()
    {
        $user = Auth::authenticate([
            'login' => post('login'),
            'password' =>  post('password')
        ]);


        Log::create([
            'name' => $user["name"],
            'user_id' => $user["id"]
        ]);

        return ($user["name"]);
    }

    public function getMyRecords()
    {


        return Log::where('user_id', auth()->user()->id)->get();

    }

    public function newLog(){
        Log::create([
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id
        ]);
        return (auth()->user()->name);
    }








}
