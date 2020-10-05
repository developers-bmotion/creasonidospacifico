<?php

use Illuminate\Database\Seeder;
use \App\Survey;
use  \App\Question;
use \App\Answer;

class SurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Survey::truncate();
        Question::truncate();
        Answer::truncate();

        //CREANDO LA ENCUESTA
        $survey = Survey::create([
            'tittle' => 'Encuesta general',
            'description' => 'Descripcion general'
        ]);

        //CREANDO LAS PREGUNTAS
        $questions1 = Question::create([
            'quest' => 'Rango de Edad',
            'survey_id' => $survey->id
        ]);
        $questions2 = Question::create([
            'quest' => 'Género',
            'survey_id' => $survey->id
        ]);
        $questions3 = Question::create([
            'quest' => 'Navegar dentro de la Pagina web resulta una experiencia fácil',
            'survey_id' => $survey->id
        ]);
        $questions4 = Question::create([
            'quest' => 'Como nos conociste',
            'survey_id' => $survey->id
        ]);

        //CREANDO LAS RESPUESTAS DE LA PRIMERA PREGUNTA
        $answer = new Answer;
        $answer->option = '0 a 18 años';
        $answer->question_id = $questions1->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = '18 a 30 años';
        $answer->question_id = $questions1->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = '30 a 45 años';
        $answer->question_id = $questions1->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = '45 a 60 años';
        $answer->question_id = $questions1->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Más de 60 años';
        $answer->question_id = $questions1->id;
        $answer->save();

        //CREANDO LAS RESPUESTAS DE LA SEGUNDA PREGUNTA

        $answer = new Answer;
        $answer->option = 'Masculino';
        $answer->question_id = $questions2->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Femenino';
        $answer->question_id = $questions2->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Otro';
        $answer->question_id = $questions2->id;
        $answer->save();

        //CREANDO LAS RESPUESTAS DE LA TERCERA PREGUNTA

        $answer = new Answer;
        $answer->option = 'Totalmente de acuerdo';
        $answer->question_id = $questions3->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Algo de acuerdo';
        $answer->question_id = $questions3->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Algo en desacuerdo';
        $answer->question_id = $questions3->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Totalmente en desacuerdo.';
        $answer->question_id = $questions3->id;
        $answer->save();

        //CREANDO LAS RESPUESTAS DE LA CUARTA PREGUNTA

        $answer = new Answer;
        $answer->option = 'Por redes sociales';
        $answer->question_id = $questions4->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Publicidad en Internet';
        $answer->question_id = $questions4->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Por un amigo';
        $answer->question_id = $questions4->id;
        $answer->save();

        $answer = new Answer;
        $answer->option = 'Otro';
        $answer->question_id = $questions4->id;
        $answer->save();
    }
}
