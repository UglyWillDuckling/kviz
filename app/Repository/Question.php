<?php

namespace App\Repository;

use App\Question as QuestionModel;
use App\Helper\Question\QueryBuilder;
use App\Helper\Storage as StorageHelper;

use App\Rules\Answers as AnswersRule;
use App\Rules\Image as ImageRule;
use App\Rules\Video as VideoRule;

use Storage;
use Mockery\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class Question
{
    const DEFAULT_PAGE_SIZE = 20;

    const FILE_STRINGS = ['image', 'video'];

    public $queryBuilder;
    public $query;
    /**
     * @var Request
     */
    private $request;


    public function __construct(QueryBuilder $queryBuilder, Request $request)
    {
        $this->query = QuestionModel::query();
        $this->queryBuilder = $queryBuilder;
        $this->request = $request;
    }

    public function getQuestions(array $fields, $perPage = 20, $page = 1)
    {
        $this->queryBuilder->applyFilters($this->query, $fields);
        return $this->query->paginate(
            $perPage ?: self::DEFAULT_PAGE_SIZE, $columns = ['*'], $pageName = 'page', $page
        );
    }

    public function updateQuestion(QuestionModel $question, array $data)
    {
        $validator = Validator::make($data, [
            'enabled' => 'required',
            'is_multipart' => 'required',
            'body' => 'required|min:10',
            'time_limit' => 'required | integer | min:8|max:20',
            'type_of_answer' => 'required',
            'number_of_answers' => 'required | integer | min:3|max:5',
            'answers' => ['required', 'json', new AnswersRule($data['number_of_answers'])],
            'image' => [new ImageRule],
            'video' => [new VideoRule]
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        DB::beginTransaction();
        try {
            $this->updateAnswers($question, json_decode($data['answers']));
            $this->updateQuestionData($question, $data);

            $question->save();
            DB::commit();

        }
        catch (\Exception $e) {
            if ($e instanceof \Illuminate\Database\QueryException) {
                Log::error($e->getMessage(), ["db" => true]);
            } else {
                Log::error($e->getMessage());
            }
            DB::rollBack();
        }
    }

    public function createQuestion($data) {
        $this->updateQuestionData(new QuestionModel(), $data);
    }

    protected function updateQuestionData($question, $data) {
        try {
            foreach ($data as $key => $value) {
                if (!in_array($key, $question->getFillable())) {
                    continue;
                }
                if (in_array($key, self::FILE_STRINGS))
                {
                    if ($this->request->hasFile($key)) {
                        $file = $this->request->file($key);
                    } else {
                        $file = $this->request->input($key);
                    }
                    $this->updateFile($question, $file, $key);
                    continue;
                }
                if ($key == 'categoryArray' || $key == 'answers') {
                    continue;
                }
                $question->{$key} = $value;
            }
            $this->checkImageAndVideo($question, $data);
        }
        catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $e) {
            report($e);
            Log::error($e->getMessage());
            //throw a general exception
            throw new Exception('An error occurred while uploading the file.');
        }
    }

    /**
     * @param $question
     * @param $data
     */
    protected function checkImageAndVideo($question, $data) {
        foreach (self::FILE_STRINGS as $fileString)
        {
            $hasFileString = 'has' . '_' . $fileString;
            if (isset($data[$hasFileString]) && !(bool)($data[$hasFileString])) {
                $storage_path = StorageHelper::getStoragePathFromUrl($question->{$fileString});
                if (Storage::exists($storage_path)) {

                    StorageHelper::copyToTemp(
                        $storage_path,
                        'public/temp/' . pathinfo($question->{$fileString}, PATHINFO_BASENAME)
                    );
                    Storage::delete($storage_path);
                }
                $question->{$fileString} = '';
            }
        }
    }

    protected function updateImage($question, $image) {
        $image_path = Storage::putFile(
            'public/images', $image
        );
        $question->image = Storage::url($image_path);
    }

    protected function updateVideo($question, $video) {
        $video_path = Storage::putFile(
            'public/videos', $video
        );
        $question->video = $video_path;
    }


    protected function updateFile(\App\Question $question, $file, $key) {
        if (is_string($file)) {
            $question->{$key} = $file;
            //check if file is in temporary folder, if so, copy it to storage
            $temp_path = '/storage/temp/' . pathinfo($question->{$key}, PATHINFO_BASENAME);
            if (StorageHelper::existsInPublicStorage($temp_path))
            {
                StorageHelper::copyFromTemp(pathinfo($file, PATHINFO_BASENAME) , "{$key}s");
                StorageHelper::deleteFromTemp(pathinfo($file, PATHINFO_BASENAME));
            }
        } else {
            $this->{'update'.ucfirst($key)}($question, $file);
        }
    }

    protected function updateAnswers(\App\Question $question, array $answersArray) {
        $question->answers()->delete();

        $answers = [];
        foreach ($answersArray as $answerData){
            $answer = new \App\Answer();

            $answer->type = $answerData->type; //todo needs to get the actual value
            $answer->content = $answerData->content;

            $answer->questionId = $question->id;


            $answer->save();
            $answers[] = $answer;
        }
    }
}
