<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class QuizController extends Controller
{
    //
    public function showQuiz()
    {
        $quizData = [];

        // Load the Excel file
        $spreadsheet = IOFactory::load('../custom_login/quiz.xlsx');
        
        // Get the active worksheet
        $worksheet = $spreadsheet->getActiveSheet();
        
        // Initialize variables to hold question data
        $currentQuestion = null;
        $currentAnswers = [];

        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            $questionNumber = $rowData[1]; // Assuming B column is question numbers
            $answer = $rowData[5]; // Assuming F column is the answer
            $questionAndAnswer = $rowData[6]; // Assuming G column is question and answers

            if ($questionNumber !== null) {
                // Start a new question
                if ($currentQuestion !== null) {
                    $quizData[] = [
                        'question' => $currentQuestion,
                        'answers' => $currentAnswers
                    ];
                }

                $currentQuestion = $questionAndAnswer;
                $currentAnswers = [];
            }

            if ($answer !== null) {
                $currentAnswers[] = $answer;
            }
        }

        // Add the last question
        if ($currentQuestion !== null) {
            $quizData[] = [
                'question' => $currentQuestion,
                'answers' => $currentAnswers
            ];
        }

        return view('quiz', ['quizData' => $quizData]);
    }
}
