<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function list($id)
    {
        $options = Category::findOrFail($id)->options;

        foreach($options as $option){
            $option->options = json_decode($option->options);
        }

        return $options;
    }
}
