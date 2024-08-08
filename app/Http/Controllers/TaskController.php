<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Función que regresa las tareas
     */
    public function getTask(){
        $data = Task::orderBy("created_at","desc")->get();

        $response = [
            "status" => 200,
            "products"=> $data,
            "message" => ""
        ];

        return response()->json($response);
    }

    /**
     * Funcion que muestra una tarea especifica en base a su id
     * 
     */
    public function getIdTask($id){
        $data = Task::find($id);

        $response = [
            "status" => 200,
            "product"=> $data,
            "message" => ""
        ];

        return response()->json($response);
    }

    /**
     * Funcion que guarda las tareas
     */
    public function saveTask(Request $request){

        $validator = Validator::make(
            $request->all(), 
            [
                'title' => 'required|string|max:300',
                'description' => 'required|string|max:500',
                'status' => 'required',
                'due_date' => 'required',
            ],
            [
                'title.required'=> 'El titulo es obligatorio', 
                'description.required'=> 'La descripcion es obligatoria',   
                'status.required'=> 'El estado es obligatorio',  
                'due_date.required'=> 'La fecha es obligatoria', 
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ], 400);
        }

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();


        if($task){
            $response = [
                "status" => 200,
                "message" => "Registro guardado correctamente :)"
            ];

            return response()->json($response, 200);
        }else{
            $response = [
                "status" => 500,
                "message" => "Error :("
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Función que actualiza tareas
     */
    public function putTask(Request $request, $id){

        $task = Task::find($id);

        $validator = Validator::make(
            $request->all(), 
            [
                'title' => 'required|string|max:300',
                'description' => 'required|string|max:500',
                'status' => 'required',
                'due_date' => 'required',
            ],
            [
                'title.required'=> 'El titulo es obligatorio', 
                'description.required'=> 'La descripcion es obligatoria',   
                'status.required'=> 'El estado es obligatorio',  
                'due_date.required'=> 'La fecha es obligatoria', 
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ], 400);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->update();

        if($task){
            $response = [
                "status" => 200,
                "message" => "Registro editado correctamente :)"
            ];
    
            return response()->json($response, 200);
        }else{
            $response = [
                "status" => 500,
                "message" => "Error :("
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Función que elimina tareas
     */
    public function deleteTask($id)
    {
        $task = Task::find($id);
        if($task){
            $task->delete();
            $response = [
                "status" => 200,
                "message" => "Tarea eliminada correctamente :)"
            ];
    
            return response()->json($response, 200);
        }else{
            $response = [
                "status" => 404,
                "message" => "No existe la tarea"
            ];
            return response()->json($response, 404);
        }
        
    }

    /**
     * Función que regresa las tareas    
     * */
    public function filterByDate($date){
        
        $data = Task::where("due_date", $date)->first();

        $response = [
            "status" => 200,
            "products"=> $data,
            "message" => ""
        ];

        return response()->json($response);
    }
}