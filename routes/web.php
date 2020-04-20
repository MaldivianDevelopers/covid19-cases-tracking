<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Covid Cases
    Route::delete('covid-cases/destroy', 'CovidCaseController@massDestroy')->name('covid-cases.massDestroy');
    Route::resource('covid-cases', 'CovidCaseController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;


Route::get('/edges-sync', function() {

    $mihaaru_data = json_decode('[{"to":21,"from":0},{"to":22,"from":21},{"to":23,"from":21},{"to":24,"from":23},{"to":25,"from":23},{"to":26,"from":23},{"to":27,"from":0},{"to":28,"from":0},{"to":29,"from":27},{"to":30,"from":27},{"to":31,"from":28},{"to":32,"from":30},{"to":33,"from":28},{"to":34,"from":27},{"to":35,"from":0},{"to":36,"from":0},{"to":37,"from":27},{"to":38,"from":27},{"to":39,"from":27},{"to":40,"from":27},{"to":41,"from":27},{"to":42,"from":27},{"to":43,"from":27},{"to":44,"from":27},{"to":45,"from":27},{"to":46,"from":27},{"to":47,"from":27},{"to":48,"from":27},{"to":49,"from":27},{"to":50,"from":28},{"to":51,"from":28},{"to":52,"from":0}]');
    $m_data = array_map(function($values){
        return new Fluent($values);
    }, $mihaaru_data);

    DB::transaction(function() use($m_data) {
        foreach($m_data as $edge) {
            if($edge->from == 0) {
                continue;
            }

            $Case = \App\CovidCase::findOrFail($edge->to);
            $Source = \App\CovidCase::findOrFail($edge->from);

            $Case->source_id = $Source->id;
            $Case->save();
        }
    });

    return 'done';
});

Route::get('/nodes-sync', function()
{

    $mihaaru_data = json_decode('[{"id":1,"label":"MAV001"},{"id":2,"label":"MAV002"},{"id":3,"label":"MAV003"},{"id":4,"label":"MAV004"},{"id":5,"label":"MAV005"},{"id":6,"label":"MAV006"},{"id":7,"label":"MAV007"},{"id":8,"label":"MAV008"},{"id":9,"label":"MAV009"},{"id":10,"label":"MAV010"},{"id":11,"label":"MAV011"},{"id":12,"label":"MAV012"},{"id":13,"label":"MAV013"},{"id":14,"label":"MAV014"},{"id":15,"label":"MAV015"},{"id":16,"label":"MAV016"},{"id":17,"label":"MAV017"},{"id":18,"label":"MAV018"},{"id":19,"label":"MAV019"},{"id":20,"label":"MAV020"},{"id":21,"label":"MAV021","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":22,"label":"MAV022","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":23,"label":"MAV023","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":24,"label":"MAV024","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":25,"label":"MAV025","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":26,"label":"MAV026","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":27,"label":"MAV027","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":28,"label":"MAV028","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":29,"label":"MAV029","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":30,"label":"MAV030","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":31,"label":"MAV031","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":32,"label":"MAV032","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":33,"label":"MAV033","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":34,"label":"MAV034","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":35,"label":"MAV035","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}},{"id":36,"label":"MAV036","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":37,"label":"MAV037","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":38,"label":"MAV038","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":39,"label":"MAV039","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":40,"label":"MAV040","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":41,"label":"MAV041","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":42,"label":"MAV042","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":43,"label":"MAV043","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":44,"label":"MAV044","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":45,"label":"MAV045","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":46,"label":"MAV046","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":47,"label":"MAV047","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":48,"label":"MAV048","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":49,"label":"MAV049","color":{"border":"#006a4e","highlight":{"border":"#006a4e"}}},{"id":50,"label":"MAV050","color":{"border":"#ff9933","highlight":{"border":"#ff9933"}}},{"id":51,"label":"MAV051","color":{"border":"#ff9933","highlight":{"border":"#ff9933"}}},{"id":52,"label":"MAV052","color":{"border":"#d20f35","highlight":{"border":"#d20f35"}}}]');
    $m_data = array_map(function($values){
        return new Fluent($values);
    }, $mihaaru_data);
    $mihaaru_collection = (new \Illuminate\Support\Collection($m_data))->keyBy('label');



    $feed="https://raw.githubusercontent.com/MaldivianDevelopers/mv-covid19-graph/master/nodes.csv";
//Read the csv and return as array
    $data = array_map('str_getcsv', file($feed));
//Get the first raw as the key
    $keys = array_shift($data);
//Add label to each value
    $cases = array_map(function($values) use ($keys) {


        $data = array_combine($keys, $values);
        $node = new Fluent($data);
        $covid = new \App\CovidCase();

        if($node->status !== 'active') {
            return;
        }

        $detectedDate = \Carbon\Carbon::createFromFormat('d-m-y', $node->date_detected);

        $covid->case_identity = strtoupper($node->case_id);
        $covid->date_detected = ($detectedDate)->toDateString();
        $covid->date_recovered = empty($node->date_recovered) ? null : \Carbon\Carbon::createFromFormat('d-m-y', $node->date_recovered);
        $covid->location_detected = empty($node->location_detected) ? null : $node->location_detected;
        $covid->age = is_numeric($node->age) ? $node->age : null;
        $covid->status = $node->status;
        $covid->gender = $node->gender;
        $covid->created_at = $detectedDate->timestamp;

        return $covid;
    }, $data);


    $casesCollection = (new \Illuminate\Support\Collection($cases))->keyBy('case_identity');

    $colors = [
        '#d20f35' => 'MALDIVES',
        '#006a4e' => 'BANGLADESH',
        '#ff9933' => 'INDIA',
    ];

    $mihaaru_collection->each(function($mcase) use($casesCollection, $colors) {



        if($casesCollection->has($mcase->label)) {
            $nationality = isset($colors[$mcase->color->border]) ? $colors[$mcase->color->border] : null;
            $covidCase = $casesCollection->get($mcase->label);
            $covidCase->nationality = $nationality;

            $casesCollection->offsetSet($mcase->label, $covidCase);

        } else {

            $casesCollection->offsetSet($mcase->label, new \App\CovidCase([
                'case_identity' => strtoupper($mcase->label),
                'nationality' => null,
                'date_detected' => null,
                'created_at' => null,
                'status' => 'active'
            ]));
        }
    });



    DB::transaction(function () use ($casesCollection) {

        $items =  $casesCollection->sort()->values();
        $items->each(function($covid)
        {
            if(!empty($covid)) {
                $covid->save();
            }

        });

    });

    return 'done';
});
