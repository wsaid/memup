<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function getTopicsBySubject(Subject $subject) {
        return $subject->topics;
    }
}
