<?php
// controller ialah class
namespace App\Http\Controllers; // namespace - kedudukan fail ini dlm folder
use App\Models\Demo;

class DemoController extends Controller {
    // http://mbas-lra.test/demo/hi
    function sayHi() {
        echo "Hi...";
        // retrieve semua data dlm table demo
        $rows = Demo::all(); // all() - select * from demo
        //dd($rows); // die dump - show content dlm var
        foreach ($rows as $data) {
            echo $data->title . '<br>';
        }
    }

    function greeting() {
        return view('greeting');
    }
}
